<?php namespace ProcessWire;

/**
 * ProcessWire Multiplier Inputfield Base Class
 *
 * This combines the shared code for any multiplier Inputfield, since we plan to build more than one.
 *
 * Part of the ProFields package
 * Please do not distribute. 
 * 
 * Copyright 2022 by Ryan Cramer
 *
 * https://processwire.com
 * 
 * @property string $inputfieldConfigNames
 *
 */

class InputfieldMultiplierBase extends Inputfield implements InputfieldHasArrayValue {

	/**
	 * @var Field|null
	 * 
	 */
	protected $_field = null;

	/**
	 * @var Fieldtype|null
	 * 
	 */
	protected $_fieldtype = null;

	/**
	 * @var Page|null
	 * 
	 */
	protected $_page = null;

	/**
	 * Return an array of default configuration key=>value
	 *
	 */
	protected function getDefaultSettings() {
		return array(
			'inputfieldConfigNames' => ''
		);	
	}

	public function __construct() {
		parent::__construct();
		foreach($this->getDefaultSettings() as $key => $value) {
			$this->set($key, $value); 
		}
	}

	public function setField(Field $field) {
		$this->_field = $field; 
	}

	public function setFieldtype(Fieldtype $fieldtype) {
		$this->_fieldtype = $fieldtype; 
	}

	public function setPage(Page $page) {
		$this->_page = $page; 
	}

	public function getField() {
		if(is_null($this->_field)) throw new WireException("Field is not set"); 
		return $this->_field;
	}

	public function getFieldtype() {
		if(is_null($this->_fieldtype)) throw new WireException("Fieldtype is not set"); 
		return $this->_fieldtype;
	}

	public function getPage() {
		return $this->_page; 	
	}

	public function has($key) {
		// ensures it accepts any config value (like those for delegate inputfields)
		return true; 
	}

	public function ___render() {
		// must be implemented by descending class
	}

	public function ___processInput(WireInputData $input) {
		// must be implemented by descending class
	}

	/**
	 * Get an Inputfield module and populate value
	 * 
	 * @param int $n
	 * @param null|mixed $value
	 * @return Inputfield
	 * 
	 */
	public function getInputfield($n = 0, $value = null) {
		// pass long any relevant configuration items
		$n = (int) $n;
		$fieldtype = $this->getFieldtype();
		$inputfield = $fieldtype->getInputfield($this->getPage(), $this->getField()); 
		if(!$inputfield) $inputfield = $this->wire()->modules->get('InputfieldText'); 
		$inputfield->hasFieldtype = $fieldtype; 
		$configNames = explode(',', $this->inputfieldConfigNames);

		foreach($configNames as $configName) {
			$inputfield->set($configName, $this->getSetting($configName)); 
		}

		$inputfield->attr('name', $this->attr('name') . "_$n");
		$inputfield->attr('id', $this->attr('id') . "_$n"); 
		if(!is_null($value)) $inputfield->attr('value', $value); 

		return $inputfield; 
	}

	public function ___getConfigInputfields() {

		$inputfields = parent::___getConfigInputfields();
		
		$f = $inputfields->getChildByName('requiredAttr');
		if($f) $f->parent->remove($f);

		$in = $this->getInputfield();
		$configNames = array();
		$configInputs = $in->getConfigInputfields(); 

		foreach($configInputs->getAll() as $i) {
			/** @var Inputfield $i */
			if($inputfields->getChildByName("$i->name")) {
				$f = $configInputs->getChildByName($i->name);
				$f->parent->remove($f); 
				if(!count($f->parent->children())) {
					$grandparent = $f->parent->parent; 
					if($grandparent) $grandparent->remove($f->parent); 
				}
			} else {
				$configNames[$i->name] = $i->name;
			}
		}
		
		if(count($configNames)) { 
			/** @var InputfieldFieldset $fieldset */
			$fieldset = $this->wire()->modules->get('InputfieldFieldset'); 
			$fieldset->label = str_replace("Inputfield", '', $in->className()); 

			foreach($configInputs as $i) {
				/** @var Inputfield $i */
				$fieldset->add($i); 	
			}
			$inputfields->add($fieldset); 
		}

		$f = $inputfields->getChildByName('requiredAttr'); 
		if($f) {
			$f->parent->remove($f);
			unset($configNames['requiredAttr']);
		}

		/** @var InputfieldHidden $f */
		$f = $this->wire()->modules->get('InputfieldHidden');
		$f->attr('name', 'inputfieldConfigNames'); 
		$f->attr('value', implode(',', $configNames)); 
		$inputfields->add($f); 

		return $inputfields; 
	}
}

