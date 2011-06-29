<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:12
         compiled from "/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:10791469154df26bd86a9823-79691198%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2a14c526c12e4cff15e37dc4b93cb2ac84858261' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.header.tpl',
      1 => 1300640184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '10791469154df26bd86a9823-79691198',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<header>

	<p id="kadmin-logo"><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
" title="Home"><span>Bienvenido a k!Admin!</span></a></p>

	<?php  $_smarty_tpl->tpl_vars['tpl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('layout')->value['header']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tpl']->key => $_smarty_tpl->tpl_vars['tpl']->value){
?>

		<?php $_template = new Smarty_Internal_Template($_smarty_tpl->tpl_vars['tpl']->value['dir'], $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

	<?php }} ?>

</header>