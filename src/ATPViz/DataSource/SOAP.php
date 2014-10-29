<?php

namespace ATPViz\DataSource;

class SOAP extends AbstractDataSource
{
	public function getData()
	{
		$options = $this->getOptions();
		$url = $options['url'];
		$namespace = $options['namespace'];
		$client = new \ATP\Soap\Client($url, $namespace);

		$headers = array();
		foreach($options['headers'] as $name => $params)
		{
			$header = new \ATP\Soap\Header($namespace, $name);
			foreach($params as $name => $value)
			{
				$header->$name = $value;
			}
			$headers[] = $header;
		}
		$client->__setHeaders($headers);
		
		$function = $options['function'];
		$node = $client->$function();
		
		if(isset($options['dataElement']))
		{
			$nodes = explode("\\", $options['dataElement']);
			foreach($nodes as $curNode)
			{
				$node = $node[$curNode];
			}
		}
		
		if($options['extractAttributes'])
		{
			foreach($node as &$item)
			{
				if(isset($item['@attributes']))
				{
					$item = array_merge($item, $item['@attributes']);
					unset($item['@attributes']);
				}
			}
		}
		
		$columns = count($node) > 0 ? array_keys($node[0]) : array();
		
		return array(
			'columns' => $columns,
			'data' => $node,
		);
		
	}
}
