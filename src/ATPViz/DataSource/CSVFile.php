<?php

namespace ATPViz\DataSource;

class CSVFile extends AbstractDataSource
{
	public function getData()
	{
		$options = $this->getOptions();
		
		//Load data
		$lines = $this->_loadData();
		$lines = $this->_postLoadData($lines);
		
		//Validate columns
		foreach($lines as &$line)
		{
			$index=0;
			foreach($options['columns'] as $name => $type)
			{
				//Make sure numbers are actually numbers (for proper json encoding)
				if($type == 'number')
				{
					$line[$index] = $line[$index] + 0.0;
				}
				
				$index++;
			}
		}
		
		//Make first columns into keys if necessary
		if($options['firstColumnKeys'])
		{
			$lines = array_combine(
				array_map(function($line){return $line[0];}, $lines),
				array_map(function($line){array_shift($line); return $line;}, $lines)
			);
		}
		
		return array(
			'columns' => $options['columns'],
			'data' => $lines,
		);
	}
	
	protected function _loadData()
	{
		$options = $this->getOptions();
		
		$fileName = $options['fileName'];
		
		$content = trim(file_get_contents($fileName));
		$lines = explode("\n", str_replace("\r", "", $content));
		$lines = array_map(
			function($line)
			{
				return explode(",", $line);
			},
			$lines
		);
		
		return $lines;
	}
	
	protected function _postLoadData($lines)
	{
		return $lines;
	}
}