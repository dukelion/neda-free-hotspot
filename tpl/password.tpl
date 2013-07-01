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
                        <form action="password.php" method="POST">
                            <div class="login_form">
                                <div class="left" style="margin-top: 52px">
                                    <div class="chpassword">
                                        <input type="password" value="" name="password" placeholder="Current password"
                                               class="password">
                                    </div>
                                    <div class="chpassword">
                                        <input type="password" value="" name="npassword1" placeholder="New password"
                                               class="password">
                                    </div>
                                    <div class="chpassword">
                                        <input type="password" value="" name="npassword2"
                                               placeholder="Retype new password" class="password">
                                    </div>
                                </div>
                        </form>
                        <div class="right"><input type="submit" class="narrow" value="Change">

                            <form action="info.php"
                            "><input type="submit" class="narrow" value="Back"></form></div>
                    </div>
{include file="foot.tpl"}