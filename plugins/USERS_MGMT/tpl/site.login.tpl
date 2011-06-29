{include file="includes/inc.html_header.tpl"}

<body>

	<section id="login">

		<h1><span>{$lang.h1.login}</span></h1>

		<form id="formLogin" name="formLogin" method="post" action="{$URL}">

			<fieldset>

				<legend>{$lang.legend.login}</legend>

				<ul>

					<li>
						<label for="user">{$lang.label.user}</label>
						<input type="text" name="user" id="user" class="text required" />
					</li>

					<li>
						<label for="pass">{$lang.label.pass}</label>
						<input type="password" name="pass" id="pass" class="text required" />
					</li>

				</ul>
				
				<p><input type="submit" name="USERS_MGMT-submit" id="USERS_MGMT-submit" value="{$lang.submit.login}" /></p>

			</fieldset>

		</form>

		{if isset($msg)}

			<div class="{$msg.type}">

				{$msg.text}

			</div>	

		{/if}

	</section>

</body>

</html>
	
	

