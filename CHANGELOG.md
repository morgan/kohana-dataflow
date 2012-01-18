# 0.3.0

- Added "pluralize" option for XML encode. This enables children indexes to be wrapped in a plural key 
while children dynamically use singular keys. Example `array('values' => array('a', 'b'))` to 
`<values><value>a</value><value>b</value></values>`. This keeps other serialized formats free of 
the singular keys when using more than one driver for output.

# 0.2.0 - 10/19/2011

- Added support for XML, YAML and serialized PHP
- Renamed `Dataflow_Input` to `Dataflow_Decode` and `Dataflow_Output` to `Dataflow_Encode`
- Encode and decode abstracts more consistent including expected variable types
- `Dataflow_Encode::render` now accepts `Request` for modifying Content-Type header
- Added `Dataflow::as_array` to return input array
- Refactored unit tests into an abstract for consistent sampling across drivers

# 0.1.0 - 06/04/2011

- Initial release of Dataflow with support for JSON
- `Dataflow_Input` abstraction for converting serialized format into an associative array
- `Dataflow_Output` abstraction for converting associative array into serialized format
- `Dataflow` acts as a bridge for handling input and output
- Unit test coverage