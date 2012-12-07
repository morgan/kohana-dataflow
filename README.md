# Dataflow Module

Simple way of translating to or from XML, YAML, JSON, JSON-P and serialized PHP. Great for general 
usage or incorporating into a REST API.

	// Example of converting XML to YAML
	echo Dataflow::factory()->set($xml);
	
	// Convert any supported format to a standardized array
	Dataflow::factory()->set($input)->as_array();

## Getting Started

Recommend starting out with Dataflow documentation using the User Guide module or available 
online at http://dev.morgan.ly/kohana/v3.3/guide/dataflow/.

## Learning & References

- User Guide
- API Browser
- Unit Tests

## Version 0.4.0

This is release version 0.4.0 of [Dataflow](https://github.com/morgan/kohana-dataflow).
