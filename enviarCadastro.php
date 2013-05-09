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
		  #$login 		= $_POST["login"];
		  
		  /*if(isset($_SESSION['senha'])){
		  	$senha 		= $_SESSION['senha'];
		  }else{
			$senha 		= $_POST["senha"];
		  }*/
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
		  
		  $senha = md5($senha);
		 
		  // A Hora a que o usuário acessou
		  $current_time = current_time( 'mysql' );
	 
		  $uploaddir = "wp-content/uploads/curriculos/";

		  $tipo = explode(".", $_FILES['curriculo']['name']);
		  $nome2 = str_replace(" ", "", $nome);
		  
		  if(@$_SESSION['logado']==1&&$_FILES['curriculo']['name']){
			  @unlink("wp-content/uploads/curriculos/".@$_SESSION['curriculo']);
			  $_SESSION['curriculo'] = $nome2.".".$tipo[1];
		  }
		  
		  move_uploaded_file($_FILES['curriculo']['tmp_name'], $uploaddir. $nome2.".".$tipo[1]);

		  // Checamos se não existe nenhum registo procedemos
		  #if (!$cpf ) {
			// Registar os IPs na base de dados
			$var = array(
			  'nome' 		=> $nome,
			  #'login' 		=> $login,
			  #'senha' 		=> $senha,
			  'email' 		=> $email,
			  'cpf' 		=> $cpf,
			  'id_area' 	=> $id_area,
			  'descricao' 	=> $descricao,
			  'curriculo' 	=> $nome2.".".$tipo[1],
			);
			
			/*print"<pre>";
			print_r($var);
			print"</pre>";*/
			
			$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
			$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

			if(@$_SESSION['logado']==1){
				// Guardar os valores na tabela
				$wpdb->update( "wls_curriculo", $var, array('id' => $_SESSION['id']), $format = null, $where_format = null );
				
				$path = $location.'&msg=2';
				
				echo "<script>location.href='".$path."'</script>";
				
			}else{
				// Guardar os valores na tabela
				$wpdb->insert("wls_curriculo", $var );
				
				$path = $location.'&msg=1';
				
				echo "<script>location.href='".$path."'</script>";
			}
			#$wpdb->show_errors();
			#$wpdb->print_error();
		  #}
	 }
	
?>