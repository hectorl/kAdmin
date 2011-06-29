$(document).ready(function(){

	$.getJSON(URL_PLUG + 'USERS_MGMT/AJAX.php', {action: 'traductions'}, function(language){

		USERS_MGMT.init(language);

	});//fin getJSON

});//fin ready


/**
 * Clase de USERS_MGMT
 */
var USERS_MGMT = {

	lang: null,


	/**
	 * 
	 */
	init: function(language){

		USERS_MGMT.lang = language;

		$('.field-type').live('change', USERS_MGMT.change_field_type);

		$('#db-table').change(USERS_MGMT.load_html);//Fin change

	},//fin init


	/**
	 * Carga el HTML en el fieldset de campos
	 */
	load_html: function(){

		$('#fields *').not('legend:eq(0)').remove();

		var data = {action:'table_fields', table:$(this).val()};
	
		$.post(URL_PLUG + 'USERS_MGMT/AJAX.php', data, function(resp){
	
			var l = resp.length;
	
			if(l < 3){
	
				KADMIN.alert(USERS_MGMT.lang.msg.n_fields_required.replace('{fields_length}', l));
	
			}else{
	
				if(!USERS_MGMT.check_primary_key(resp)){
	
					KADMIN.alert(USERS_MGMT.lang.msg.key_field_required);
	
				}else{
	
					var table_fields  = USERS_MGMT.fields_list(resp);
					var hash_options  = USERS_MGMT.load_hash_types();
	
					for(var i = 0; i < l; ++i){
	
						fieldset = $('<fieldset />')
							.addClass('level2')
							.append($('<legend />').text(resp[i].Field))
							.append($('<ul />')
									.append($('<li />')
											.append($('<label />').attr('for', 'alias_' + i).text('Alias'))
											.append($('<input />').attr({'type': 'text', 'name': 'alias[]', 'id': 'alias_' + i}))
										)
									.append($('<li />')
											.append($('<label />').attr('for', 'list_' + i).text(USERS_MGMT.lang.label.show_in_list))
											.append($('<input />').attr({'type': 'checkbox', 'name': 'list[]', 'id': 'list_' + i}))
										)
									.append($('<li />')
											.append($('<label />').attr('for', 'type_' + i).text(USERS_MGMT.lang.label.type))
											.append($('<select />').attr({'name': 'type[]', 'id': 'type_' + i}).addClass('field-type').html(USERS_MGMT.load_field_types(resp[i])))
										)
									.append($('<li />').addClass('extra'))
									.append($('<input />').attr({'type': 'hidden', 'name':'field[]',}).val(resp[i].Field))
							);
	
						USERS_MGMT.add_extra_fields(resp[i], fieldset.find('.extra'));
	
						$('#fields').append(fieldset);
	
					}//fin for
				
					$('#fields').show();
	
				}//fin else
	
			}//fin else
	
		}, 'json');

	},//fin load_html


	/**
	 * Comprueba si existe una clave primaria entre los campos
	 * 
	 * @param		array	fields		campos de la tabla cargada
	 * @param		bool			true -> existe | false -> no existe
	 */
	check_primary_key: function(fields){
	
		var l = fields.length;
	
		for(var i = 0; i < l; ++i){
	
			if(fields[i].Key == 'PRI'){
	
				return true;
	
			}//fin if
	
		}//fin for
	
		return false;
	
	},//fin check_primary_key


	/**
	 * Carga los tipos de hash para el campo id
	 */
	load_hash_types: function(){
	
		var cod = '<option value="">' + USERS_MGMT.lang.option.none + '</option>' +
				'<option value="sha1">sha1</option>' +
				'<option value="md5">md5</option>';

		return cod;

	},//fin load_hash_type


	/**
	 * Devuelve los campos como un conjunto de options para un select
	 */
	fields_list: function(fields){

		var option_fields = '<option value="">Selecciona un campo...</option>';
		var l = fields.length;

		for(var i = 0; i < l; ++i){

			option_fields += '<option value="' + fields[i].Field + '">' + fields[i].Field + '</option>';

		}//fin for

		return option_fields;

	},//fin fields_list


	/**
	 * Carga los tipos de campos
	 */
	load_field_types: function(field){

		var option_fields = '<option value="">Selecciona un tipo de campo...</option>';

		option_fields += '<option ' + ((field.Key == 'PRI') ? 'selected' : '') + ' value="id">identificador</option>';
		option_fields += '<option value="user">usuario</option>';
		option_fields += '<option value="pass">contraseña</option>';
		option_fields += '<option value="image">imagen / avatar</option>';
		option_fields += '<option value="active">activo / inactivo</option>';
		option_fields += '<option ' + ((field.Type == 'datetime' || field.Type == 'timestamp' || field.Type == 'date') ? 'selected' : '') + ' value="date">fecha</option>';

		return option_fields;

	},//fin load_field_types


	/**
	 * Carga los tipos de campos
	 */
	load_id_extra: function(){

		var option_fields = '<option value="">Selecciona tipo de id...</option>';

		option_fields += '<option value="auto_increment">autoincrementable</option>';
		option_fields += '<option value="random">aleatorio único (string)</option>';

		return option_fields;

	},//fin load_field_types


	/**
	 * En caso de tener seleccionado un tipo por defecto, carga su campo extra
	 */
	add_extra_fields: function(field, element){

		if((field.Key == 'PRI') && field.Extra == 'auto_increment'){

			USERS_MGMT.load_extra_field('id', field.Field, element.parent().parent());

		}else if(field.Type == 'datetime' || field.Type == 'timestamp' || field.Type == 'date'){

			USERS_MGMT.load_extra_field('date', field.Field, element.parent().parent());

		}//fin else if

	},//fin add_extra_fields


	/**
	 * Muestra campos extra dependiendo del tipo al cambiar el tipo de campo
	 */
	change_field_type: function(){

		var parent = $(this).parent().parent();
console.log(parent.find('input[type=hidden]').val());
		USERS_MGMT.load_extra_field($(this).val(), parent.find('input[type=hidden]').val(), parent);

	},//fin change_field_type


	/**
	 * Carga campos extra dependiendo del tipo
	 */
	load_extra_field: function(type, field, parent){

		parent.find('.extra').html('');

		switch(type){

			case 'id':

				parent.find('.extra')
					.append($('<label />').attr('for', 'id_type_').text('Tipo de identificador'))
					.append($('<select />').attr({'name': 'extra[' + field + '][id_type]', 'id': 'id_type_'}).html(USERS_MGMT.load_id_extra()));
	
				break;

			case 'pass':

				parent.find('.extra')
					.append($('<label />').attr('for', 'hash_type_').text('Tipo de hash'))
					.append($('<select />').attr({'name': 'extra[' + field + '][hash_type]', 'id': 'has_type_'}).html(USERS_MGMT.load_hash_types()));

				break;

			case 'image':

				parent.find('.extra')
					.append($('<label />').attr('for', 'dir_img_').text('URL de la imagen'))
					.append($('<input />').attr({'type': 'text', 'name': 'extra[' + field + '][dir_img]', 'id': 'dir_img_'}));
	
				break;

		}//fin switch

	}//load_extra_field

}//fin USERS_MGMT