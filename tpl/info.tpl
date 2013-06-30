{include file="head.tpl" refresh=$refresh}
<div id="login">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="content">
                    <div class="row header">
                        <div class="span2"><img src="http://103.244.144.20/hotspot-test/images/nato.png"></div>
                        {if isset($username)}
                            <div class="span8"><h2>Welcome, {$username}!</h2></div>{/if}
                    </div>
                    <div class="login_workspace">

                        <div class="plate">
                            <div class="left" {if !$originalUrl}style="visibility: hidden"{/if}>
                                <form action="{$originalUrl}" target="_blank"><input type="submit" value="Continue">
                                </form>
                            </div>
                            <div class="center">
                                <div class="message_background">
                                    <div class=message>Account {$ticketpass} <br>is {if $online}online
                                            <br>
                                            {if !$originalUrl}
                                                If you cannot browse Internet, your account is probably in use on a different device.
                                                <br>
                                                Try to re-login.</br>
                                            {/if}
                                            Online time expire in {$expiremin}:{$expiresec|string_format:"%02d"}{else}offline{/if}
                                    </div>
                                </div>
                                <!--{$smarty.now}-->
                            </div>
                            {if $online}
                                <div class="right">
                                <form action="logout.php"
                                ">
                                <input type="submit" value="Logout">
                                </form>
                            {*<form action="password.php""><input type="submit" value=Password>*}
                                </div>{else}
                                <div class="right">
                                    <form action="login.php"
                                    "><input type="submit" value="Login"></form></div>
                            {/if}
                            {*<div class="right"><form action="password.php""><input type="submit" value="Change Password"></form></div>*}
                        </div>
                    </div>
{include file="foot.tpl"}