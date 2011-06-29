<section>

	<form id="form-users-table" method="post" action="{$URL}?plugin=USERS_MGMT&action=users_table">

		<fieldset>

			<legend>{$lang.legend.users_table}</legend>

			<ul>

				<li>

					<label for="db-table">{$lang.label.select_u_table}</label>
					{html_options name="db-table" id="db-table" options=$db_tables}

				</li>

			</ul>

		</fieldset>

		<fieldset id="fields">

			<legend>{$lang.legend.fields}</legend>

		</fieldset>

		<input style="position:fixed; right:0; top:100px" type="submit" name="USERS_MGMT-submit" id="USERS_MGMT-submit" value="{$lang.submit.users_table}" />

	</form>

</section>