<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/30/13
 * Time: 8:47 AM
 * To change this template use File | Settings | File Templates.
 */
require_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();

$badgeId = fSession::get('badgeid');

if (!$badgeId) { //is not logged in
    fURL::redirect("login.php");
    trigger_error("Unknow badgeid logout");
    exit(0);
} else {
    $ticket = getTicket($badgeId);
    if (expireTicket($ticket{'ticketpass'})) {
        fSession::destroy();
    } else {
        fURL::redirect("info.php");
    }
}

$page->assign("hotspotUrl", HOTSPOT_URL);
$page->display("logout.tpl");