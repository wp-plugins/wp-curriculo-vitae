(function ($) {
	
	//Função utilizada quando não tem um área de serviço que o usuário deseja,
	//e selecionando a opção 'outro' e exibindo o campo para digitar a área desejada
	
	$("#id_area").change(function () {
		//alert($("#id_area option:selected").val());
		var option = $("#id_area option:selected").val();
		if(option == "outro"){
			$("#campoArea").css("display", "block");
		}else{
			$("#campoArea").css("display", "none");
		}
	  
	})
	.trigger('change');

}(jQuery));