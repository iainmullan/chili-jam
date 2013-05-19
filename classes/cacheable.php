<?php

define('CACHE_DIR', ROOT.'/cache');
define('CACHE_LENGTH', 300); // 5 minutes

class Cacheable {

	protected function cacheRead($key) {
		$file = CACHE_DIR.'/'.$key.'.cache';

		error_log('cache check for '.$key);

		if (file_exists($file)) {
			$mtime = filemtime($file);

			if ($mtime < (time() - CACHE_LENGTH)) {
				error_log('cache too old for '.$key);
				// cached version is too old
				return FALSE;
			}

		} else {
			return FALSE;
		}

		error_log('READ cache successful for '.$key);

		return unserialize(file_get_contents($file));
	}

	protected function cacheWrite($key, $contents) {
		error_log('WRITE cache for '.$key);
		$file = CACHE_DIR.'/'.$key.'.cache';
		$fh = fopen($file, 'w');
		fwrite($fh, serialize($contents));
		fclose($fh);
	}

}
