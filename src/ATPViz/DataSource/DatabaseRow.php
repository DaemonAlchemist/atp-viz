<?php

namespace ATPViz\DataSource;

class DatabaseRow extends AbstractDataSource
{
	public function getData()
	{
		$options = $this->getOptions();
		
		$db = $this->get($options['adapter']);
		$results = $db->query($options['query'])->execute();
		
		$row = current($results);
		foreach($results as $row)
		{
			return $row;
		}
	}
}
