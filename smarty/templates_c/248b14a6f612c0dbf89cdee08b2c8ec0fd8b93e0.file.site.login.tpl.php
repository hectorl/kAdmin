<?php /* Smarty version Smarty-3.0.7, created on 2011-06-10 21:09:08
         compiled from "/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14604454534df26bd49d56e1-70070438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '248b14a6f612c0dbf89cdee08b2c8ec0fd8b93e0' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.login.tpl',
      1 => 1300640184,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14604454534df26bd49d56e1-70070438',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php $_template = new Smarty_Internal_Template("includes/inc.html_header.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<body>

	<section id="login">

		<h1><span><?php echo $_smarty_tpl->getVariable('lang')->value['h1']['login'];?>
</span></h1>

		<form id="formLogin" name="formLogin" method="post" action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
">

			<fieldset>

				<legend><?php echo $_smarty_tpl->getVariable('lang')->value['legend']['login'];?>
</legend>

				<ul>

					<li>
						<label for="user"><?php echo $_smarty_tpl->getVariable('lang')->value['label']['user'];?>
</label>
						<input type="text" name="user" id="user" class="text required" />
					</li>

					<li>
						<label for="pass"><?php echo $_smarty_tpl->getVariable('lang')->value['label']['pass'];?>
</label>
						<input type="password" name="pass" id="pass" class="text required" />
					</li>

				</ul>
				
				<p><input type="submit" name="USERS_MGMT-submit" id="USERS_MGMT-submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['submit']['login'];?>
" /></p>

			</fieldset>

		</form>

		<?php if (isset($_smarty_tpl->getVariable('msg',null,true,false)->value)){?>

			<div class="<?php echo $_smarty_tpl->getVariable('msg')->value['type'];?>
">

				<?php echo $_smarty_tpl->getVariable('msg')->value['text'];?>


			</div>	

		<?php }?>

	</section>

</body>

</html>
	
	

