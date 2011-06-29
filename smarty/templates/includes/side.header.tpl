<header>

	<p id="kadmin-logo"><a href="{$URL}" title="Home"><span>Bienvenido a k!Admin!</span></a></p>

	{foreach $layout.header as $tpl}

		{include file=$tpl.dir}

	{/foreach}

</header>