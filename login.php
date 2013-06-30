<?php

include_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();

$activeBadgeId = fSession::get("badgeid");
if ($activeBadgeId) {
    $ticket = getTicket($db, $activeBadgeId);
    if (isset($ticket) && isTicketOnline($ticket{'ticketpass'})) {
        fURL::redirect("info.php");
    } else {
//        trigger_error("active badgeid: "$activeBadgeId." ")
        fURL::redirect("ticket.php");
    }
}
$savedBadgeId = fCookie::get("badgeid");

$requestBadgeId = filter_var(fRequest::get("badgeid"), FILTER_SANITIZE_STRING, array('options' => FILTER_FLAG_STRIP_BACKTICK, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));

$badgeId = $savedBadgeId ? $savedBadgeId : $requestBadgeId;

$fail = fRequest::check("wrong");

$onlineCount = getActiveTicketsCount($db);
$limit = ($onlineCount > ONLINE_LIMIT);

$page->assign('count', $onlineCount);
$page->assign('limit', $limit);
$page->assign('fail', $fail);
$page->assign('badgeId', $badgeId);

$page->display("login.tpl");
?>
