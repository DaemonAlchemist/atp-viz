<?php

namespace ATPViz\Widget;

class Container extends \Zend\View\Model\ViewModel
{
	private $_allWidgets = array();
	private $_sm = null;

	public function __construct($config, $sm, $data)
	{
		//Initialize the view
		parent::__construct();
		
		//Get the widget definitions
		$this->_allWidgets = $config['viz']['widgets'];
		$this->setServiceLocator($sm);
		
		//Set the template
		$this->setTemplate('atp-viz/widget/container.phtml');		
		
		//Set the data
		foreach($data as $name => $value)
		{
			$this->$name = $value;
		}
	}
	
	public function setServiceLocator($sm)
	{
		$this->_sm = $sm;
	}
	
	public function getServiceLocator()
	{
		return $this->_sm;
	}
	
	public function addWidget($name, $options, $data)
	{
		if(isset($this->_allWidgets[$name]))
		{
			//Get widget info
			$widgetInfo = $this->_allWidgets[$name];
			while(isset($widgetInfo['inherit']))
			{
				$inherit = $widgetInfo['inherit'];
				unset($widgetInfo['inherit']);
				$widgetInfo = array_merge_recursive(
					$widgetInfo,
					$this->_allWidgets[$inherit]
				);
			}
			$widgetInfo['options'] = array_merge($widgetInfo['options'], $options);
			$widgetClass = $widgetInfo['class'];
			
			//Create the widget
			$widget = new $widgetClass();			
			$widget->setServiceLocator($this->getServiceLocator());
			
			//Set the widget options
			$widget->setOptions($widgetInfo['options']);
			$widget->setData($data);
			$widget->name = $name;
			
			//Set the widget data source
			$dataSource = $this->getServiceLocator()->get('DataSourceFactory')->getInstance($widgetInfo['dataSource']);
			if(!is_null($dataSource)) $dataSource->setData($data);
			$widget->setDataSource($dataSource);
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
