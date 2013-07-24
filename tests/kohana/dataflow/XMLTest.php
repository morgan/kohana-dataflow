<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow XML driver
 *
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
class Kohana_Dataflow_XMLTest extends Kohana_DataflowTest
{
	/**
	 * Factory pattern
	 * 
	 * @access	public
	 * @return	Dataflow
	 */
	public function factory()
	{
		return Dataflow::factory(array('encode' => array('driver' => 'XML'), 'decode' => array('driver' => 'XML')));
	}

	/**
	 * Sample provider
	 * 
	 * @access	public
	 * @return	array
	 */
	public function provider_xml()
	{
		return array
		(
			array
			(
				array
				(
					'parent' => array
					(
						'child' => array
						(
							':attributes'	=> array('key1' => 'value1', 'key2' => 'value2')
						)
					)
				),
				'<?xml version="1.0" encoding="UTF-8"?>
<parent>
 <child key1="value1" key2="value2"/>
</parent>
'
			)
		);
	}

	/**
	 * Test XML encoding
	 * 
	 * @covers			Dataflow_Encode::factory
	 * @covers			Dataflow_Encode::get
	 * @covers			Dataflow_Encode::set
	 * @covers			Dataflow_Encode::_encode
	 * @dataProvider	provider_xml
	 * @access			public
	 * @param			array
	 * @return			void
	 */
	public function test_xml_encode($decoded, $encoded)
	{
		// Setup XML encode driver
		$encode = Dataflow_Encode::factory(array('driver' => 'XML'));

		// Set decoded array
		$encode->set($decoded);

		// Test newly encoded matches decoded
		$this->assertEquals($encode->get(), $encoded);
	}

	/**
	 * Test XML decoding
	 * 
	 * @covers			Dataflow_Encode::factory
	 * @covers			Dataflow_Encode::get
	 * @covers			Dataflow_Encode::set
	 * @covers			Dataflow_Encode::_encode
	 * @dataProvider	provider_xml
	 * @access			public
	 * @param			array
	 * @return			void
	 */
	public function test_xml_decode($decoded, $encoded)
	{
		// Setup XML decode driver
		$decode = Dataflow_Decode::factory(array('driver' => 'XML'));

		// Set decoded array
		$decode->set($encoded);

		// Test newly decoded matches decoded
		$this->assertEquals($decode->get(), $decoded);
	}
}
