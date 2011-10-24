# Dataflow Module

Simple way of translating to or from XML, YAML, JSON and serialized PHP. Great for general 
usage or incorporating into a REST API.

	// Example of converting XML to YAML
	echo Dataflow::factory()->set($xml);
	
	// Convert any supported format to a standardized array
	Dataflow::factory()->set($input)->as_array();

## Getting Started

Recommend starting out with Dataflow documentation locally using the User Guide module.

## Learning & References

- User Guide
- API Browser
- Unit Tests

## Version 0.2.0

This is release version 0.2.0 of [Dataflow](https://github.com/michealmorgan/kohana-dataflow).