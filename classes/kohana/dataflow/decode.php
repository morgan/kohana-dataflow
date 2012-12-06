<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Decode Abstract
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2012 Micheal Morgan
 * @license		MIT
 */
abstract class Kohana_Dataflow_Decode 
{	
	/**
	 * Default driver
	 * 
	 * @static
	 * @access	public
	 * @var		string
	 */
	public static $default = 'json';
	
	/**
	 * Factory pattern
	 * 
	 * @static
	 * @access	public
	 * @return	Dataflow_Input
	 */
	public static function factory(array $config = array())
	{
		$config['driver'] = (isset($config['driver'])) ? strtolower($config['driver']) : Dataflow_Decode::$default;
		
		$class = 'Dataflow_Decode_' . ucfirst($config['driver']);
		
		return new $class($config);
	}
	
	/**
	 * Parsed data
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_decoded = array();
	
	/**
	 * Cache driver type
	 * 
	 * @access	protected
	 * @var		string
	 */
	protected $_type;
	
	/**
	 * Default config
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_config = array();	
	
	/**
	 * Initialize
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct(array $config)
	{
		$this->_config = Arr::merge($this->_config, $config);
		
		$this->_type = $config['driver'];
		
		$this->_setup();
	}
	
	/**
	 * Decode
	 * 
	 * @access	protected
	 * @return	array
	 */
	abstract protected function _decode($data);
	
	/**
	 * Helper for drivers
	 * 
	 * @access	protected
	 * @return	void
	 */
	protected function _setup()
	{
		// intentionally left empty
	}
	
	/**
	 * Parsed input
	 * 
	 * @access	public
	 * @return	$this
	 * @throws	Kohana_Exception
	 */
	public function set($data)
	{
		if ( ! is_array($this->_decoded = $this->_decode($data)))
			throw new Kohana_Exception('Expecting Dataflow_Decode_' . ucfirst($this->type()) . '::_decode to return an array.');
		
		return $this;
	}	
	
	/**
	 * Abstract getter
	 * 
	 * @access	public
	 * @return	array
	 */
	public function & get()
	{
		return $this->_decoded;
	}
	
	/**
	 * Type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function type()
	{
		return $this->_type;
	}
}
