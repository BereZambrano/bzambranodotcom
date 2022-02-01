<?php namespace ProcessWire;

/**
 * ProcessWire Form Builder Entries/Results
 *
 * Copyright (C) 2019 by Ryan Cramer Design, LLC
 * 
 * PLEASE DO NOT DISTRIBUTE
 * 
 * This file is commercially licensed.
 * 
 * @method int|bool save(array $data)
 * @method bool saveField($id, $name, $value)
 * @method int|bool delete(int $id)
 * @method bool deleteAll()
 * @method exportCSV(FormBuilderForm $form, $selectorString, $filename = 'export.csv', $delimiter = ',', $useBOM = false)
 * @method int deleteOlderThan($age, $ageType = 'DAYS', $dateColumn = 'created', $flags = 0)
 * @method void deleted(array $entryIDs) Hook called after one or more entries are deleted
 * 
 */

class FormBuilderEntries extends Wire {

	/**
	 * Name of DB table created/used by this class
	 *
	 */
	const entriesTable = 'forms_entries';

	/**
	 * Flag indicates entry is a partial entry
	 * 
	 */
	const flagPartial = 1;

	/**
	 * Required length for entryStr property
	 * 
	 */
	const entryStrLength = 30;

	/**
	 * ID of form these entries are for
	 *
	 */
	protected $forms_id = 0;

	/**
	 * Total entries found (sans pagination) from the last find() call, for getLastTotal() method.
	 *
	 */
	protected $lastTotal = 0;

	/**
	 * Default date format used for entry dates
	 *
	 * 
	 */
	protected $dateFormat = '';

	/**
	 * Reference to $mysqli database
	 *
	 */
	protected $database;

	/**
	 * Reserved property names in entries
	 * 
	 * @var array
	 * 
	 */
	protected $reservedProperties = array(
		'id', 
		'entryID',
		'entryFlags',
		'entryStr',
		'entryName',
		'created',
		'modified',
		'_savePage',
		'_savePageTime',
	);

	/**
	 * Construct the Form entries
	 * 
	 * @param int $forms_id
	 * @param WireDatabasePDO $database
	 *
	 */
	public function __construct($forms_id, $database) {
		$this->forms_id = (int) $forms_id; 
		$this->database = $database; 
		$this->dateFormat = $this->_('Y-m-d H:i:s'); // date format for entries
	}

	/**
	 * Convert a string containing selectors to an array of field, opreator, value
	 *
	 * @param string str
	 * @return array
	 *
	 */
	protected function selectorStringToArray($str) {
		$a = array();
		$items = explode(',', $str);
		foreach($items as $key => $value) {
			if(preg_match('/^([-a-z0-9]+)([!=<>]+)(.*)$/i', trim($value, ' \'"'), $matches)) {
				$s = array();
				$s['field'] = $matches[1];
				$s['operator'] = $matches[2];
				$s['value'] = $matches[3]; 
				$a[] = $s; 
			}
		}
		return $a; 	
	}
	
	/**
	 * Convert a DB entry row to a FormBuilder entry
	 *
	 * @param array $row
	 * @return array
	 *
	 */
	protected function rowToEntry(array $row) {
		$data = json_decode($row['data'], true);
		$data['id'] = (int) $row['id'];
		$data['created'] = date($this->dateFormat, strtotime($row['created']));
		$data['modified'] = isset($row['modified']) ? date($this->dateFormat, strtotime($row['modified'])) : $data['created'];
		$data['entryFlags'] = isset($row['flags']) ? (int) $row['flags'] : 0;
		$data['entryStr'] = isset($row['str']) ? $row['str'] : '';
		return $data;
	}

	/**
	 * Convert a row to a specific column
	 *
	 * @param array $row
	 * @param $col
	 * @return bool|mixed
	 *
	 */
	protected function rowToCol(array $row, $col) {
		if($col === 'data' || !isset($row[$col])) {
			$data = json_decode($row['data'], true);
			if($col !== 'data') {
				// see if column is in unencoded data column
				$data = isset($data[$col]) ? $data[$col] : false;
			}
		} else {
			$data = $row[$col];
		}
		return $data;
	}

