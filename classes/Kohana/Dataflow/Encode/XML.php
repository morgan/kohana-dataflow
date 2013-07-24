<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Dataflow Encode XML Driver
 * 
 * @package		Dataflow
 * @category	Base
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_Encode_XML extends Dataflow_Encode
{
	/**
	 * Default config
	 * 
	 * @access	protected
	 * @var		array
	 */
	protected $_config = array
	(
		':content'		=> ':content',
		':attributes'	=> ':attributes',
		':xml'			=> ':xml',
		'pluralize'		=> FALSE
	);
	
	/**
	 * XML Writer
	 * 
	 * @access	protected
	 * @var		NULL|XMLWriter
	 */
	protected $_writer;
	
	/**
	 * Get content type
	 * 
	 * @access	public
	 * @return	string
	 */
	public function content_type()
	{
		return 'application/xml';
	}
	
	/**
	 * Encode
	 * 
	 * @access	protected
	 * @return	string
	 */
	protected function _encode(array $data)
	{
		$this->_writer = new XMLWriter;
		
		$this->_writer->openMemory();
		$this->_writer->setIndent(TRUE);
		$this->_writer->setIndentString(' ');
		$this->_writer->startDocument('1.0', 'UTF-8');
		
		$keys = array_keys($data);

		if ( ! empty($data) AND $key = array_shift($keys))
		{
			$this->_writer->startElement($key);
			
			$this->_attributes($data[$key]);

			$data =& $data[$key];
		}
		
		$this->_process($data);

		$this->_writer->endElement();
		$this->_writer->endDocument();

		return $this->_writer->outputMemory();
	}
	
	/**
	 * Process array
	 * 
	 * @access	protected
	 * @param	array
	 * @param	boolean
	 * @return	void
	 */
	protected function _process($data)
    {
		if (is_array($data) AND ! empty($data)) 
		{
			foreach ($data as $index => $element)
			{
				if (is_array($element))
				{
					if ( ! $this->_indexed($index, $element))
					{
						$this->_writer->startElement($index);
						
						$this->_attributes($element);
						$this->_content($element);
						
						if ( ! empty($element))
						{
							$this->_process($element);
						}
						
						$this->_writer->endElement();
					}
				}
				else
				{
					$this->_writer->startElement($index);
					$this->_writer->text($element);
					$this->_writer->endElement();
				}
			}
		}
	}

	/**
	 * Handle nested
	 * 
	 * @access	protected
	 * @param	string
	 * @param	array
	 * @return	boolean
	 */
	protected function _indexed($index, $element)
	{
		if (is_array($element) AND isset($element[0]))
		{
			// If "pluralize" enabled, wrap children using plural index and set children to use 
			// singular index
			if ($this->_config['pluralize'])
			{
				$this->_writer->startElement($index);
				
				$index = Inflector::singular($index);
			}
			
			foreach ($element as $key => $name)
			{
				$this->_writer->startElement($index);
				
				$this->_attributes($name);
				$this->_content($name);
				
				if ( ! empty($name))
				{
					$this->_process($name);
				}
				
				$this->_writer->endElement();
			}
			
		    if ($this->_config['pluralize'])
			{
				$this->_writer->endElement();
			}
			
			return TRUE;
		}

		return FALSE;
	}  

	/**
	 * Handle content
	 * 
	 * @access	protected
	 * @param	mixed
	 * @return	boolean
	 */
	protected function _content($element)
	{
		if (is_array($element))
		{
			if (is_array($element) AND isset($element[$this->_config[':content']]))
			{
				$this->_writer->text($element[$this->_config[':content']]);

				unset($element[$this->_config[':content']]);
				
				return TRUE;
			}
			else if (is_array($element) AND isset($element[$this->_config[':xml']])) 
			{
				$this->_writer->writeRaw($element[$this->_config[':xml']]);
				
				unset($element[$this->_config[':xml']]);
				
				return TRUE;
			}
		}
		else if ( ! is_array($element))
		{
			$this->_writer->text($element);
			
			unset($element);
			
			return TRUE;
		}

		return FALSE;
	}  

	/**
	 * Handle attributes
	 * 
	 * @access	protected
	 * @param	array
	 * @return	boolean
	 */
	protected function _attributes( & $element) 
	{
		if (is_array($element) AND isset($element[$this->_config[':attributes']])) 
		{
			foreach ($element[$this->_config[':attributes']] as $key => $value)
			{
				$this->_writer->writeAttribute($key, $value);
			}
			
			unset($element[$this->_config[':attributes']]);
			
			return TRUE;
		}

		return FALSE;
	}
}
