<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Input JSON Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Input_Json extends Dataflow_Input
{	
	/**
	 * Parsed input
	 * 
	 * @access	public
	 * @return	$this
	 */
	public function set($data)
	{
		$this->_parsed = json_decode($data, TRUE);
		
		return $this;
	}
}