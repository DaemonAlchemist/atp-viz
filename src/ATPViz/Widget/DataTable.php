<?php

namespace ATPViz\Widget;

class DataTable extends \ATPViz\Widget\AbstractWidget
{
	public function __construct()
	{
		parent::__construct();
		
		$this->setTemplate('atp-viz/widget/dataTable.phtml');
	}

	public function getClasses($row)
	{
		$classes = array();
		if(isset($this->classFields))
		{
			foreach($this->classFields as $field)
			{
				$value = $row[$field];
				$method = "get{$field}Class";
				if(method_exists($this, $method)) $value = $this->$method($value);
				
				$class = str_replace(array("/", " "), "-", trim("{$field}-{$value}"));
				while(strpos($class, "--") !== false) $class = str_replace("--", "-", $class);
				$classes[] = $class;
			}
		}
		
		return implode(" ", $classes);
	}
	
	public function getSampleData()
	{
		return array(
			'columns' => array('First Column', 'Second Column', 'Third Column'),
			'data' => array(
				array(1, 2, 3),
				array(4, 5, 6),
				array(7, 8, 9)
			)
		);
	}
}
