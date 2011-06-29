<div id="USERS_MGMT-header">

	<ul>

		<li>{$lang.text.wellcome} <b>{$session.name|replace:'\\':''}</b></li>
		<li class="actions">

			<a href="{$URL}?plugin=USERS_MGMT&amp;action=your_data"><span>{$lang.button.your_data}</span></a>
			<a href="{$URL}?plugin=USERS_MGMT&amp;action=signout"><span>{$lang.button.close_session}</span></a>

		</li>

	</ul>

	<img width="100" src="{$URL_PLUG}USERS_MGMT/img/default-avatar-user.png" alt="{$session.name}" />

</div>