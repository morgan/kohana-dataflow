<?php defined('SYSPATH') OR die('Kohana bootstrap needs to be included before tests run');
/**
 * Tests Dataflow
 * 
 * @group		dataflow
 * @package		Dataflow
 * @category	Tests
 * @author		Micheal Morgan <micheal@morgan.ly>
 * @copyright	(c) 2011 Micheal Morgan
 * @license		MIT
 */
class Kohana_DataflowTest extends Unittest_TestCase
{	
	/**
	 * Data provider for JSON samples
	 *
	 * @access	public
	 * @return	array
	 */
	public static function provider_json()
	{
		return array
		(
			// empty
			array
			(
				array(),
				'{}'
			),
			// indexed array
			array
			(
				array('a', 'b', 'c', 'd'),
				'["a","b","c","d"]'
			),
			// key/value array
			array
			(
				array('key' => 'value'),
				'{"key":"value"}'
			)
		);
	}
	
	/**
	 * Run input/output on Json provider
	 * 
	 * @covers			Dataflow::set
	 * @covers			Dataflow::get
	 * @covers			Dataflow::__toString
	 * @dataProvider	provider_json
	 */
	public function test_json($set, $expected)
	{
		$dataflow = Dataflow::factory(array('output' => array('driver' => 'json')));
		
		$dataflow->set($set);
	
		$this->assertSame
		(
			$expected,
			(string) $dataflow
		);		
	}
}