<?php

namespace ATPViz\DataSource;

class CSVFile extends AbstractDataSource
{
	public function getData()
	{
		$options = $this->getOptions();
		
		$fileName = $options['fileName'];
		
		$content = file_get_contents($fileName);
		$lines = explode("\n", str_replace("\r", "", $content));
		$lines = array_map(
			function($line)
			{
				return explode(",", $line);
			},
			$lines
		);
		
		return array(
			'columns' => $options['columns'],
			'data' => $lines,
		);
	}
}