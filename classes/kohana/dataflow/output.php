<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Output Abstract
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
abstract class Kohana_Dataflow_Output 
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
	 * @return	Dataflow_Output
	 */
	public static function factory(array $config = array())
	{
		$config['driver'] = (isset($config['driver'])) ? $config['driver'] : self::$default;
		
		$class = 'Dataflow_Output_' . ucfirst(strtolower($config['driver']));
		
		return new $class($config);
	}
	
	/**
	 * Data array
	 * 
	 * @access	protected
	 * @var		array|string
	 */
	protected $_data = array();
	
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
	 * Abstract content type for headers
	 * 
	 * @access	public
	 * @return	string
	 */
	abstract public function get_content_type();	
	
	/**
	 * Transform array to driver format. Return value.
	 * 
	 * @access	public
	 * @param	array
	 * @return	string
	 */
	abstract protected function _transform(array $data);
	
	/**
	 * Get method. Internal caching of transformed array.
	 * 
	 * @access	public
	 * @return	string
	 */
	public function & get()
	{
		if (is_array($this->_data))
		{
			$this->_data = $this->_transform($this->_data);
		}
		
		return $this->_data;
	}
	
	/**
	 * Set data array
	 * 
	 * @access	public
	 * @return	array
	 */
	public function set(array $data)
	{
		$this->_data = $data;
		
		return $this;
	}
	
	/**
	 * Alternative method call for get
	 * 
	 * @access	public
	 * @return	array
	 */
	public function as_array()
	{
		return $this->_data;
	}
	
	/**
	 * Magic method for converting object to string
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		$this->_headers();
		
		return $this->get();
	}
	
	/**
	 * Render output to screen using proper headers.
	 * 
	 * @access	public
	 * @return	$this
	 */
	public function render()
	{
		$this->_headers();
		
		echo $this->get();
		
		return $this;
	}
	
	/**
	 * Handle headers
	 * 
	 * @access	public
	 * @return	$this
	 */
	protected function _headers()
	{
		// Suppress passing of headers when no request - example during CLI for unit testing
		if ($request = Request::current())
		{
			$request->response()->headers('content-type', $this->get_content_type());
		}
		
		return $this;
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