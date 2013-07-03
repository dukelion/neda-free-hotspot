<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/30/13
 * Time: 6:10 PM
 */

require_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();

$password = fRequest::get("password");
$notify = false;

$authorizedSession = false;

$sessionBadgeId = fSession::get('badgeid');
//check if already logged in
if ($sessionBadgeId) {
    $authorizedSession = true;
}

//validate input

//re-check old password

//save new password




$page->display("password.tpl");