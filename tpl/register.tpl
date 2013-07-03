{include file="head.tpl"}
<div id="login">
    <div class="container">
        <div class="row">
            <div class="span12">
                <div class="content">
                    <div class="row header">
                        <div class="span2"><img src="images/nato.png"></div>
                        <div class="span10">{if $error}<h1>Errors processing registration<h1>{/if}</div>
                    </div>
                    <div class="login_workspace">
                        <div class="plate">
                            <div class="left" style="visibility: hidden">
                                <form action="info.php"><input type="submit" value="INFO"></form></div>
                            <div class="center">
                                        <form class="register_form" action="register.php" method="post">
                                            <input type="hidden" name="csrftoken" value="{$csrftoken}">
                                            <ul>
                                            <label>
                                                <li class="label">{if $error['badgeid']}
                                                    <div class="red">{$error['badgeid']}
                                                        {else}<div>ISAF badge ID{/if}: </div>
                                                            <input type="text" name="badgeid" value="{if $fields['badgeid']}{$fields['badgeid']}{/if}"/>
                                                </li></label>
                                            <label><li class="label"><div>{if $error['password']}
                                                        <div class="red">{$error['password']}
                                                            {else}<div>Password{/if}: </div>
                                                            <input type="password" name="password" value="{if $fields['password']}{$fields['password']}{/if}"/>
                                                </li></label>
                                            <label><li class="label"><div>{if $error['password2']}
                                                        <div class="red">{$error['password2']}
                                                            {else}<div>Retype password{/if}: </div>
                                                            <input type="password" name="password2" value="{if $fields['password2']}{$fields['password2']}{/if}"/>
                                                </li></label>
                                            <label><li class="label"><div>{if $error['email']}
                                                        <div class="red">{$error['email']}
                                                            {else}<div>Email{/if}: </div>
                                                            <input type="text" name="email" value="{if $fields['email']}{$fields['email']}{/if}"/>
                                                </li></label>
                                            <label><li class="label"><div>{if $error['phone']}
                                                        <div class="red">{$error['phone']}
                                                            {else}<div>Contact phone{/if}: </div>
                                                            <input type="text" name="phone" value="{if $fields['phone']}{$fields['phone']}{/if}"/>
                                                </li></label>
                                            </ul>
                                            <input type="submit" value="Register" class="submit"/>
                                        </form>
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