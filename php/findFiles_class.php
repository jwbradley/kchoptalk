<?php

namespace files; 

class findFiles {
	function __construct($inPath, $wildcard='*', $fileExtension='') {
		$this->fileList = glob(trim($inPath).trim($wildcard).trim($fileExtension));
	}
}


?>