	/**
	 * Build an SQL query to find entries by translating a selector string
	 *
	 * @param string $selectorString
	 * @param bool $countTotal Whether we should include an SQL_CALC_FOUND_ROWS
	 * @return string SQL query ready to use
	 * @throws FormBuilderException
	 *
	 */
	protected function buildFindQuery($selectorString, $countTotal = true) {

		$selectors = $this->selectorStringToArray($selectorString);
		$where = '';
		$limit = 0; 
		$start = 0;
		$orderby = 'created DESC';

		foreach($selectors as $selector) {	

			$field = $selector['field'];
			$operator = $selector['operator'];
			$value = $selector['value']; 

			if(!$this->database->isOperator($operator)) {
				throw new FormBuilderException("Operator '$operator' is not valid for querying '$field'"); 
			}

			switch($field) { 

				case 'id': 
				case 'entryID':
					$value = (int) $value; 
					$where .= "AND id$operator$value ";
					break;
				
				case 'str':	
				case 'entryStr':	
					$value = $this->database->escapeStr($value);
					$where .= "AND str$operator'$value' ";
					break;
			
				case 'flags':	
				case 'entryFlags':	
					$value = (int) $value;
					if($operator != '=' && $operator != '!=') throw new FormBuilderException("Operator '$operator' not supported for flags"); 
					$where .= $operator === '!=' ? "AND NOT(flags & $value) " : "AND (flags & $value) ";
					break;

				case 'created':
				case 'modified': 	
					if(!ctype_digit($value)) $value = strtotime($value);
					if(!ctype_alpha($field)) $field = $field = 'created';
					$value = date('Y-m-d H:i:s', $value); 
					$where .= "AND $field$operator'$value' ";
					break;

				case 'sort': 
					$value = $this->database->escapeStr($value);
					if(substr($value, 0, 1) == '-') $orderby = "`" . trim($value, '-') . "` DESC";
						else $orderby = "`$value`";
					break;

				case 'start': 
					$start = (int) $value; 
					break;

				case 'limit':
					$limit = (int) $value; 
					break;
			}

		}

		$forms_id = (int) $this->forms_id; 
		$sql = 	
			"SELECT " . ($countTotal ? "SQL_CALC_FOUND_ROWS " : '') . 
			"* FROM " . self::entriesTable . " " . 
			"WHERE forms_id=$forms_id $where " . 
			"ORDER BY $orderby ";

		if($limit) $sql .= "LIMIT $start,$limit ";

		return $sql;
	}

	/**
	 * Get an array of form entries
	 *
	 * @param int|string $selectorString
	 * @return array
	 * @todo update find method to support encoded properties (load then filter)
	 *
	 */
	public function find($selectorString) {

		$entries = array();
		$sql = $this->buildFindQuery($selectorString);
		$query = $this->database->prepare($sql); 
		$query->execute();

		while($row = $query->fetch(\PDO::FETCH_ASSOC)) { 
			$entries[] = $this->rowToEntry($row); 
		}

		$query = $this->database->prepare("SELECT FOUND_ROWS()"); 
		$query->execute();
		
		list($this->lastTotal) = $query->fetch(\PDO::FETCH_NUM);
		
		$query->closeCursor();

		return $entries; 
	}

