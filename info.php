<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/30/13
 * Time: 7:29 AM
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();

//check if already logged in
$badgeId = fSession::get('badgeid');
if (!$badgeId) { //is not logged in
    fSession::destroy();
    fURL::redirect("login.php");
    exit(0);
}

$ticket = getTicket($db, $badgeId);
if ($ticket) {
    $expirets = $ticket{'expirets'};
} else {
    fURL::redirect("login.php");
    exit(0);
}
$user = getUser($db, $badgeId);

$ticketpass = $ticket{'ticketpass'};

$hsoriginalURL = filter_var(fRequest::get('r'), FILTER_SANITIZE_URL, array('options' => FILTER_FLAG_STRIP_BACKTICK, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
$originalURL = trim($hsoriginalURL, "'");

$originalURL = $originalURL ? $originalURL : "http://google.com";

$online = isTicketOnline($ticketpass);

$now = time();
$min = floor(($expirets - $now) / 60);
$sec = ($expirets - $now) % 60;

$page->assign('username', $user{'fullname'});
$page->assign('refresh', true);
$page->assign('online', $online);
$page->assign('ticketpass', $ticketpass);
$page->assign('originalUrl', $originalURL);
$page->assign('expiremin', $min);
$page->assign('expiresec', $sec);
$page->assign('hotspotUrl', HOTSPOT_URL);
$page->display('info.tpl');