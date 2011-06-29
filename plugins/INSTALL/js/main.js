$(document).ready(function(){

	$('#lang').change(function(){

		$('#formLang').submit();

	});//fin change


	/*INSTALACIÓN------------------------------------------*/

		$("#formInstall").validate();


		$("#submitInstall").click(function(){

			var host = $('#host').val();
			var user = $('#user').val();
			var pass = $('#pass').val();
			var db   = $('#db').val();

			var params = {action: 'chkConnection', 
					    host: host, 
					    user: user, 
					    pass: pass, 
					    db: db};

			$.getJSON(URL_PLUG + 'INSTALL/AJAX.php', params, function(resp){

				if(resp){

					$("#formInstall").submit();

				}else{

					return false;

				}//fin else

			});//fin getJSON

		});//fin click

});//fin ready
