<footer>

	{if isset($layout.footer)}

		{foreach $layout.footer as $tpl}
	
			{include file=$tpl.dir}
	
		{/foreach}

	{/if}

	<p id="html5-logo">

		<a href="http://www.w3.org/html/logo/" target="blank" title="Powered by HTML5"><span>Powered by HTML5</span></a>

	</p>

</footer>
