<?php

/**
 * Function to put csv to array
 *
 * @param array $donnees
 * @param string $filename
 * @param string $delimiter
 * @return void
 */
function csvToArray(array &$donnees, string $filename = '', string $delimiter = '')
{
	if (!file_exists($filename) || !is_readable($filename))
		return FALSE;

	$header = NULL;
	$donnees = array();
	if (($handle = fopen($filename, 'r')) !== FALSE) {
		while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE) {
			if (!$header)
				$header = $row;
			else
				$donnees[] = array_combine($header, $row);
		}
		fclose($handle);
	}
}

/**
 * Function to put array in csv
 *
 * @param array $donnees
 * @param string $filename
 * @param string $delimiter
 * @param array $header
 * @return void
 */
function arrayToCsv(array &$donnees, string $filename = '', string $delimiter = '', array $header = array())
{
	$fp = fopen($filename, "w");
	fputcsv($fp, $header, $delimiter);
	// fputcsv($fp, $header, $delimiter, "\t");
	foreach ($donnees as $row) {
		$row = (array)$row;
		fputcsv($fp, $row, $delimiter);
		// fputcsv($fp, $row, $delimiter, "\t");
	}
	fclose($fp);
}
