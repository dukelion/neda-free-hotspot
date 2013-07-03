<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/26/13
 * Time: 7:22 PM
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . "/config.php";

function dbconnect()
{
    $db = mysqli_connect("p:".DBHOST, DBUSER, DBPASS, DBNAME);

    if (mysqli_connect_errno($db)) {
        //database connection failed
        trigger_error("Could not connect to database " . mysqli_error($db));
        fURL::redirect("error.php");
    }
    $query = "SET NAMES utf8";
    mysqli_query($db,$query);
    return $db;
}

function TicketExists($badgeid)
{
    $db = dbconnect();
    $query = sprintf("select badgeid from ticket where badgeid = '%s' and expirets > unix_timestamp()", mysqli_real_escape_string($db, $badgeid));
    $res = mysqli_query($db, $query);
    if (!$res) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } elseif (mysqli_num_rows($res)) {
        return true;
    } else {
        return false;
    }
    mysqli_free_result($res);
}

;

function getTicket($badgeid)
{
    $db = dbconnect();
    $query = sprintf("select ts,expirets,ticketpass from tickets where badgeid = '%s' and expirets > unix_timestamp()", mysqli_real_escape_string($db, $badgeid));
    $res = mysqli_query($db, $query);
    if (!$res) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } else {
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
    mysqli_free_result($res);
}

function saveTicket($badgeid, $ticketpass, $timestamp, $expirets)
{
    $db = dbconnect();
    $badgeid = mysqli_real_escape_string($db, $badgeid);
    $ticketpass = mysqli_real_escape_string($db, $ticketpass);

    $query = sprintf("insert into tickets (ts,expirets,badgeid,ticketpass,location) values ('%s','%s','%s','%s','%s')", $timestamp, $expirets, $badgeid, $ticketpass, 1);
    mysqli_query($db, $query);
    if (mysqli_errno($db)) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } else {
        return;
    }
}


function getActiveTicketsCount()
{
    $db = dbconnect();
    $query = sprintf("select count(*) as count from tickets where expirets > unix_timestamp()");
    $res = mysqli_query($db, $query);
    if (!$res) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } else {
        $row = mysqli_fetch_assoc($res);
        return $row{'count'};
    }
}

function createTicket($badgeid, $expirets)
{
    $expiretime = strftime("%Y%m%d%H%M", $expirets);
    $url = ANTAURL . "/generateaccounts?number=1&priceplan=2&autologin=1&type=2&expire=1&unlquota=1&inactivity=0&account=$badgeid-&sell=0&&length=15&pass=" . APIKEY;

    try {
        $createxml = new fXML($url, 5);
        $ticket = $createxml->xpath("//Accounts/Account/Username", true)->getText();
    } catch (fValidationException $e) {
        //account could not be created
        trigger_error("Account not created: " . $e->getMessage());
        return '';
    }
    $url = ANTAURL . "/updateaccount?account=$ticket&timeleft=" . TICKET_VALID_SECONDS . "&expiredatetime=$expiretime&unlquota=1&sell=1&pass=" . APIKEY;
    try {
        $updatexml = new fXML($url, 5);
    } catch (fValidationException $e) {
        //account could not be initialized
        trigger_error("Account not initialized: " . $e->getMessage());
        return "";
    }
    if ($updatexml->xpath("//Results/Result/Description", true)->getText() == 'SUCCESS') {
        return $ticket;
    } else {
        trigger_error("Account not initialized: Update failed parsing " . $url);
        return '';
    }

}

function expireTicket($ticket)
{
    $db = dbconnect();
    $time = time();
    $expirets = $time - $time % 60;
    $expiretime = strftime("%Y%m%d%H%M", $expirets);
    $url = ANTAURL . "/updateaccount?account=$ticket&timeleft=0&expiredatetime=$expiretime&unlquota=1&sell=1&pass=" . APIKEY;
    try {
        $updatexml = new fXML($url, 5);
    } catch (fValidationException $e) {
        //account could not be initialized
        trigger_error("Account not updated: " . $e->getMessage());
        return false;
    }
    if ($updatexml->xpath("//Results/Result/Description", true)->getText() == 'SUCCESS') {
    } else {
        return false;
        trigger_error("Account not updated: Update failed parsing " . $url);
    }
    $query = sprintf("update tickets set expirets = '%s' where ticketpass = '%s'", $expirets, $ticket);
    mysqli_query($db, $query);
    if (mysqli_errno($db)) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
        return false;
    }
    return true;
}

function isTicketOnline($ticket)
{
    $url = ANTAURL . "/viewaccount?account=$ticket&pass=" . APIKEY;
    try {
        $viewxml = new fXML($url, 5);
    } catch (fValidationException $e) {
        //account could not be initialized
        trigger_error("Could not parse XML: " . $e->getMessage() . "\n" . $e->getTraceAsString() . "\n at url: " . $url);
        return false;
    }
    return $viewxml->xpath("//Accounts/Account/Loggedin", true)->getText();
}

function getUser($badgeId)
{
    $db = dbconnect();
    $query = "select id, fullname, ctime, division, password from users where badgeid = '" . mysqli_real_escape_string($db, $badgeId) . "'";
    $res = mysqli_query($db, $query);
    if (!$res) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } else {
        $row = mysqli_fetch_assoc($res);
        return $row;
    }
}

function userExists ($badgeId){
    $db = dbconnect();
    $query = "select count(*) from users where badgeid = '".mysqli_real_escape_string($db, $badgeId) . "'";
    $res = mysqli_query($db, $query);
    if (!$res) {
        trigger_error("Could not run query: " . mysqli_error($db));
        fURL::redirect("error.php");
    } else {
        $row = mysqli_fetch_assoc($res);
        if ($row{'count'} > 0) {return true;} else {return false;}
    }
}
