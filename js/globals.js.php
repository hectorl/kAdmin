<?php
	/**
	 * @author		Héctor Laura
	 */
	
	header('Content-type: text/javascript');
	
	$rutaReal = dirname(__FILE__);
	$dir = str_replace('\\', '/', $rutaReal);
	$dir = str_replace('/js', '', $dir);

	require($dir . '/includes/configs/config.inc.php');
	require(DIR_LANGS . $_COOKIE[COOKIE_LANG] . '.php');
	
?>

jQuery.extend(jQuery.validator.messages, {
    required: "<?php echo $LANG['validation']['required']; ?>",
    remote: "<?php echo $LANG['validation']['remote']; ?>",
    email: "<?php echo $LANG['validation']['email']; ?>",
    url: "<?php echo $LANG['validation']['url']; ?>",
    date: "<?php echo $LANG['validation']['date']; ?>",
    dateISO: "<?php echo $LANG['validation']['dateISO']; ?>",
    number: "<?php echo $LANG['validation']['number']; ?>",
    digits: "<?php echo $LANG['validation']['digits']; ?>",
    creditcard: "<?php echo $LANG['validation']['creditcard']; ?>",
    equalTo: "<?php echo $LANG['validation']['equalTo']; ?>",
    accept: "<?php echo $LANG['validation']['accept']; ?>",
    maxlength: jQuery.validator.format("<?php echo $LANG['validation']['maxlength']; ?>"),
    minlength: jQuery.validator.format("<?php echo $LANG['validation']['minlength']; ?>"),
    rangelength: jQuery.validator.format("<?php echo $LANG['validation']['rangelength']; ?>"),
    range: jQuery.validator.format("<?php echo $LANG['validation']['range']; ?>"),
    max: jQuery.validator.format("<?php echo $LANG['validation']['max']; ?>"),
    min: jQuery.validator.format("<?php echo $LANG['validation']['min']; ?>")
});

var URL_SITE = '<?php echo str_replace('js', '', URL_KAD); ?>';
var URL_PLUG = '<?php echo str_replace('js', '', URL_PLUG); ?>';
