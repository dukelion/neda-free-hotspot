{include file="head.tpl"}
<div id="login">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="content">
                    <div class="row header">
                        <div class="span2"><img src="images/nato.png"></div>
                    </div>
                    <div class="login_workspace">
                        <div class="loadbar_block">
                            <div class="text">{$count} users out of {$maxcount} maximum are now
                                online, {if $limit}please wait{else}you can log in now{/if}</div>
                            <br/>
                        </div>
                        <div class="login_form">
                            <FORM method="post" ACTION="{$hotspotUrl}/login">
                                <div class="left">
                                    <div class="input">
                                        <input type="text" value="{$ticket}" name="userlogin" placeholder="Ticket code"
                                               class="login" {if $limit}disabled="true" {/if}>
                                    </div>
                                    <div class=""></div>
                                </div>
                                <div class="right">
                                    <input type="submit" value="Get Access" name="Login"
                                           {if $limit}disabled="true" {/if}>
                                </div>
                            </FORM>
                        </div>
                    </div>
                    <div class="span12" style="padding-bottom: 77px;"></div>

{include file="foot.tpl"}