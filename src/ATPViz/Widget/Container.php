<?php

namespace ATPViz\Widget;

class Container extends \Zend\View\Model\ViewModel
{
	private $_allWidgets = array();
	private $_sm = null;

	public function __construct($config, $sm)
	{
		//Initialize the view
		parent::__construct();
		
		//Get the widget definitions
		$this->_allWidgets = $config['viz']['widgets'];
		$this->setServiceLocator($sm);
		
		//Set the template
		$this->setTemplate('atp-viz/widget/container.phtml');		
	}
	
	public function setServiceLocator($sm)
	{
		$this->_sm = $sm;
	}
	
	public function getServiceLocator()
	{
		return $this->_sm;
	}
	
	public function addWidget($name, $options)
	{
		if(isset($this->_allWidgets[$name]))
		{
			$widgetInfo = $this->_allWidgets[$name];
			$widgetInfo['options'] = array_merge($widgetInfo['options'], $options);
			$widgetClass = $widgetInfo['class'];
			$widget = new $widgetClass();
			$widget->setServiceLocator($this->getServiceLocator());
			$widget->setOptions($widgetInfo['options']);
			$widget->name = $name;
			$widget->setDataSource($this->getServiceLocator()->get('DataSourceFactory')->getInstance($widgetInfo['dataSource']));
		}
		else
		{
			$widget = new \ATPViz\Widget\PlaceHolderWidget();
			$widget->text = $name;
			$widget->name = $name;
		}
		$this->addChild($widget, 'widgets', true);
		$widget->data = $widget->getData();
	}
}
