<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Encode Abstract
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
abstract class Kohana_Dataflow_Encode 
{
	/**
	 * Default driver
	 * 
	 * @static
	 * @access	public
	 * @var		string
	 */
	public static $default = 'JSON';
	
	/**
	 * Factory pattern
	 * 
	 * @static
	 * @access	public
	 * @return	Dataflow_Output
	 */
	public static function factory(array $config = array())
	{
		$config['driver'] = (isset($config['driver'])) ? $config['driver'] : Dataflow_Encode::$default;
		
		$class = 'Dataflow_Encode_' . $config['driver'];
		
		return new $class($config);
	}
	
	/**
	 * Data array
	 * 
	 * @access	protected
	 * @var		string
	 */
	protected $_encoded = '';
	
	/**
	 * Cache driver type
	 * 
	 * @access	protected
	 * @var		string|NULL
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
	}
	
	/**
	 * Abstract content type for headers
	 * 
	 * @access	public
	 * @return	string
	 */
	abstract public function content_type();
	
	/**
	 * Transform array to driver format. Return value.
	 * 
	 * @access	protected
	 * @param	array
	 * @return	string
	 */
	abstract protected function _encode(array $data);
	
	/**
	 * Encode array to string
	 * 
	 * @access	public
	 * @return	array
	 */
	public function set(array $data)
	{
		if ( ! is_string($this->_encoded = $this->_encode($data)))
			throw new Kohana_Exception('Expecting `Dataflow_Encode_' . $this->type() . '::_encode` to return a string.');
		
		return $this;
	}	
	
	/**
	 * Get encoded
	 * 
	 * @access	public
	 * @return	string
	 */
	public function & get()
	{
		return $this->_encoded;
	}

	/**
	 * Magic method for converting object to string. Intentionally not passing headers because 
	 * object is casted to a string.
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
	 * @param	bool	Whether or not to handle headers
	 * @param	mixed	Request|NULL	Request object for modifying headers
	 * @return	$this
	 */
	public function render($headers = TRUE, Request $request = NULL)
	{
		if ($headers)
		{
			$this->_headers($request);
		}
		
		echo $this->get();
		
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
	
	/**
	 * Handle headers
	 * 
	 * @access	public
	 * @return	$this
	 */
	protected function _headers(Request $request = NULL)
	{
		$request = ($request) ? $request : Request::current();
		
		// Suppress passing of headers when no request - example during CLI for unit testing
		if ($request)
		{
			$request->response()->headers('content-type', $this->get_content_type());
		}
		
		return $this;
	}
}
