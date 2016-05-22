<?php
// API Include paths
require __DIR__ . '/webservices.php';


// Default Paths
$app->get(API_PATH . '/hello/{name}', 'helloName');
$app->get(API_PATH . '/hello/', 'helloName');
$app->get('/hello/', 'helloName');
$app->get('/hello/{name}', 'helloName');
$app->get('/{name}', 'helloName');
$app->get('/', 'helloName');


function helloName($request, $response, $args) {
	$name = 'world';
	if (isset($args['name'])) {
		$name = $args['name'];
	}
	$res["Hello"] = $name;
    return $response->withJson($res);
}

//-- test api request header and body
$app->get(API_PATH . '/test', testAPIHeaderBody);
$app->post(API_PATH . '/test', testAPIHeaderBody);
$app->put(API_PATH . '/test', testAPIHeaderBody);
$app->delete(API_PATH . '/test', testAPIHeaderBody);

function testAPIHeaderBody($request, $response, $args) {
	$res["request"]["header"] = getRequestHeader($request);
	$res["request"]["body"] = getRequestBody($request);
    return $response->withJson($res);
}

// //// -- slim default locations
// $app->get('/[{name}]', function ($request, $response, $args) {
//     // Sample log message
//     $this->logger->info("Slim-Skeleton '/' route");

//     // Render index view
//     return $this->renderer->render($response, 'index.phtml', $args);
// });
