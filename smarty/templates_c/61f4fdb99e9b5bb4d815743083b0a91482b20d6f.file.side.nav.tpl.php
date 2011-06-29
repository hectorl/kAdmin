<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:12
         compiled from "/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.nav.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20226793504df26bd86f28b3-08562044%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61f4fdb99e9b5bb4d815743083b0a91482b20d6f' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.nav.tpl',
      1 => 1307730955,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20226793504df26bd86f28b3-08562044',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<nav>

	<?php if (isset($_smarty_tpl->getVariable('layout',null,true,false)->value['nav'])){?>

		<ul>
	
			<?php  $_smarty_tpl->tpl_vars['nav'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('layout')->value['nav']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['nav']->key => $_smarty_tpl->tpl_vars['nav']->value){
?>
	
				<li><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=<?php echo $_smarty_tpl->tpl_vars['nav']->value['plugin'];?>
&action=<?php echo $_smarty_tpl->tpl_vars['nav']->value['href'];?>
"><span><?php echo $_smarty_tpl->tpl_vars['nav']->value['button'];?>
</span></a></li>
	
			<?php }} ?>
	
		</ul>

	<?php }?>

	<?php if (isset($_smarty_tpl->getVariable('layout',null,true,false)->value['sidebar'])){?>

		<?php  $_smarty_tpl->tpl_vars['tpl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('layout')->value['sidebar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tpl']->key => $_smarty_tpl->tpl_vars['tpl']->value){
?>

			<?php $_template = new Smarty_Internal_Template($_smarty_tpl->tpl_vars['tpl']->value['dir'], $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

		<?php }} ?>

	<?php }?>

</nav>