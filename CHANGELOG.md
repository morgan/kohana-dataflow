# 0.5.0 - 07/23/2013

- Resolved separate issues with encoding and decoding of XML attributes
- Added unit tests to test against newly resolved issues
- Added documentation on how to encode and decode XML attributes
- Updated copyright years
- All tests pass: "OK (27 tests, 27 assertions)"

# 0.4.1 - 12/10/2012

- Resolved class case (correctly renamed class files and directories)
- Updated documentation to reflect new driver case
- All tests pass: "OK (25 tests, 25 assertions)"

# 0.4.0 - 12/06/2012

- Renamed `Encode::get_content_type` to `Encode::content_type`
- Removed `Encode::_setup` and `Decode::_setup` due to limited usage, using constructor instead
- Resolved issue with decoding XML attributes
- Upgraded to support Kohana 3.3
- Renamed class files and directories to support PSR-0
- Resolved pass by reference issue (now testing in strict mode)
- Expanded user guide documentation and unit test coverage
- All tests pass: "OK (25 tests, 25 assertions)"

# 0.3.0 - 04/09/2012

- Added JSON-P encode and decode support.
- Added "pluralize" option for XML encode. This enables children indexes to be wrapped in a plural key 
while children dynamically use singular keys. Example `array('values' => array('a', 'b'))` to 
`<values><value>a</value><value>b</value></values>`. This keeps other serialized formats free of 
the singular keys when using more than one driver for output.
- All tests pass: "OK (20 tests, 20 assertions)"

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
