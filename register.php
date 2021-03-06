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

if (fRequest::isPost()){
    try {
        fRequest::validateCSRFToken(fRequest::get('csrftoken'));
    } catch (fValidationException $e) {
//        $csrf = true;
        trigger_error("csrf attempt: ",$e->printMessage());
        fURL::redirect("register.php");
    }
//validate
    $fields = array (
        'badgeid' => fRequest::get('badgeid'),
        'password2' => fRequest::get('password2'),
        'password' => fRequest::get('password'),
        'email' => fRequest::get('email'),
        'phone' => fRequest::get('phone'),
    );
    $badgeid = fRequest::get('badgeid');
    $password2 = fRequest::get('password2');
    $password = fRequest::get('password');
    $email = fRequest::get('email');
    $phone = fRequest::get('phone');

    $validator = new fValidation();
    $validator->addRequiredFields("badgeid");
    $validator->addRequiredFields("password");
    $validator->addRequiredFields("password2");
    if ($email) { $validator->addEmailFields("email"); };
    if (fRequest::check("password")) { $validator->addValidValuesRule("password2",fRequest::get("password")); };

    $validator->addCallbackRule('badgeid',"userExists","already registered");

    $validator->overrideFieldName(array(
        'badgeid'       => 'ISAF Badge ID#',
        'password' => 'Password',
        'password2' => 'Retype password'
    ));
    $validator->addStringReplacement('Please enter a value', ' required');
    $validator->addStringReplacement('Please enter an email address in the form name@example.com',' address invalid');
    $validator->addStringReplacement('Please choose from one of the following:',' not match');
    $message = $validator->validate(true);


if (is_null($message)){
    trigger_error("it's ok saving user:" . $fields);
}

//send activation email

//send phone call notification
}



$page->assign("fields",$fields);
$csrftoken = fRequest::generateCSRFToken();
$page->assign("csrftoken",$csrftoken);
$page->assign("error",$message);
$page->display("register.tpl");