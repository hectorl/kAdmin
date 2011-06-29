<section>

	<h1>Bienvenido {$session.name}!</h1>

	{if $users_mgmt_installed}

		<p>Todo instalado</p>

	{else}

		<p>Antes de nada, necesitas <b>asignar una tabla para guardar a los usuarios</b>. Tienes <b>dos opciones</b>:</p>

		<ul>

			<li><a href="{$URL}?plugin=USERS_MGMT&action=users_table&new" title="">Asignar una tabla de usuarios a partir de una ya existente</a></li>
			<li><a href="{$URL}?plugin=USERS_MGMT&action=users_table&default" title="">Generar una tabla predefinida</a></li>

		</ul>

	{/if}

</section>
