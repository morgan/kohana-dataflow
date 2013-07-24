<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Decode XML Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Decode_XML extends Dataflow_Decode
{
	/**
	 * Default config
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_config = array
	(
		':attributes'	=> ':attributes'
	);
	
	/**
	 * Parser
	 * 
	 * @access	protected
	 * @var		NULL|resource
	 */
	protected $_parser;
	
	/**
	 * Decode
	 * 
	 * @access	protected
	 * @return	array
	 */
	protected function _decode($data)
	{
		$this->_parser = xml_parser_create();

		xml_set_object($this->_parser, $this);
		xml_set_element_handler($this->_parser, '_open', '_close');
		xml_set_character_data_handler($this->_parser, '_data');        

		xml_parser_set_option($this->_parser, XML_OPTION_CASE_FOLDING, FALSE);

		xml_parse($this->_parser, $data);

		if (is_array($this->_decoded))
			return $this->_decoded;

		return array();
	}

	/**
	 * Handle open
	 * 
	 * @access	protected
	 * @param	resource
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	protected function _open($parser, $index, $attributes) 
	{
		if (isset($this->_decoded[$index][$this->_config[':attributes']])) 
		{
			$key = 1;
			
			$this->_decoded[$index] = array($this->_decoded[$index]);
		} 
		else if (isset($this->_decoded[$index]))
		{
			$key = count($this->_decoded[$index]);
		}

		if (isset($key)) 
		{
			$this->_decoded[$index][$key] = array
			(
				'key' 		=> $key,
				'parent' 	=> & $this->_decoded
			);
			
			$this->_decoded =& $this->_decoded[$index][$key];
		} 
		else 
		{
			$this->_decoded[$index] = array
			(
				'parent' => & $this->_decoded
			);
			
			$this->_decoded =& $this->_decoded[$index];
		}

		if ( ! empty($attributes))
		{
			$this->_decoded[$this->_config[':attributes']] = $attributes;
		}
	}
	
	/**
	 * Handle close
	 * 
	 * @access	protected
	 * @param	resource
	 * @param	string
	 * @return	void
	 */
	protected function _close($parser, $index) 
	{
		$pointer =& $this->_decoded;

		if (isset($this->_decoded['key']))
		{
			unset($pointer['key']);
		}

		$this->_decoded =& $this->_decoded['parent'];

		unset($pointer['parent']);

		if (isset($pointer['data']) AND count($pointer) == 1)
		{
			$pointer = $pointer['data'];
		}
		else if (empty($pointer['data']) OR $pointer['data'] == 0)
		{
			unset($pointer['data']);
		}
	} 

	/**
	 * Handle data
	 * 
	 * @access	protected
	 * @param	resource
	 * @param	array
	 * @return	void
	 */
	protected function _data($parser, $data) 
	{
		$this->_decoded['data'] = $data;
	}
}
