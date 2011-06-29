<?php /* Smarty version Smarty-3.0.7, created on 2011-06-11 16:51:38
         compiled from "/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/inc.html_header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12246415404df380fa23ee78-65967470%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '958a0aa4fdc4efc37a6444dae00d124b6de8253b' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/inc.html_header.tpl',
      1 => 1307803894,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12246415404df380fa23ee78-65967470',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<meta charset="UTF-8" />
<!--
<link rel="shortcut icon" href="<?php echo $_smarty_tpl->getVariable('IMG')->value;?>
favicon.ico" />
<link rel="icon" href="<?php echo $_smarty_tpl->getVariable('IMG')->value;?>
favicon.ico" type="image/x-icon" />
-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.6/jquery-ui.min.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('JS')->value;?>
jquery.validate.pack.js"></script>
<script src="<?php echo $_smarty_tpl->getVariable('JS')->value;?>
globals.js.php"></script>
<script src="<?php echo $_smarty_tpl->getVariable('JS')->value;?>
kadmin.js"></script>
		
<?php  $_smarty_tpl->tpl_vars['js'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js_scripts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js']->key => $_smarty_tpl->tpl_vars['js']->value){
?>

	<script src="<?php echo $_smarty_tpl->tpl_vars['js']->value;?>
"></script>	

<?php }} ?>

<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('CSS')->value;?>
styles.php" />

<?php  $_smarty_tpl->tpl_vars['css'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('css_styles')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['css']->key => $_smarty_tpl->tpl_vars['css']->value){
?>

	<link rel="stylesheet" href="<?php echo $_smarty_tpl->tpl_vars['css']->value;?>
" />

<?php }} ?>

<title>k!Admin</title>