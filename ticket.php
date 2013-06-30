<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/22/13
 * Time: 5:29 PM
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();

$authorizedSession = false;
$authorizedRequest = false;

$sessionBadgeId = fSession::get('badgeid');
//check if already logged in
if ($sessionBadgeId) {
    $authorizedSession = true;
}

//new login attempt
$requestBadgeId = filter_var(fRequest::get("badgeid"), FILTER_SANITIZE_STRING, array('options' => FILTER_FLAG_STRIP_BACKTICK, FILTER_FLAG_STRIP_LOW, FILTER_FLAG_STRIP_HIGH));
$password = fRequest::get("password");
$notify = false;

if (!is_null($requestBadgeId)) {
    $user = getUser($db, $requestBadgeId);
    if (!$authorizedSession and !is_null($password) and !is_null($user)) {
        if ($user{'password'} != md5($password)) {
            //wrong password
            $notify = true;
        } else {
            $authorizedRequest = true;
        }
    }
}
if ($authorizedRequest) {
    fCookie::set("badgeid", $requestBadgeId, "+1 year");
    fSession::set('badgeid', $requestBadgeId);
    $badgeId = $requestBadgeId;
} elseif ($authorizedSession) {
    $badgeId = $sessionBadgeId;
} else {
    //Authorization failed
    fURL::redirect("login.php" . ($notify ? "?wrong" : ""));
    exit(0);
}
//all authorization checks finished
if (isset($badgeId)) {
    $alreadyOnline = false;
    $ticket = getTicket($db, $badgeId);
    if (!is_null($ticket)) {
        $alreadyOnline = isTicketOnline($ticket{'ticketpass'});
    }
    if ($alreadyOnline) {
        fURL::redirect("info.php");
    } else {
        // authorized and not online
        $onlineCount = getActiveTicketsCount($db);
        $limit = true;
        if ($onlineCount < ONLINE_LIMIT) {
            $ticket = getTicket($db, $badgeId);
            $ticket = $ticket{'ticketpass'};
            if (!$ticket) {
                $timestamp = time();
                $timestamp = $timestamp - $timestamp % 60;
                $expirets = $timestamp + TICKET_VALID_SECONDS;
                $ticket = createTicket($badgeId, $expirets);
                if (!$ticket) {
                    trigger_error("Ticket not created");
                    fURL::redirect("error.php");
                    exit(0);
                }
                saveTicket($db, $badgeId, $ticket, $timestamp, $expirets);
            };
            $limit = false;
        } else {
            $ticket = '';
        }

        $page->assign("online", $alreadyOnline);
        $page->assign("limit", $limit);
        $page->assign("maxcount", ONLINE_LIMIT);
        if ($limit) {
            $page->assign('refresh', true);
        };
        $page->assign('count', $onlineCount);
        $page->assign('ticket', $ticket);
        $page->assign('hotspotUrl', HOTSPOT_URL);
        $page->display("ticket.tpl");

    }

}
?>