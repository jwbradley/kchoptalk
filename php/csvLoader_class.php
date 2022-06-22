<?php


namespace files; 

class csvLoader {
	function __construct($filename, $delimitr=',', $stringSeparator='"', $esc_char='\\') {
    	$this->csvdata   = array();
		$this->csvheader = null;		
		$this->inputFile = $filename;		
		$this->separator = $delimitr;		
		$this->enclosure = $stringSeparator;		
		$this->escape    = $esc_char;		
		$this->loadcsv();
	}

	function __destruct() {

	}

	function loadcsv () {
		$this->fileProc  = file($this->inputFile);
		if (is_array($this->fileProc)) {
			foreach ($this->fileProc as $rownum => $row) {
				if ($rownum == 0)  {
					$this->csvheader = str_getcsv($row, $this->separator, $this->enclosure, $this->escape);
				} else {
					$this->csvdata[] = array_combine($this->csvheader, str_getcsv($row, $this->separator, $this->enclosure, $this->escape));
				}
			}
		}
	}
}

?>