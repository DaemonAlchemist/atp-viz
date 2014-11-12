<?php

namespace ATPViz\DataSource;

class DatabaseQuery extends AbstractDataSource
{
	public function getData()
	{
		$options = $this->getOptions();
	
		$db = $this->get($options['adapter']);
		$results = $db->query($options['query'])->execute();
		
		$indVar = isset($options['indVar']) ? $options['indVar'] : null;
		
		$rows = array();
		foreach($results as $row)
		{
			if(is_null($indVar))
			{
				$rows[] = $row;
			}
			else
			{
				$var = $row[$indVar];
				unset($row[$indVar]);
				$rows[$var] = $row;
			}
		}
		
		if(!isset($options['columns']))
		{
			throw new \Exception("Chart column definitions not set");
		}
		
		return array(
			'columns' => $options['columns'],
			'data' => $rows
		);
	}
	
}
