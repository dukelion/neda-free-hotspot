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
$authorizedRequest = false;

$sessionBadgeId = fSession::get('badgeid');
//check if already logged in
if ($sessionBadgeId) {
    $authorizedSession = true;
}


$page->display("password.tpl");