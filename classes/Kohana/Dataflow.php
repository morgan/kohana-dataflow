<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Library
 * 
 * @todo		Make error handling across drivers more consistent
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow 
{
	/**
	 * Factory pattern
	 * 
	 * @static
	 * @access	public
	 * @return	Dataflow
	 */
	public static function factory(array $config = array())
	{
		return new Dataflow($config);
	}
	
	/**
	 * Configuration
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_config = array
	(
		'decode'	=> array(),
		'encode'	=> array()
	);

	/**
	 * Decoded input as array
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_input = array();
	
	/**
	 * Dataflow Output
	 * 
	 * @access	protected
	 * @var		Dataflow_Encode|NULL
	 */
	protected $_output;
	
	/**
	 * Initialize Dataflow
	 * 
	 * @access	public
	 * @return	void
	 */
	public function __construct(array $config = array())
	{
		$this->_config = Arr::merge($config, $this->_config);
	}
	
	/**
	 * Set input
	 * 
	 * @access	public
	 * @return	$this
	 */
	public function set($input)
	{
		if (is_array($input))
		{
			$this->_input = $input;
		}
		else
		{
			$this->_input = Dataflow_Decode::factory($this->_config['decode'])
				->set($input)
				->get();
		}
		
		// Reset output due to new input
		$this->_output = NULL;
		
		return $this;
	}
	
	/**
	 * Get output
	 * 
	 * @access	public
	 * @param	bool	Whether to return encoded string or Dataflow_Encode
	 * @return	mixed	string|Dataflow_Encode
	 */
	public function get($encoded = TRUE)
	{
		if ($this->_output === NULL)
		{
			$this->_output = Dataflow_Encode::factory($this->_config['encode'])->set($this->_input);
		}
			
		return ($encoded) ? $this->_output->get() : $this->_output; 
	}
	
	/**
	 * Return array
	 * 
	 * @access	public
	 * @return	array
	 */
	public function as_array()
	{
		return $this->_input;
	}
	
	/**
	 * Magic method for converting object to string
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		return (string) $this->get(FALSE);
	}	
	
	/**
	 * Render output
	 * 
	 * @access	public
	 * @param	bool
	 * @param	mixed	Request|NULL
	 * @return	$this
	 */
	public function render($headers = TRUE, Request $request = NULL)
	{
		$this->get(FALSE)->render($headers, $request);
		
		return $this;
	}
}
