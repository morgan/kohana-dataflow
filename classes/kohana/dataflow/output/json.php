<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Output JSON Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Output_Json extends Dataflow_Output
{	
	/**
	 * Get content type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function get_content_type()
	{
		return 'application/json';
	}	
	
	/**
	 * Transform
	 * 
	 * @access	public
	 * @return	string
	 */
	protected function _transform(array $data)
	{
		// Force return of object if array empty
		if (empty($data))
			return '{}';
		else
			return json_encode($data);
	}	
}