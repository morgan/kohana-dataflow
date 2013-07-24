<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow
 * 
 * @note		Tests directory `dataflow`, when renamed to `Dataflow`, creates a segfault 
 * 				on Debian 6.0.5 (Squeeze) upon running PHPUnit.
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011-2013 Micheal Morgan
 * @license		MIT
 */
abstract class Kohana_DataflowTest extends Unittest_TestCase
{
	/**
	 * Factory to return Dataflow object configured for driver.
	 * 
	 * @access	public
	 * @return	Dataflow
	 */
	abstract public function factory();

	/**
	 * Sample provider
	 * 
	 * @access	public
	 * @return	array
	 */
	public function provider_samples()
	{
		return array
		(
			array
			(
				// test empty array
				array()
			),
			array
			(
				// test indexed array with a variety of variable types
				array
				(
					'samples' => array
					(
						'sample' => array('string(value)', 1)
					)
				)
			),
			array
			(
				// test associative array
				array
				(
					'key1' => array
					(
						'key2_1'	=> 'value2_1', 
						'key2_2'	=> array
						(
							'key3_1'	=> 'value_3_1',
							'key3_2'	=> 'value_3_2'
						)
					)
				)
			),
			array
			(
				// test attribute handling
				array
				(
					'parent' => array
					(
						':attributes'	=> array('key1' => 'value1'),
						'child'			=> array
						(
							'value1',
							'value2'
						)
					)
				)
			),
			array
			(
				// Test nesting with attributes
				'parent' => array
				(
					'child' => array
					(
						':attributes'	=> array('key1' => 'value1', 'key2' => 'value2'),
						'child_child'	=> array
						(
							'key1' => 'value2'
						)
					)
				)
			)
		);
	}

	/**
	 * Test by encoding sample and comparing original array with decoded
	 * 
	 * @covers			Dataflow::factory
	 * @covers			Dataflow::set
	 * @covers			Dataflow::get
	 * @covers			Dataflow::as_array
	 * @covers			Dataflow_Decode::factory
	 * @covers			Dataflow_Decode::get
	 * @covers			Dataflow_Decode::set
	 * @covers			Dataflow_Decode::_decode
	 * @covers			Dataflow_Encode::factory
	 * @covers			Dataflow_Encode::get
	 * @covers			Dataflow_Encode::set
	 * @covers			Dataflow_Encode::_encode
	 * @dataProvider	provider_samples
	 * @access			public
	 * @param			array
	 * @return			void
	 */
	public function test_samples(array $sample)
	{
		$dataflow = $this->factory();
		
		// Set sample input
		$dataflow->set($sample);
		
		// Get encoded
		$encoded = $dataflow->get();

		// Decode encoded
		$dataflow->set($encoded);

		// Test decoded matches original sample
		$this->assertEquals($sample, $dataflow->as_array());
	}
}
