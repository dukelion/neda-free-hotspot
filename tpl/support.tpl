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
                        <div class="plate">
                            <div class="left" style="visibility: hidden">
                                <form action="info.php"
                                "><input type="submit" value="INFO"></div>
                            <div class="center">
                                <div class="message_background">
                                    <div class=message>
                                        <div class="text">
                                            <p>For inquiries and customer assistance,<br> please contact us at:</p>
                                            <p>Email: <nobr>ifone-neda@ifoneinc.com</nobr></p>
                                            <p>Mobile: AWCC 0702506077 / Roshan 0798679599</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="right">
                                {if $offline}
                                    <form action="login.php"><input type="submit" value="Log In"></form>
                                {else}
                                    <form action="info.php"><input type="submit" value="INFO"></form>
                                {/if}

                            </div>
                        </div>
                    </div>
{include file="foot.tpl"}