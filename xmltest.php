<?php
/**
 * Created by JetBrains PhpStorm.
 * User: dukelion
 * Date: 6/22/13
 * Time: 9:10 PM
 * To change this template use File | Settings | File Templates.
 */
require_once dirname(__FILE__) . "/config.php";
$xml = '<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE Accounts [
	<!ELEMENT Accounts ((Account+))>
	<!ELEMENT Account ((Username,Password,TimeUsed,TimeLeft,UnlimitedTime,Quota,UnlimitedQuota,GroupPlanID,AccessFromTo,AccessID,Expire,ExpireIn,ExpireAfter,
                      EnableDailyTime,DailyTime,EnableDailyQuota,DailyQuota,EnableDailyLogins,DailyLogins,Download,Upload,GenerateID ))>
	<!ELEMENT Username (#PCDATA)>
	<!ELEMENT Password (#PCDATA)>
	<!ELEMENT TimeUsed (#PCDATA)>
	<!ELEMENT TimeLeft (#PCDATA)>
	<!ELEMENT UnlimitedTime (#PCDATA)>
	<!ELEMENT Quota (#PCDATA)>
	<!ELEMENT UnlimitedQuota (#PCDATA)>
	<!ELEMENT GroupPlanID (#PCDATA)>
	<!ELEMENT AccessFromTo (#PCDATA)>
	<!ELEMENT AccessID (#PCDATA)>
	<!ELEMENT Expire (#PCDATA)>
	<!ELEMENT ExpireIn (#PCDATA)>
	<!ELEMENT ExpireAfter (#PCDATA)>
	<!ELEMENT EnableDailyTime (#PCDATA)>
	<!ELEMENT DailyTime (#PCDATA)>
	<!ELEMENT EnableDailyQuota (#PCDATA)>
	<!ELEMENT DailyQuota (#PCDATA)>
	<!ELEMENT EnableDailyLogins (#PCDATA)>
	<!ELEMENT DailyLogins (#PCDATA)>
	<!ELEMENT Download (#PCDATA)>
	<!ELEMENT Upload (#PCDATA)>
	<!ELEMENT GenerateID (#PCDATA)>
]>
<Accounts><Account><Username>AFD7005023-E</Username><Password></Password><TimeUsed>0</TimeUsed><TimeLeft>3600</TimeLeft><UnlimitedTime>False</UnlimitedTime><Quota>0</Quota><UnlimitedQuota>True</UnlimitedQuota><GroupPlanID>2</GroupPlanID><AccessFromTo>False</AccessFromTo><AccessID>0</AccessID><Expire>2013-06-22 17:45:47</Expire><ExpireIn>1</ExpireIn><ExpireAfter>1</ExpireAfter><EnableDailyTime>False</EnableDailyTime><DailyTime>0</DailyTime><EnableDailyQuota>False</EnableDailyQuota><DailyQuota>0</DailyQuota><EnableDailyLogins>False</EnableDailyLogins><DailyLogins>0</DailyLogins><Download>131072</Download><Upload>65536</Upload><GenerateID>12</GenerateID></Account></Accounts>';

$xml = '<?xml version="1.0" encoding="UTF-8"?><Accounts><Account><Username>AFD75023-6YN8DN</Username><Password></Password><TimeUsed>0</TimeUsed><TimeLeft>1169</TimeLeft><UnlimitedTime>False</UnlimitedTime><Quota>1</Quota><UnlimitedQuota>True</UnlimitedQuota><GroupPlanID>2</GroupPlanID><AccessFromTo>False</AccessFromTo><AccessID>0</AccessID><EnableExpire>True</EnableExpire><Expire>2013-06-30 08:53:00</Expire><ExpireIn>0</ExpireIn><ExpireAfter>0</ExpireAfter><EnableDailyTime>False</EnableDailyTime><DailyTime>0</DailyTime><EnableDailyQuota>False</EnableDailyQuota><DailyQuota>0</DailyQuota><EnableDailyLogins>False</EnableDailyLogins><DailyLogins>0</DailyLogins><Download>0</Download><Upload>0</Upload><GenerateID>3</GenerateID><Loggedin>0</Loggedin><DailyQuotaLeft>0</DailyQuotaLeft><FirstUsed>2013-06-30 08:53:04</FirstUsed><LastUsed>2013-06-30 08:53:04</LastUsed></Account></Accounts>';

$fxml = new fXML($xml);
$result = $fxml->xpath("//Accounts/Account/Loggedin", true);
var_dump($result);
var_dump($result->getText());