	/**
	 * Get a form entry by ID 
	 * 
	 * @param int $id
	 * @param string $col Specify a specific DB column to get or omit for entire entry
	 * @return bool|array Returns form entry (array) on success or boolean false on fail
	 * @since 0.3.8
	 * 
	 */
	public function getById($id, $col = '') {
		$sql = "SELECT * FROM " . self::entriesTable . " WHERE id=:id";
		$query = $this->database->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT); 
		$query->execute();
		if(!$query->rowCount()) return false;
		$row = $query->fetch(\PDO::FETCH_ASSOC);
		$query->closeCursor();
		return $col ? $this->rowToCol($row, $col) : $this->rowToEntry($row);
	}

	/**
	 * Get a form entry by name 
	 * 
	 * @param string $name Entry name in format "id:str" where "id" is integer ID and "str" is 30-character entry string
	 * @param string $col Optional DB column name or omit for entire entry
	 * @return bool|array Returns form entry (array) on success or boolean false on fail
	 * @since 0.4.0
	 * 
	 */
	public function getByName($name, $col = '') {
		
		if(!strpos($name, ':')) return false;
		list($id, $str) = explode(':', $name, 2);
		if(!ctype_digit("$id")) return false;
		if(!ctype_alnum($str) || strlen($str) != self::entryStrLength) return false;
		
		$table = self::entriesTable;
		$sql = "SELECT * FROM $table WHERE id=:id AND str=:str AND forms_id=:forms_id";
		
		$query = $this->database->prepare($sql);
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		$query->bindValue(':str', $str, \PDO::PARAM_STR);
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT);
		$query->execute();
		
		if($query->rowCount()) {
			$row = $query->fetch(\PDO::FETCH_ASSOC);
			$query->closeCursor();
		} else {
			$row = false;
		}
		
		$query->closeCursor();
		
		if($row === false) return false;
		
		return $col ? $this->rowToCol($row, $col) : $this->rowToEntry($row);
	}

	/**
	 * Get a single form result array, or null if not found
	 *
	 * @param int|string $selectorString
	 * @return null|array
	 *
	 */
	public function get($selectorString) {
		if(ctype_digit("$selectorString")) {
			$result = $this->getById((int) $selectorString);
		} else {
			$selectorString .= ", limit=1";
			$result = $this->find($selectorString);
			$result = reset($result);
		}
		return empty($result) ? null : $result;
	}

	/**
	 * Works like find() except that it exports a CSV file
	 *
	 * This function also halts execution of the request after the CSV has been delivered
	 * 
	 * Note: to set the content-type header do the following in your /site/config.php file:
	 * ~~~~~
	 * $config->contentTypes('csv', 'text/csv'); 
	 * ~~~~~
	 * Replace the 'text/csv' above with the content-type header you want to use. Note that 
	 * the default used in this method is 'application/force-download'. 
	 *
	 * @param FormBuilderForm $form
	 * @param string $selectorString 
	 * @param string $filename 
	 * @param string $delimiter
	 * @param bool $useBOM Include UTF-8 BOM at beginning? (default=false)
	 * 
	 */
	public function ___exportCSV(FormBuilderForm $form, $selectorString, $filename = 'export.csv', $delimiter = ',', $useBOM = false) {
		
		if(strtoupper($delimiter) === 'T') {
			$delimiter = "\t";
		} else if(empty($delimiter)) {
			$delimiter = ',';
		}
			
		$contentTypes = $this->wire('config')->contentTypes; // i.e. "text/csv; charset=utf-8", "application/csv", etc. 
		$contentType = isset($contentTypes['csv']) ? $contentTypes['csv'] : 'application/force-download';

		header("Content-type: $contentType");
		header("Content-transfer-encoding: Binary");
		header("Content-disposition: attachment; filename=$filename");

		$fp = fopen('php://output', 'w');
		if($useBOM) fwrite($fp, "\xEF\xBB\xBF"); // UTF-8 BOM: needed for some software to recognize UTF-8

		$sql = $this->buildFindQuery($selectorString, false);
		$query = $this->database->prepare($sql); 
		$query->execute();
		$fields = array();
		$formBuilderFields = array(); 
		$honeypot = $form->honeypot;
		$submitName = $form->name . '_submit';
		$hasPagesPath = method_exists($this->wire('pages'), 'getPath'); 
		$rootURL = rtrim($this->wire('pages')->get('/')->httpUrl(), '/');
		
		while($row = $query->fetch(\PDO::FETCH_ASSOC)) { 
			
			$flags = array();
			if($row['flags'] & self::flagPartial) $flags[] = 'partial';

			$data = json_decode($row['data'], true); 	
			$data['id'] = (int) $row['id']; 
			$data['created'] = date('Y-m-d H:i:s', strtotime($row['created']));
			$data['modified'] = date('Y-m-d H:i:s', strtotime($row['modified'])); 
			$data['flags'] = implode(', ', $flags);
			
			if($honeypot && isset($data[$honeypot])) unset($data[$honeypot]);

			if(empty($fields)) {
				// write out the first row with column names
				$fields = array_keys($data);
				foreach($fields as $key => $name) {
					if($name === $submitName || $name === $honeypot) unset($fields[$key]); 
				}
				@fputcsv($fp, $fields, $delimiter);
			}
			
			// this makes sure that all the data is in the same order 
			// as the CSV fields from the first row, in case format ever changed
			$a = array();
			foreach($fields as $name) {

				$value = array_key_exists($name, $data) ? $data[$name] : '';

				if(isset($formBuilderFields[$name])) {
					$formBuilderField = $formBuilderFields[$name]; 
				} else {
					$formBuilderField = $form->find($name); 
					$formBuilderFields[$name] = $formBuilderField; 
				}

				if($formBuilderField) {
					$value = $this->exportCSV_formatValue($form, $formBuilderField, $value, $data);
				} else if($name == '_savePage' && $hasPagesPath) {
					if(empty($value)) {
						$value = '';
					} else {
						$value = $rootURL . $this->wire('pages')->getPath($value);
					}
				}

				if(is_array($value)) {
					$value = implode("\n", $value);
				}

				// $value = utf8_decode($value); // support for latin1 (make conditional)
				$a[$name] = $value; 
			}

			// send the row
			@fputcsv($fp, $a, $delimiter);
		}

		$query->closeCursor();
		fclose($fp); 
		exit();
	}

	protected function exportCSV_formatValue(FormBuilderForm $form, FormBuilderField $field, $value, &$entry) {
		
		if($field->type == 'Datetime' && $value) {
			$value = date('Y-m-d H:i:s', $value);	
			
		} else if($field->type == 'Page') {
			if(is_int($value) || (is_string($value) && ctype_digit($value))) {
				$value = $this->wire('pages')->get((int) $value);
			} else if(is_string($value) && ctype_digit(str_replace('|', '', $value))) {
				$value = $this->wire('pages')->getById(explode('|', $value)); 
			}
			if(is_object($value)) {
				$a = array();
				if($value instanceof Page) $value = array($value); 
				foreach($value as $v) {
					if($v->id) $a[] = $v->get('title|name');
				}
				$value = implode(" \n", $a); 
			}
			
		} else if($field->type == 'FormBuilderFile' && !empty($value)) {
			if(!is_array($value)) $value = array($value); 
			foreach($value as $k => $v) {
				$fileURL = $this->wire('forms')->getFileURL($form->id, $entry['id'], $v);
				if($fileURL === false) {
					unset($value[$k]); // file not found
				} else {
					$value[$k] = $fileURL;
				}
			}
		} 
		
		return $value; 
	}

	/**
	 * Clean and prep an entry for saving
	 * 
	 * @param array $data
	 * 
	 */
	protected function cleanEntry(&$data) {
		// note: created and forms_id typically not present here
		unset(
			$data['id'], 
			$data['created'], 
			$data['modified'], 
			$data['forms_id'], 
			$data['entryStr'], 
			$data['entryFlags'], 
			$data['_jumpPageNum']
		);

		foreach($data as $key => $value) {
			if(strpos($key, '_errors') === 0 && empty($value) && preg_match('/^_errors\d+$/', $key)) {
				unset($data[$key]);
			} else if(strpos($key, '_submit_') && preg_match('/_submit_(jump|next|prev)$/', $key)) {
				unset($data[$key]);
			}
		}
	}

	/**
	 * Save the given entry 
	 *
	 * If it is an existing entry that should be updated, then it should have a populated 'id' property
	 * otherwise it will be inserted as a new entry. 
	 *
	 * @param array $data
	 * @return int|bool entry ID on success, false if not
	 * @throws \Exception on failure
	 *
	 */
	public function ___save(array $data) {

		$id = isset($data['id']) ? abs((int) $data['id']) : 0;
		$flags = isset($data['entryFlags']) ? (int) $data['entryFlags'] : 0;
		$str = isset($data['entryStr']) ? $data['entryStr'] : '';
		
		if($id) { 
			if(!empty($data['created'])) {
				$created = ctype_digit("$data[created]") ? (int) $data['created'] : strtotime($data['created']);
			} else {
				$created = 0; // no update
			}
		} else {
			$created = time();
		}
		
		$created = $created ? date('Y-m-d H:i:s', $created) : '';

		$this->cleanEntry($data);

		$sql = ($id ? "UPDATE " : "INSERT INTO "); 
		$sql .=	self::entriesTable . " SET forms_id=:forms_id, data=:data, str=:str, flags=:flags, modified=NOW()";
		$sql .= $created ? ", created=:created " : " ";
		if($id) $sql .= "WHERE id=:id";
		
		$query = $this->database->prepare($sql); 
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT);
		$query->bindValue(':flags', $flags, \PDO::PARAM_INT);
		$query->bindValue(':str', $str, \PDO::PARAM_STR); 
		$query->bindValue(':data', json_encode($data), \PDO::PARAM_STR);
		if($created) $query->bindValue(':created', $created);
		if($id) $query->bindValue(':id', $id, \PDO::PARAM_INT);
		$query->execute();
		if(!$id) $id = $this->database->lastInsertId();

		return $id; 
	}
	
	/**
	 * Update a single form field value for an existing entry
	 *
	 * @param int $id Entry ID
	 * @param string $name
	 * @param mixed $value
	 * @return bool
	 * @since 0.3.8
	 *
	 */
	public function ___saveField($id, $name, $value) {
		$data = $this->getById($id, 'data');
		if(!$data) return false;
		if(isset($data[$name]) && $data[$name] === $value) return true; // no update necessary
		$data[$name] = $value;
		$sql = "UPDATE " . self::entriesTable . " SET data=:data WHERE id=:id";
		$query = $this->database->prepare($sql);
		$query->bindValue(':data', json_encode($data));
		$query->bindValue(':id', (int) $id, \PDO::PARAM_INT);
		return $query->execute() ? true : false;
	}

	/**
	 * Delete a form entry
	 *
	 * @param int $id
	 * @return int|bool ID of entry that was deleted or false on failure
	 *
	 */
	public function ___delete($id) {
		$id = (int) $id; 
		$path = $this->getFilesPath($id);
		$query = $this->database->prepare("DELETE FROM " . self::entriesTable . " WHERE forms_id=:forms_id AND id=:id LIMIT 1"); 
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT); 
		$query->bindValue(':id', $id, \PDO::PARAM_INT); 
		$result = $query->execute();
		$query->closeCursor();
		if($result && is_dir($path)) wireRmdir($path, true);
		if($result) $this->deleted(array($id));
		return $result ? $id : false;
	}

	/**
	 * Re-send (email) for the given entry ID
	 * 
	 * @param $id
	 * 
	 */
	public function ___resend($id) {
		// $id = (int) $id; 
	}

	/**
	 * Delete all entries for this form
	 *
	 * @return bool
	 *
	 */
	public function ___deleteAll() {
		$query = $this->database->prepare("DELETE FROM " . self::entriesTable . " WHERE forms_id=:forms_id"); 
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT); 
		$result = $query->execute();
		wireRmdir($this->getFilesPath(), true); 
		return $result ? true : false;
	}
	
	/**
	 * Find entries older than a given number of days
	 *
	 * @param int $age Age of entries (in DAYS by default)
	 * @param string $ageType Age type of YEARS, MONTHS, WEEKS, DAYS, HOURS, MINUTES or SECONDS (default=DAYS)
	 * @param string $dateColumn Column to examine: 'created' or 'modified' (default='created')
	 * @param int|null $flags Any flag that is required to match as well (negative flag to perform NOT match or 0 to match no flags set), see flag constants in this class (default=null)
	 * @return array Returns array of entry IDs
	 * @throws WireException If given invalid age type
	 *
	 */
	public function findIdsOlderThan($age, $ageType = 'DAYS', $dateColumn = 'created', $flags = null) {
		
		$age = (int) $age;
		if($age < 1) return array();

		$ageTypes = array('YEARS', 'MONTHS', 'WEEKS', 'DAYS', 'HOURS', 'MINUTES', 'SECONDS');
		$ageType = strtoupper($ageType);
		if(substr($ageType, -1) !== 'S') $ageType .= 'S';
		if(!in_array($ageType, $ageTypes)) throw new WireException("Unrecognized ageType: $ageType");
		
		$table = self::entriesTable;
		$date = date('Y-m-d H:i:s', strtotime("-$age $ageType"));
		$col = $dateColumn === 'modified' ? 'modified' : 'created';
		$ids = array();
		$sql = "SELECT id FROM $table WHERE forms_id=:forms_id AND $col<:date ";
		if($flags === null) {
			// ignore flags
		} else if($flags === 0) {
			// match no flags set
			$sql .= "AND flags=0 ";
		} else if($flags < 0) {
			$sql .= "AND NOT(flags & :flags) ";
			$flags = abs($flags);
		} else if($flags > 0) {
			$sql .= "AND flags & :flags ";
		}
		$sql .= "ORDER BY $col ASC";

		$query = $this->database->prepare($sql);
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT);
		$query->bindValue(':date', $date);
		if($flags) $query->bindValue(':flags', (int) $flags, \PDO::PARAM_INT);
		$query->execute();

		while($row = $query->fetch(\PDO::FETCH_ASSOC)) {
			$id = (int) $row['id'];
			$ids[$id] = (int) $id;
		}

		$query->closeCursor();
		
		return $ids;
	}

	/**
	 * Delete entries older than a given number of days
	 * 
	 * @param int $age Age of entries (in DAYS by default)
	 * @param string $ageType Age type of YEARS, MONTHS, WEEKS, DAYS, HOURS, MINUTES or SECONDS (default=DAYS)
	 * @param string $dateColumn Column to examine: 'created' or 'modified' (default='created')
	 * @param int|null $flags Any flag that is required to match as well (negative flag to perform NOT match or 0 to match no flags set), see flag constants in this class (default=null) 
	 * @return int Number of entries deleted
	 * @throws WireException If given invalid age type
	 * 
	 */
	public function ___deleteOlderThan($age, $ageType = 'DAYS', $dateColumn = 'created', $flags = null) {
		
		$qty = 0;
		$qtyFiles = 0;
		$ids = $this->findIdsOlderThan($age, $ageType, $dateColumn, $flags);
		$idsFiles = array();
		
		if(!count($ids)) return 0;
		
		if($this->hasFilesPath()) {
			foreach($ids as $id) {
				if($this->hasFilesPath($id)) {
					$idsFiles[$id] = $id;
					unset($ids[$id]);
				}
			}
		}
		
		if(count($ids)) {
			// fast delete entries that have no files/dirs
			$table = self::entriesTable;
			$sql = "DELETE FROM $table WHERE forms_id=:forms_id AND id IN(" . implode(',', $ids) . ")";
			$query = $this->database->prepare($sql);
			$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT);
			$query->execute();
			$qty += $query->rowCount();
			$query->closeCursor();
			if($qty) $this->deleted($ids);
		}
	
		foreach($idsFiles as $id) {
			if($this->delete($id)) $qtyFiles++;
		}
		if($qtyFiles) $this->deleted($idsFiles);
		
		$qty += $qtyFiles;
		
		if($qty) {
			$this->wire('forms')->formLog($this->forms_id, "Deleted $qty entries older than $age $ageType old ($qtyFiles had files)"); 
		}
		
		return $qty;
	}

	/**
	 * Hook called after one or more entry IDs have been deleted
	 * 
	 * @param array $entryIDs Array of entry IDs that were deleted
	 * @since 0.4.0
	 * 
	 */
	protected function ___deleted(array $entryIDs) {
		// for hooks to implement whatever they want
	}
	
	/**
	 * Return total number of entries
	 *
	 * @return int
	 *
	 */
	public function getTotal() {
	
		$query = $this->database->prepare("SELECT COUNT(*) FROM " . self::entriesTable . " WHERE forms_id=:forms_id"); 
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT); 
		$query->execute();
		list($count) = $query->fetch(\PDO::FETCH_NUM); 
		$query->closeCursor();
		return $count; 
	}

	/**
	 * Get date of last entry
	 * 
	 * @param bool $reverse Specify true to get date of first entry rather than last entry
	 * @return string
	 * 
	 */
	public function getLastEntryDate($reverse = false) {
		$desc = $reverse ? "ASC" : "DESC";
		$query = $this->database->prepare(
			"SELECT created FROM " . self::entriesTable . " " . 
			"WHERE forms_id=:forms_id " . 
			"ORDER BY created $desc LIMIT 1"
		);
		$query->bindValue(':forms_id', $this->forms_id, \PDO::PARAM_INT);
		$query->execute();
		if($query->rowCount()) {
			list($date) = $query->fetch(\PDO::FETCH_NUM); 
		} else {
			$date = '';
		}
		$query->closeCursor();
		return $date;
	}

	/**
	 * Return the total known from the last find() query
	 *
	 */
	public function getLastTotal() {
		return $this->lastTotal;
	}

	/**
	 * Return the path that may be used by entries
	 *
	 * @param int $entryID When specified, will return the path for a specific entry's files
	 * @param bool $create Create path if it does not exist?
	 * @return string
	 *
	 */
	public function getFilesPath($entryID = 0, $create = true) { 
		/** @var FormBuilder $forms */
		$forms = $this->wire('forms');
		$path = $forms->getFilesPath(false, $create) . 'form-' . $this->forms_id . '/';
		if($create && !is_dir($path)) wireMkdir($path);
		$entryID = (int) $entryID;
		if($entryID) {
			$path .= "entry-$entryID/";
			if($create && !is_dir($path)) wireMkdir($path);
		}
		return $path;
	}


	/**
	 * Does a files path exist for form/entry?
	 * 
	 * @param int $entryID Specify entry ID to check if files path exists for entry
	 * @return bool
	 * 
	 */
	public function hasFilesPath($entryID = 0) {
		$path = $this->getFilesPath($entryID, false);
		return is_dir($path);
	}

	/**
	 * Get the current form ID
	 * 
	 * @return int
	 * 
	 */
	public function getFormID() {
		return $this->forms_id; 
	}

	/**
	 * Make an entry string (entryStr property)
	 * 
	 * @return string
	 * 
	 */
	public function makeEntryStr() {
		$rand = new WireRandom();
		$entryStr = $rand->alphanumeric(self::entryStrLength);
		return $entryStr;
	}

	/**
	 * Add flag to entry (in memory only) and return entry 
	 * 
	 * @param array $entry
	 * @param int|string $flag Flag or flag name
	 * @return array
	 * 
	 */
	public function addEntryFlag(array $entry, $flag) {
		$flag = $this->flag($flag);
		$flags = isset($entry['entryFlags']) ? $entry['entryFlags'] : 0;
		$flags = $flags | $flag;
		$entry['entryFlags'] = $flags;
		return $entry;
	}

	/**
	 * Remove flag to entry (in memory only) and return entry
	 *
	 * @param array $entry
	 * @param int|string $flag Flag or flag name
	 * @return array
	 *
	 */
	public function removeEntryFlag(array $entry, $flag) {
		$flag = $this->flag($flag);
		$flags = isset($entry['entryFlags']) ? $entry['entryFlags'] : 0;
		if($flags && ($flags & $flag)) $flags = $flags & ~$flag;
		$entry['entryFlags'] = $flags;
		return $entry;
	}

	/**
	 * Sanitize a flag or flag name to the flag integer
	 * 
	 * @param int|string $flag
	 * @return int
	 * 
	 */
	protected function flag($flag) {
		if(is_int($flag) || ctype_digit("$flag")) return (int) $flag;
		if($flag === 'partial') return self::flagPartial;
		return 0;
	}

	/**
	 * Given an entry name, validate it, returning blank string if not valid or given entry name if valid
	 * 
	 * @param string $name
	 * @return string
	 * 
	 */
	public function validEntryName($name) {
		if(!strpos($name, ':')) return '';
		list($id, $str) = explode(':', $name, 2);
		if(!ctype_digit("$id")) return '';
		if(!ctype_alnum($str) || strlen($str) != self::entryStrLength) return '';
		return $name;
	}
	
	/**
	 * Install the forms_entries table
	 * 
	 * @param WireDatabasePDO $database
	 *
	 */
	public static function _install($database) {

		$sql =  
			"CREATE TABLE " . self::entriesTable . " (" . 
			"id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY, " . 
			"forms_id INT UNSIGNED NOT NULL, " . 
			"flags INT UNSIGNED NOT NULL DEFAULT 0, " .
			"str VARCHAR(128) NOT NULL DEFAULT '', " . 
			"data TEXT NOT NULL, " .
			"created DATETIME NOT NULL, " . 
			"modified TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, " .  
			"INDEX forms_id (forms_id, flags), " . 
			"INDEX created_forms_id (created, forms_id, flags), " . 
			"INDEX modified_forms_id (modified, forms_id, flags), " . 
			"INDEX id_str (id, str) " . 
		")";

		try {
			$query = $database->prepare($sql);
			$query->execute();
		} catch(\Exception $e) {
			$database->error($e->getMessage());
		}
	}

	/**
	 * Uninstall the forms_entries table
	 * 
	 * @param WireDatabasePDO $database
	 *
	 */
	public static function _uninstall($database) {
		$database->exec("DROP TABLE " . self::entriesTable);
	}

	/**
	 * @param WireDatabasePDO $database
	 * @param string $column
	 * @return bool
	 * 
	 */
	protected static function _hasColumn($database, $column) {
		$table = self::entriesTable;
		$column = $database->escapeCol($column);
		$query = $database->prepare("SHOW COLUMNS FROM $table LIKE '$column'");
		$query->execute();
		$numRows = $query->rowCount();
		$query->closeCursor();
		return $numRows > 0;
	}

	/**
	 * @param WireDatabasePDO $database
	 * @param bool $verbose
	 * 
	 */
	public static function _upgrade($database, $verbose) {
		
		$table = self::entriesTable;
	
		if(!self::_hasColumn($database, 'str')) {
			$database->exec("ALTER TABLE $table ADD `str` VARCHAR(128) NOT NULL DEFAULT ''");
			$database->exec("ALTER TABLE $table ADD INDEX id_str (id, str)");
			if($verbose) $database->message("Added FormBuilder column $table.str"); 
		}

		if(!self::_hasColumn($database, 'flags')) {
			$database->exec("ALTER TABLE $table ADD `flags` INT UNSIGNED NOT NULL DEFAULT 0");
			$database->exec("ALTER TABLE $table ADD INDEX forms_id_flags_created (forms_id, flags, created)");
			if($verbose) $database->message("Added FormBuilder column $table.flags"); 
		}
		
		if(!self::_hasColumn($database, 'modified')) {
			$database->exec("ALTER TABLE $table ADD `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
			$database->exec("ALTER TABLE $table ADD INDEX modified_forms_id (modified, forms_id, flags)");
			if($verbose) $database->message("Added FormBuilder column $table.modified");
		}

	}

	/**
	 * Is the given property name reserved for system use in entries?
	 * 
	 * @param string $property
	 * @return bool
	 * 
	 */
	public function isReservedProperty($property) {
		if(isset($this->reservedProperties[$property])) return true;
		if(strpos($property, '_') === 0) return true;
		return false;
	}


}
