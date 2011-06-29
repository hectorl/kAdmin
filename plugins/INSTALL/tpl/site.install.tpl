<!DOCTYPE html>
<html>

<head>

	{include file="includes/inc.html_header.tpl"}

<!--
	<link rel="stylesheet" href="{$URL_PLUG}INSTALL/css/install.css" />
	<script src="{$URL_PLUG}INSTALL/js/main.js"></script>
-->

</head>

<body>

	<section>

		<h1>{$lang.h1.setup}</h1>

		<form id="formLang" method="post" action="{$URL}">

			<fieldset>

				<ul>

					<li>

						<label for="lang">{$lang.label.language}</label>
						<select name="lang" id="lang" class="paises">

							{html_options options=$countries selected=$cLang}

						</select>

					</li>

				</ul>

			</fieldset>

		</form>
		
		<form id="formInstall" name="formInstall" method="post" action="{$URL}">

			<fieldset>

				<legend>{$lang.legend.install}</legend>

				<ul>

					<li>

						<label for="project">{$lang.label.project}</label>
						<input type="text" name="project" id="project" class="text required" value="Proof Kadmin" />

					</li>

					<li>

						<label for="user_kadmin">{$lang.label.user}</label>
						<input type="text" name="user_kadmin" id="user_kadmin" class="text required" value="admin" />

					</li>

					<li>

						<label for="pass_kadmin">{$lang.label.pass}</label>
						<input type="password" name="pass_kadmin" id="pass_kadmin" class="text required" value="admin" />

					</li>

					<li>

						<label for="email">E-mail</label>
						<input type="text" name="email" id="email" class="text required email" value="admin@admin.com" />

					</li>

				</ul>
				
				<fieldset>

					<legend>{$lang.legend.bd_data}</legend>

					<ul>

						<li>

							<label for="host">{$lang.label.host}</label>
							<input type="text" name="host" id="host" class="text required" value="localhost" />

						</li>

						<li>

							<label for="db">{$lang.label.db}</label>
							<input type="text" name="db" id="db" class="text required" value="pacomputer" />

						</li>

						<li>

							<label for="user">{$lang.label.user}</label>
							<input type="text" name="user" id="user" class="text required" value="root" />

						</li>

						<li>

							<label for="pass">{$lang.label.pass}</label>
							<input type="password" name="pass" id="pass" class="text required" value="mysqlgerty" />

						</li>

						<li>

							<label for="multilang">{$lang.label.multilang}</label>
							<input type="checkbox" name="multilang" id="multilang" />

						</li>

						<li>

							<label for="group_users">{$lang.label.group_users}</label>
							<input type="checkbox" name="group_users" id="group_users" />

						</li>

					</ul>

				</fieldset>
				
				<p><input type="submit" name="submitInstall" id="submitInstall" value="{$lang.submit.send}" /></p>

			</fieldset>

		</form>

	</section>

</body>
</html>
	
	

