<meta charset="UTF-8" />
<!--
<link rel="shortcut icon" href="{$IMG}favicon.ico" />
<link rel="icon" href="{$IMG}favicon.ico" type="image/x-icon" />
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
<script src="{$JS}jquery.validate.pack.js"></script>
<script src="{$JS}globals.js.php"></script>
<script src="{$JS}kadmin.js"></script>
		
{foreach $js_scripts as $js}

	<script src="{$js}"></script>	

{/foreach}

<link rel="stylesheet" href="{$CSS}styles.php" />

{foreach $css_styles as $css}

	<link rel="stylesheet" href="{$css}" />

{/foreach}

<title>k!Admin</title>