<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:12
         compiled from "/home/share/KETE_PROJECTS/kAdmin/smarty/templates/site.main.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7784389234df26bd8652fb6-03879894%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e6d80f8033df0bd1f37e5a6c9fc93cbd3b11baef' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/smarty/templates/site.main.tpl',
      1 => 1307731578,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7784389234df26bd8652fb6-03879894',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html>
<html>

	<head>

		<?php $_template = new Smarty_Internal_Template("includes/inc.html_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

	</head>

	<body>

		<?php $_template = new Smarty_Internal_Template("includes/side.header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

		<?php $_template = new Smarty_Internal_Template("includes/side.nav.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl')->value), $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

		<?php $_template = new Smarty_Internal_Template("includes/side.footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		
	</body>

</html>