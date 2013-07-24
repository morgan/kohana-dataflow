# Dataflow Module

Simple way of translating to or from XML, YAML, JSON, JSON-P and serialized PHP. Great for general 
usage or incorporating into a REST API.

	// Set drivers (each key is config that passes through to its respective library, 
	// `decode` to `Dataflow_Decode` and `encode` to `Dataflow_Encode`)
	$config = array
	(
		'decode' => array('driver' => 'YAML'),
		'encode' => array('driver' => 'XML')
	);

	// Example of converting XML to YAML and outputting results
	echo Dataflow::factory($config)->set($xml);
	
	// Convert any supported format to a standardized array
	Dataflow::factory()
		->set($input)
		->as_array();

	// Decode XML to an associative array
	$array = Dataflow_Decode::factory(array('driver' => 'XML'))
		->set($xml)
		->get();

	// Encode associative array to XML
	$xml = Dataflow_Encode::factory(array('driver' => 'XML'))
		->set($array)
		->get();

## Getting Started

Recommend starting out with Dataflow documentation using the User Guide module or available 
online at http://dev.morgan.ly/kohana/v3.3/guide/dataflow/.

## Learning & References

- User Guide
- API Browser
- Unit Tests

## Version 0.5.0

This is release version 0.5.0 of [Dataflow](https://github.com/morgan/kohana-dataflow).
