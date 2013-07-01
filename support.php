<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/30/13
 * Time: 3:02 PM
 * To change this template use File | Settings | File Templates.
 */

include_once dirname(__FILE__) . "/config.php";

$offline = is_null(fSession::get('badgeid'));

$page->assign("offline",$offline);
$page->display("support.tpl");