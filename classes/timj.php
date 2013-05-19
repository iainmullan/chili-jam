<?php
require_once 'cacheable.php';
class Timj extends Cacheable {

	var $_artist = "red+hot+chili+peppers";
	var $_key = '';
	var $_secret = '';
	
	function __construct($key, $secret) {
		$this->_key = $key;
		$this->_secret = $secret;
	}

	function search() {

		$jams = $this->cacheRead('jams');
		
		if ($jams === FALSE) {
		
			$query = "http://api.thisismyjam.com/1/search/jam.json?by=artist&q=".$this->_artist."&key=".$this->_key;
			$jams = json_decode(file_get_contents($query), true);		
		
			$this->cacheWrite('jams', $jams);
		}
		
		return $jams;
	}

}
?>