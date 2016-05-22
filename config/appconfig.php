<?php

function getMD5Hash($str) {
	return md5(APP_HASH_1 . $str . APP_HASH_2);
}

function getUserToken($userEmail) {
		return getMD5Hash($_SERVER['REMOTE_ADDR'] . $userEmail . time());
}

function getRequestHeader($request) {
  $headers = $request->getHeaders();
  $res = null;
  foreach ($headers as $name => $values) {
    $res[$name] = implode(", ", $values);
  }
  return $res;//$request->getHeaders();
}

function getRequestBody($request) {
  return $request->getParsedBody();
}

function getError($errMsg, $errCode, $other = null) {
  return getResponse($errMsg, $errCode, $other, false);
}

function getResponse($msg, $code = 200, $other = null, $status = true) {
  $res["status"] = $status;
  $res["code"] = $code;
  $res["Data"] = $msg;
  $res["OtherMsg"] = $other;
  return $res;
}


/* Use below code for header testing
//-- checking header 
$headerRes = checkHeader(getRequestHeader($request));
if($headerRes != null) { return $response->withJson(getError($headerRes, ERROR_HEADER_MISSING)); }
*/
function checkHeader($header) {
  if (isset($header)) {
    if (!isset($header[HEADER_APP_USER_AGENT])) {
      return "Header User Agent param missing";  
    } 
  } else {
    return "Header missing";
  }
  return null;
}

