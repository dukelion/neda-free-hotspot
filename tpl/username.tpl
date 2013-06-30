{include file="head.tpl"}
<div id="login">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="content">
                    <div class="row header">
                        <div class="span2"><img src="images/nato.png"></div>
                    </div>
                    <div class="boardwalk_login_workspace">
                        <div class="login_form">
                            <FORM method="post" ACTION="ticket.php">
                                <div class="left">
                                    <div class="input">
                                        <input type="text" name="username" value="{$name}" placeholder="Full Name">
                                    </div>
                                    <div class="input">
                                        <input type="text" name="badgeid" value="{$badgeId}"
                                               placeholder="ISAF badge number">
                                    </div>
                                </div>
                                <div class="right">
                                    <input type="submit" value="Get access">
                            </FORM>
                        </div>
                    </div>
                    <div class="span12" style="height: 20px"></div>

                </div>
            </div>
        </div>
    </div>
</div>
{include file="foot.tpl"}