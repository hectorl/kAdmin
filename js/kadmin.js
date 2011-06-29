var KADMIN = {

	/**
	 * Muestra un campo de jQuery UI simulando un alert.
	 */
	alert: function(msg){

		$($('<div />').html(msg))
			.dialog({

				title:'Mensaje',
				modal: true,
				buttons: {
					'Cerrar': function() {
						$(this).dialog('close');
				}//fin buttons

			}//fin dialog

		});

	}

}
