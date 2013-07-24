<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Encode JSON-P Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2012-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Encode_JSONP extends Dataflow_Encode
{
	/**
	 * Default config
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_config = array
	(
		'callback' => 'callback'
	);
	
	/**
	 * Get content type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function content_type()
	{
		return 'application/json-p';
	}
	
	/**
	 * Encode
	 * 
	 * @access	protected
	 * @return	string
	 */
	protected function _encode(array $data)
	{
		// Force return of object if array empty
		$data = empty($data) ? '{}' : json_encode($data);

		return $this->_config['callback'] . '(' . $data . ')';
	}
}
