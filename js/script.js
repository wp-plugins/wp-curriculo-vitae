(function ($) {
	
	//Função que chama o lightbox para exibir as informações completa do cadastro
	$(document).ready(function(){
		$("a[rel^='prettyPhoto']").prettyPhoto({animation_speed:'normal',autoplay_slideshow: false});
	});
	
	//Lightbox para a caixa de ediçao do cadastro
	$(document).ready(function(){
		$("a[rel^='edite']").prettyPhoto({animation_speed:'normal',autoplay_slideshow: false});
	});

	//Mascara para o campo CPF
	$(document).ready(function(){
		if($("#cpf").length){
			$("#cpf").mask("999.999.999-99");
		}
	});
	
	//Função que checa se já existe um cadastro com o mesmo CPF
	$(document).ready(function(){
		$('#cpf').keyup(cpf_check); 
	});
	
	function cpf_check(){
		var cpf = $('#cpf').val();
		if(cpf == '' || cpf.length < 14){
			$('#cpf').css('border', '3px #CCC solid');
			$('#tick').hide();
		}else{
			jQuery.ajax({
				type: 'POST',
				url: 'wp-admin/admin-ajax.php',
				data: 'action=checkCpf&cpf='+ cpf,
				cache: false,
				success: function(response){
					//alert(response);
					if(response >= 10){
						$('#cpf').css('border', '3px #C33 solid');
						$('#tick').hide();
						$('#cross').fadeIn();
						$('#msgCpf').fadeIn();
						$('#cadastrar').prop('disabled', true);
						
						
					}else{
						$('#cpf').css('border', '3px #090 solid');
						$('#cross').hide();
						$('#msgCpf').hide();
						$('#tick').fadeIn();
						$('#cadastrar').prop('disabled', false);
					}
				}
			});
		}
	
	}
	
	function dirname (path) {
	  // http://kevin.vanzonneveld.net
	  // +   original by: Ozh
	  // +   improved by: XoraX (http://www.xorax.info)
	  // *     example 1: dirname('/etc/passwd');
	  // *     returns 1: '/etc'
	  // *     example 2: dirname('c:/Temp/x');
	  // *     returns 2: 'c:/Temp'
	  // *     example 3: dirname('/dir/test/');
	  // *     returns 3: '/dir'
	  return path.replace(/\\/g, '/').replace(/\/[^\/]*\/?$/, '');
	}
	
}(jQuery));