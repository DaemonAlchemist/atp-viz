<?php

namespace ATPViz\Widget;

class AbstractWidget extends \Zend\View\Model\ViewModel
{
	private $_dataSource = null;
	private $_sm = null;
	
	public function init(){}
	
	public function setServiceLocator($sm)
	{
		$this->_sm = $sm;
	}
	
	public function getServiceLocator()
	{
		return $this->_sm;
	}
	
	public function setDataSource($src)
	{
		$this->_dataSource = $src;
	}
	
	public function getDataSource()
	{
		return $this->_dataSource;
	}
	
	public function setOptions($options)
	{
		parent::setOptions($options);
		
		foreach($options as $name => $value)
		{
			$this->$name = $value;
		}
	}
	
	public function getData()
	{
		return !is_null($this->_dataSource)
			? $this->_dataSource->getData()
			: $this->getSampleData();
	}
	
	public function getSampleData()
	{
		return null;
	}
}
