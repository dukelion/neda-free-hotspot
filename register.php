<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 7/2/13
 * Time: 4:35 PM
 * To change this template use File | Settings | File Templates.
 */

require_once dirname(__FILE__) . "/config.php";
include_once dirname(__FILE__) . "/helpers.php";

$db = dbconnect();


$badgeid = fRequest::get('badgeid');
$password2 = fRequest::get('password2');
$password = fRequest::get('password');
$email = fRequest::get('email');
$phone = fRequest::get('phone');

//validate

$validator = new fValidation();
$validator->addRequiredFields("badgeid");
$validator->addRequiredFields("password");
$validator->addRequiredFields("password2");
$validator->addEmailFields("email");
$message = $validator->validate(true);

$validator->addStringReplacement('Please enter a value', ' required');

//store to database

//send activation email

//send phone call notification


$page->assign("error",$message);
$page->display("register.tpl");