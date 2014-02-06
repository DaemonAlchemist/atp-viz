<?php

namespace ATPViz\DataSource;

class DataSourceFactory implements \Zend\ServiceManager\FactoryInterface
{
	private $_sm = null;
	
	public function createService(\Zend\ServiceManager\ServiceLocatorInterface $sm)
	{
		$this->_sm = $sm;
		return $this;
	}
	
	public function getInstance($dataSourceName)
	{
		static $dataSources = array();
		
		if(!isset($dataSources[$dataSourceName]))
		{
			$config = $this->_sm->get('Config');
			
			$dataSourceDefinitions = $config['viz']['data_sources'];
			
			if(isset($dataSourceDefinitions[$dataSourceName]))
			{
				$dataSourceClass = $dataSourceDefinitions[$dataSourceName]['class'];
				$dataSource = new $dataSourceClass();
				$dataSource->setOptions($dataSourceDefinitions[$dataSourceName]['options']);
				$dataSource->setServiceLocator($this->_sm);
				
				$dataSources[$dataSourceName] = $dataSource;
			}
			else
			{
				$dataSources[$dataSourceName] = null;
			}			
		}
		
		return $dataSources[$dataSourceName];
	}
}
