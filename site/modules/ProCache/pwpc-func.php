<?php /*NoCompile*/
if(!function_exists("buster")):
	/**
	 * ProCache buster
	 *
	 * @param string|null $url URL to bust, or null to return ProCacheBuster instance
	 * @param bool $http Specify true to return URL with full scheme and hostname
	 * @return \ProcessWire\ProCacheBuster|string|null
	 *
	 */
	function buster($url = null, $http = false) {
		/** @var \ProcessWire\ProCache $procache */
		/** @var \ProcessWire\ProCacheBuster $buster */
		$buster = \ProcessWire\wire('buster');
		if(!$buster) {
			$procache = \ProcessWire\wire('procache');
			if(!$procache) return $url;
			$buster = $procache->getBuster();
			if(!$buster) return $url;
		}
		if(empty($url)) return $buster;
		return $http ? $buster->httpUrl($url) : $buster->url($url);
	}
endif;

if(!function_exists("procache")):
	/**
	 * Get ProCache API variable
	 * 
	 * @return \ProcessWire\ProCache
	 * 
	 */
	function procache() {
		/** @var \ProcessWire\ProCache $procache */
		$procache = \ProcessWire\wire('procache');
		return $procache;
	}
endif;