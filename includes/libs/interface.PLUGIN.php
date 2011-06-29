<?php

	interface PLUGIN{

		function __construct($smarty);
		function do_post();
		function do_tpl($action);
		function set_lang();

	}//fin PLUGIN
