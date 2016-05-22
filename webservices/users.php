<?php
//-- this page defined path
define('API_PATH_USER', API_PATH . '/users');

//-- users API paths
$app->post(API_PATH_USER . '/signup','signupUser');
$app->post(API_PATH_USER . '/login','loginUser');


//-- public api methods
function signupUser($request, $response, $args) {
    //-- checking header 
    $headerRes = checkHeader(getRequestHeader($request));
    if($headerRes != null) { return $response->withJson(getError($headerRes, ERROR_HEADER_MISSING)); }

    $reqParam = getRequestBody($request);
    if (!(isset($reqParam["fullname"]) &&
        isset($reqParam["phone"]) && 
        isset($reqParam["password"]) &&
        isset($reqParam["email"]) )) {
        return $response->withJson(getError("Invalid param or required param missing", ERROR_DB_INCONSISTENCY));
    }
    
    $user_agent = getRequestHeader($request)[HEADER_APP_USER_AGENT];
    $query = "INSERT INTO `users` (`fullname`, `phone`, `hashed_password`, `email`, `fb_uid`, `last_used`, `avatar_file`, `avatar_remote_url`, `created_at`, `updated_at`, `user_agent`, `last_user_agent`, `invite_code`, `invited_by`, `device_platform`, `pn_token`, `active`)
     VALUES (:fullname, :phone, :password, :email, NULL, '0', NULL, NULL, UTC_TIMESTAMP(), UTC_TIMESTAMP(), '$user_agent', '$user_agent', '', NULL, 'iOS', '', '1')";
    try {
    	$db = getPDB();

    	$stmt = $db->prepare($query);
    	$stmt->bindParam("fullname", $reqParam["fullname"]);
        $stmt->bindParam("phone", $reqParam["phone"]);
        $password = getMD5Hash($reqParam["password"]);
        $stmt->bindParam("password", $password);
    	$stmt->bindParam("email", $reqParam["email"]);
    	$stmt->execute();
    	$user_id = $db->lastInsertId();
    	return getUserInfo($user_id, $response, $db);
    } catch(PDOException $e) {
    	//error_log($e->getMessage(), 3, '/var/tmp/php.log');
        if ($e->getCode() == '23000') {
            return $response->withJson(getError('User already exist', ERROR_USER_PRECONDITION, $e->getMessage()));
        } else {
            return $response->withJson(getError($e->getMessage(), ERROR_DB_INCONSISTENCY));
        }
    }
}

function loginUser($request, $response, $args) {
    //-- checking header 
    $headerRes = checkHeader(getRequestHeader($request));
    if($headerRes != null) { return $response->withJson(getError($headerRes, ERROR_HEADER_MISSING)); }

    $reqParam = getRequestBody($request);

    if (!(isset($reqParam["password"]) && isset($reqParam["email"]) )) {
        return $response->withJson(getError("Invalid param or required param missing", ERROR_DB_INCONSISTENCY));
    }
    
    $query = "SELECT `id`, `fullname`, `phone`, `email`, `fb_uid`, `last_used`, `avatar_file`, `avatar_remote_url`, `created_at`, `updated_at`, `invite_code`, `invited_by` FROM `users` WHERE `email` = :email AND `hashed_password` = :password";
    try {
        $db = getPDB();

        $stmt = $db->prepare($query);
        $password = getMD5Hash($reqParam["password"]);
        $stmt->bindParam("password", $password);
        $stmt->bindParam("email", $reqParam["email"]);
        $stmt->execute();
        $dbRes = $stmt->fetch(PDO::FETCH_OBJ);
        if ($dbRes == false) {
            return $response->withJson(getError('email/password mismatch', ERROR_USER_NOT_FOUND));   
        }
        return $response->withJson(getResponse($dbRes));
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        if ($e->getCode() == '23000') {
            return $response->withJson(getError('User already exist', ERROR_USER_PRECONDITION, $e->getMessage()));
        } else {
            return $response->withJson(getError($e->getMessage(), ERROR_DB_INCONSISTENCY));
        }
    }
}

//-- private methods
function getUserInfo($user_id, $response, $db = null) {
    $sql = "SELECT `id`, `fullname`, `phone`, `email`, `fb_uid`, `last_used`, `avatar_file`, `avatar_remote_url`, `created_at`, `updated_at`, `invite_code`, `invited_by` FROM `users` WHERE `id` = $user_id";
    try {
        if ($db == null) { $db = getDB(); }
        $stmt = $db->prepare($sql);
        $stmt->bindParam("user_id", $user_id);
        $stmt->execute();
        $dbRes = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        if ($dbRes == false) {
            return $response->withJson(getError('user not found/ server internal error', ERROR_DB_INCONSISTENCY));   
        }
        return $response->withJson(getResponse($dbRes));
    } catch(PDOException $e) {
        //error_log($e->getMessage(), 3, '/var/tmp/php.log');
        return $response->withJson(getError($e->getMessage(), ERROR_DB_INCONSISTENCY));
    }
}
