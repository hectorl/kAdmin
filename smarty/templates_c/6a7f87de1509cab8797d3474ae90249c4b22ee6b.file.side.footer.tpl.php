<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:12
         compiled from "/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8944883944df26bd8731264-11334195%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6a7f87de1509cab8797d3474ae90249c4b22ee6b' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/smarty/templates/includes/side.footer.tpl',
      1 => 1300640184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8944883944df26bd8731264-11334195',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<footer>

	<?php if (isset($_smarty_tpl->getVariable('layout',null,true,false)->value['footer'])){?>

		<?php  $_smarty_tpl->tpl_vars['tpl'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('layout')->value['footer']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tpl']->key => $_smarty_tpl->tpl_vars['tpl']->value){
?>
	
			<?php $_template = new Smarty_Internal_Template($_smarty_tpl->tpl_vars['tpl']->value['dir'], $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	
		<?php }} ?>

	<?php }?>

	<p id="html5-logo">

		<a href="http://www.w3.org/html/logo/" target="blank" title="Powered by HTML5"><span>Powered by HTML5</span></a>

	</p>

</footer>
