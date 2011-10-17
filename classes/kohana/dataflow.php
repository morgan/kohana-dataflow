<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Library
 * 
 * Supports PHP 5.2.3 or greater.
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
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
		'input'		=> array(),
		'output'	=> array()
	);

	/**
	 * Dataflow Input
	 * 
	 * @access	protected
	 * @var		Dataflow_Input|array
	 */
	protected $_input = array();
	
	/**
	 * Dataflow Output
	 * 
	 * @access	protected
	 * @var		Dataflow_Output|NULL
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
			$this->_input = Dataflow_Input::factory($this->_config['input'])->set($input);
		}
		
		// Reset output due to new input
		$this->_output = NULL;
		
		return $this;
	}
	
	/**
	 * Get output
	 * 
	 * @access	public
	 * @return	Dataflow_Output
	 */
	public function get()
	{
		if ($this->_output === NULL)
		{
			$input = ($this->_input instanceof Dataflow_Input) ? $this->_input->get() : $this->_input;
		
			$this->_output = Dataflow_Output::factory($this->_config['output'])->set($input);
		}
		
		return $this->_output;
	}
	
	/**
	 * Magic method for converting object to string
	 * 
	 * @access	public
	 * @return	string
	 */
	public function __toString()
	{
		return (string) $this->get();
	}	
	
	/**
	 * Render output
	 * 
	 * @access	public
	 * @return	$this
	 */
	public function render()
	{
		$this->get()->render();
		
		return $this;
	}
}