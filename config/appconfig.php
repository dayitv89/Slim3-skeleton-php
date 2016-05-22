<?php
function getSalt1() {
	return 'asdf89sdfjwer93aksdfhks932o4n23nsduf789sar23hsjdfs';
}

function getSalt2() {
	return 'sdresdfjs7823794234hjhwehrkwh87sdfhjsfsesdfhsd87sd';
}

function getMD5Hash($str) {
	return md5(getSalt1().$str.getSalt2());
}

function getUserToken($userEmail) {
		return md5($_SERVER['REMOTE_ADDR']).getMD5Hash($userEmail.time()).md5(time());
}

function getRequestHeader($request) {
  // $headers = $request->getHeaders();
  // foreach ($headers as $name => $values) {
  //   echo $name . ": " . implode(", ", $values);
  // }
  return $request->getHeaders();
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

