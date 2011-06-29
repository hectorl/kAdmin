<?php /* Smarty version Smarty-3.0.7, created on 2011-06-12 19:48:58
         compiled from "/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.users_table.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19780028924df4fc0a1bdd54-57051468%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e8b8db0d65da29eeb6ed4ad296dd9fe84e61882' => 
    array (
      0 => '/home/share/KETE_PROJECTS/kAdmin/plugins/USERS_MGMT/tpl/site.users_table.tpl',
      1 => 1307900934,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19780028924df4fc0a1bdd54-57051468',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_html_options')) include '/home/share/KETE_PROJECTS/kAdmin/includes/libs/SMARTY/plugins/function.html_options.php';
?><section>

	<form id="form-users-table" method="post" action="<?php echo $_smarty_tpl->getVariable('URL')->value;?>
?plugin=USERS_MGMT&action=users_table">

		<fieldset>

			<legend><?php echo $_smarty_tpl->getVariable('lang')->value['legend']['users_table'];?>
</legend>

			<ul>

				<li>

					<label for="db-table"><?php echo $_smarty_tpl->getVariable('lang')->value['label']['select_u_table'];?>
</label>
					<?php echo smarty_function_html_options(array('name'=>"db-table",'id'=>"db-table",'options'=>$_smarty_tpl->getVariable('db_tables')->value),$_smarty_tpl);?>


				</li>

			</ul>

		</fieldset>

		<fieldset id="fields">

			<legend><?php echo $_smarty_tpl->getVariable('lang')->value['legend']['fields'];?>
</legend>

		</fieldset>

		<input style="position:fixed; right:0; top:100px" type="submit" name="USERS_MGMT-submit" id="USERS_MGMT-submit" value="<?php echo $_smarty_tpl->getVariable('lang')->value['submit']['users_table'];?>
" />

	</form>

</section>