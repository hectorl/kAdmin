<?php /* Smarty version Smarty-3.0.7, created on 2011-06-11 13:32:43
         compiled from "/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.user_welcome.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20138139814df3525becc2b0-96671519%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'de3830c74b653ff29cc3dff60ce8f289b4ad553d' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.user_welcome.tpl',
      1 => 1307791961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '20138139814df3525becc2b0-96671519',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<section>

	<h1>Bienvenido <?php echo $_smarty_tpl->getVariable('session')->value['name'];?>
!</h1>

	<?php if ($_smarty_tpl->getVariable('users_mgmt_installed')->value){?>

		<p>Todo instalado</p>

	<?php }else{ ?>

		<p>Antes de nada, necesitas <b>asignar una tabla para guardar a los usuarios</b>. Tienes <b>dos opciones</b>:</p>

		<ul>

			<li><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=USERS_MGMT&action=users_table&new" title="">Asignar una tabla de usuarios a partir de una ya existente</a></li>
			<li><a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=USERS_MGMT&action=users_table&default" title="">Generar una tabla predefinida</a></li>

		</ul>

	<?php }?>

</section>
