<section>

	<form id="formuUserData" method="post" enctype="multipart/form-data" action="{$URL}?plugin=USERS_MGMT&amp;action=your_data">

		<fieldset>

			<legend>Set user data <span class="button-wrap"><input type="submit" id="USERS_MGMT-submit" name="USERS_MGMT-submit" value="{$lang.submit.user_data}" /></span></legend>
			

			<ul>

				<li>

					<label for="name">Name</label>
					<input type="text" name="name" id="name" value="{$session.name|escape}" />

				</li>

				<li>

					<label for="email">E-mail</label>
					<input type="text" name="email" id="email" value="{$session.email}" />

				</li>

				<li>

					<label for="old_pass">Old pass</label>
					<input type="text" name="old_pass" id="old_pass" value="" />

				</li>

				<li>

					<label for="pass">New pass</label>
					<input type="text" name="pass" id="pass" value="" />

				</li>

				<li>

					<label for="re_pass">Repeat new pass</label>
					<input type="text" name="re_pass" id="re_pass" value="" />

				</li>

				<li>

					<label for="avatar">Avatar<span><img width="50" src="{$URL_PLUG}USERS_MGMT/img/default-avatar-user.png" alt="{$session.name}" /></span></label>
					<input type="file" name="avatar" id="avatar" />

					{if $session.avatar eq ''}


					{/if}

				</li>

			</ul>

		</fieldset>

	</form>

	{if isset($msg)}

		<div class="{$msg.type}">{$msg.text}</div>

	{/if}

</section>