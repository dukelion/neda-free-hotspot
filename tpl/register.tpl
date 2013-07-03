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
                                <form action="info.php"><input type="submit" value="INFO"></form></div>
                            <div class="center">
                                        <form class="register_form" action="register.php" method="post">
                                            <label class="reglabel"><div class="label">{if $error['badgeid']}{$error['badgeid']}{else}ISAF badge ID:{/if}</div><input type="text" name="badgeid" value=""/></label>
                                            <label class="reglabel"><div class="label">{if $error['password']}{$error['password']}{else}Password:{/if}</div><input type="password" name="password" value=""/></label>
                                            <label class="reglabel"><div class="label">{if $error['password2']}{$error['password2']}{else}Retype password:{/if}</div><input type="password" name="password2" value=""/></label>
                                            <label class="reglabel"><div class="label">{if $error['email']}{$error['email']}{else}Email:{/if}</div><input type="text" name="email" value="Email address"/></label>
                                            <label class="reglabel"><div class="label">{if $error['phone']}{$error['phone']}{else}Contact phone:{/if}</div><input type="text" name="phone" value="Phone number"/></label>
                                            <input type="submit" value="Register"/>
                                        </form>
                                        {if $error}<div>Please enter all the required information</div>{/if}
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