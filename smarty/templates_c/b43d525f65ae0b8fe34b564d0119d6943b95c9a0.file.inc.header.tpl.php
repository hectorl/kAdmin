<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:12
         compiled from "/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/includes/inc.header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19076053424df26bd86c0a99-58431802%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b43d525f65ae0b8fe34b564d0119d6943b95c9a0' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/includes/inc.header.tpl',
      1 => 1307732820,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19076053424df26bd86c0a99-58431802',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_replace')) include '/home/share/KETE_PROJECTS/kAdmin/includes/libs/SMARTY/plugins/modifier.replace.php';
?><div id="USERS_MGMT-header">

	<ul>

		<li><?php echo $_smarty_tpl->getVariable('lang')->value['text']['wellcome'];?>
 <b><?php echo smarty_modifier_replace($_smarty_tpl->getVariable('session')->value['name'],'\\','');?>
</b></li>
		<li class="actions">

			<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=USERS_MGMT&amp;action=your_data"><span><?php echo $_smarty_tpl->getVariable('lang')->value['button']['your_data'];?>
</span></a>
			<a href="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=USERS_MGMT&amp;action=signout"><span><?php echo $_smarty_tpl->getVariable('lang')->value['button']['close_session'];?>
</span></a>

		</li>

	</ul>

	<img width="100" src="<?php echo $_smarty_tpl->getVariable('URL_PLUG')->value;?>
USERS_MGMT/img/default-avatar-user.png" alt="<?php echo $_smarty_tpl->getVariable('session')->value['name'];?>
" />

</div>