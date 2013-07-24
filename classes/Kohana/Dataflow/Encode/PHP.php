<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Encode PHP Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Encode_PHP extends Dataflow_Encode
{
	/**
	 * Get content type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function content_type()
	{
		return 'application/php';
	}
	
	/**
	 * Encode
	 * 
	 * @access	protected
	 * @return	string
	 */
	protected function _encode(array $data)
	{
		return serialize($data);
	}
}
