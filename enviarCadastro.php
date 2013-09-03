<?php
	// Devido à quantidade de dados que esta função poderia gerar,
	// vamos apenas atualizar a base de dados de 10 em 10 minutos.
	// Desta forma, se um usuário permanecer no site por 30 minutos,
	// será registado três vezes na tabela.
	 
	 $cadastrar 		= @$_POST["cadastrar"];
	 $cadastrar_x 		= @$_POST["cadastrar_x"];
	 
	 if(isset($_POST["cadastrar"])){
	 
		  global $wpdb;
		 
		  // IP do usuário
		  #$ip = $_SERVER["REMOTE_ADDR"];
		  $nome 		= $_POST["nome"];
		  $email 		= $_POST["email"];
		  $cpf 			= $_POST["cpf"];
		  $id_area 		= $_POST["id_area"];
		  $descricao 	= $_POST["descricao"];
		  
		  if($_POST["area"]){
			  
			  $area 		= $_POST["area"];
	
			  // A Hora a que o usuário acessou
			  $current_time = current_time( 'mysql' );
			  
			  // Checamos se não existe nenhum registo procedemos
			  $var = array(
				'area' 		=> $area,
			  );
			  
			  $wpdb->insert("wls_areas", $var );
			  
			  $id_area = $wpdb->insert_id;
		  }
		  
		  // A Hora a que o usuário acessou
		  $current_time = current_time( 'mysql' );
	 
		  $uploaddir = "wp-content/uploads/curriculos/";

		  $tipo = explode(".", $_FILES['curriculo']['name']);
		  $nome2 = str_replace(" ", "", $nome);
		  
		  if(@$_POST['admin']==1&&$_FILES['curriculo']['name']){
			  @unlink("wp-content/uploads/curriculos/".@$dado->curriculo);
			  $dado->curriculo = $nome2.".".$tipo[1];
		  }
		  
		  move_uploaded_file($_FILES['curriculo']['tmp_name'], $uploaddir. $nome2.".".$tipo[1]);

		  // Registar os IPs na base de dados
		  $var = array(
			'nome' 			=> $nome,
			'email' 		=> $email,
			'cpf' 			=> $cpf,
			'id_area' 		=> $id_area,
			'descricao' 	=> $descricao,
			'curriculo' 	=> $nome2.".".$tipo[1],
		  );
		  
		  $proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
		  
		  if($_GET){
			
				$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&";
				
		  }else{
			  
			  $location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?";
			  
		  }
		  
		  if(@$_POST['admin']==1){
			  
			  // Guardar os valores na tabela
			  $wpdb->update( "wls_curriculo", $var, array('id' => $_POST['id']), $format = null, $where_format = null );
			  echo "<script>location.href='?page=novo-cadastro&id_cadastro=".$_POST['id']."&msg=2'</script>";
			  
		  }else{
		  
			  // Guardar os valores na tabela
			  $wpdb->insert("wls_curriculo", $var );
			  
			  $path = $location.'&msg=1';
			  
			  if(@$_POST['admin']==1){

				  echo "<script>location.href='?page=novo-cadastro&msg=1'</script>";
				  
			  }else{
				  
				  echo "<script>location.href='".$path."'</script>";
				  
			  }
		  }
	 }
	
?>