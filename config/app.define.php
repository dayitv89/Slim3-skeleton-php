<?php

// App Constant 
define('APP_HASH_1', 'asdf89sdfjwer93aksdfhks932o4n23nsduf789sar23hsjdfs');
define('APP_HASH_2', 'sdresdfjs7823794234hjhwehrkwh87sdfhjsfsesdfhsd87sd');

define('APP_SEPARATOR', 'AxsS12#@1xss');

// App header constant 
define('HEADER_HOST', 'Host');
define('HEADER_HTTP_USER_AGENT', 'HTTP_USER_AGENT');
define('HEADER_ACCEPT_LANGUAGE', 'HTTP_ACCEPT_LANGUAGE');
define('HEADER_ACCEPT_TIMEZONE', 'HTTP_ACCEPT_TIMEZONE');
define('HEADER_APP_USER_AGENT', 'HTTP_USERAGENT');
define('HEADER_USER_TOKEN', 'HTTP_USERTOKEN');


// API constants 
define('API_PATH_V1','/api/v1');

// APP Defined Error codes
require __DIR__ . '/../config/Error.code.php';

//-- Define active API path
define('API_PATH', API_PATH_V1);