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
		
		$columns = count($rows) > 0
			? array_keys(current($rows))
			: array("<em>No Results</em>");
		if(!is_null($indVar)) array_unshift($columns, $indVar);

		return array(
			'columns' => $columns,
			'data' => $rows
		);
	}
	
}
