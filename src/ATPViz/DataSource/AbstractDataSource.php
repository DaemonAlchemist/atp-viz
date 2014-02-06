<?php

namespace ATPViz\Datasource;

class AbstractDataSource
{
	private $_options = array();
	private $_sm = null;
	
	public function setOptions($options)
	{
		$this->_options = $options;
	}
	
	public function getOptions()
	{
		return $this->_options;
	}
	
	public function setServiceLocator($sm)
	{
		$this->_sm = $sm;
	}
	
	public function getServiceLocator()
	{
		return $this->_sm;
	}
	
	public function get($resource)
	{
		return $this->_sm->get($resource);
	}
}
