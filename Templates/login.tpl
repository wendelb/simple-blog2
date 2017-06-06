{include 'header.tpl'}
<div class="content">
    <h2>Login</h2>
    {if $loginError != ''}
        <div class="login-error">{$loginError}</div>
    {/if}
    <form action="/" method="post">
	    <input type="hidden" name="page" value="login" />
	    <label for="username">Benutzername</label>
	    <input type="text" name="username" id="username" />
	    <label for="password">Passwort</label>
	    <input type="password" name="password" id="password" />
	    <input type="submit" value="Anmelden" />
	</form>
</div>
{include 'footer.tpl'}