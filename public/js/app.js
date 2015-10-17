

/**
 * Mascaras dos Inputs Customers
 */
$(document).ready(function(){
    $('.customer-document').mask('000.000.000-00', {reverse: true});
    var maskBehavior = function (val) {
	 return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	options = {onKeyPress: function(val, e, field, options) {
	 field.mask(maskBehavior.apply({}, arguments), options);
	 }
	};
	 
	$('.customer-phone').mask(maskBehavior, options);

	$( ".btn-modal" ).click(function() {
    $('#counselorId').val($(this).attr("value"));
  });
});


