<nav>

	{if isset($layout.nav)}

		<ul>
	
			{foreach $layout.nav as $nav}
	
				<li><a href="{$URL}?plugin={$nav.plugin}&action={$nav.href}"><span>{$nav.button}</span></a></li>
	
			{/foreach}
	
		</ul>

	{/if}

	{if isset($layout.sidebar)}

		{foreach $layout.sidebar as $tpl}

			{include file=$tpl.dir}

		{/foreach}

	{/if}

</nav>