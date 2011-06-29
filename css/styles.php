<?php
	/** 
	 * @author	Reinhold Weber
	 * 
	 */

	header('Content-type: text/css');
  	ob_start("compress");
  	
  	function compress($buffer) {
		/* remove comments */
		$buffer = preg_replace('!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $buffer);
		/* remove tabs, spaces, newlines, etc. */
		$buffer = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $buffer);
		
		return $buffer;
	}//fin compress

	/* your css files */
	include('html5reset.css');
	include('custom-theme/jquery-ui-1.8.13.custom.css');
	include('colors_and_fonts.css');
	include('message_boxes.css');
	include('general.css');
	include('header.css');
	include('content.css');
	include('forms.css');
	include('nav.css');
	include('footer.css');

	ob_end_flush();