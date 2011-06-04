<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Input Abstract
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
abstract class Kohana_Dataflow_Input 
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
		$config['driver'] = (isset($config['driver'])) ? $config['driver'] : self::$default;
		
		$class = 'Dataflow_Input_' . ucfirst(strtolower($config['driver']));
		
		return new $class($config);
	}
	
	/**
	 * Parsed data
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_parsed = array();
	
	/**
	 * Cache driver type
	 * 
	 * @access	protected
	 * @var		string
	 */
	protected $_type;
	
	/**
	 * Initialize
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct(array $config)
	{
		$this->_config = $config;
		
		$this->_type = $config['driver'];
	}
	
	/**
	 * Abstract setter
	 * 
	 * @access	public
	 * @return	$this
	 */
	abstract public function set($data);
	
	/**
	 * Abstract getter
	 * 
	 * @access	public
	 * @return	array
	 */
	public function & get()
	{
		return $this->_parsed;
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