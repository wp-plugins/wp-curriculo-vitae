<?php
	
   include('../../../../../wp-config.php');
   $wls_curriculo 		= $table_prefix.'wls_curriculo';
   $wls_areas 			= $table_prefix.'wls_areas';
   
   //include_once($_SERVER['HTTP_HOST'].'/site3/wp-load.php');
   //include_once($_SERVER['HTTP_HOST'].'/site3/wp-includes/wp-db.php');
   
   // conecta ao banco de dados 
   $con = mysql_pconnect(DB_HOST, DB_USER, DB_PASSWORD) or trigger_error(mysql_error(),E_USER_ERROR); 
   // seleciona a base de dados em que vamos trabalhar 
   mysql_select_db(DB_NAME, $con); 
   
   #$id_form 		= $_GET['id_form'];
   #$data_inicial 	= $_GET['data_inicial'];
   #$data_final 		= $_GET['data_final'];
   
   #$where = "";
   
   #$where .= @$data_inicial && @!$data_final?" and a.data_hora >= '".$data_inicial." 00:00:00' " : "";
   #$where .= @!$data_inicial && @$data_final?" and a.data_hora <= '".$data_final." 23:59:59' " : "";
   #$where .= @$data_inicial && @$data_final?" and a.data_hora BETWEEN '".$data_inicial." 00:00:00' and '".$data_final." 23:59:59' " : "";
   
   // cria a instrução SQL que vai selecionar os dados 
   $sql = "SELECT a.*,
				  b.area
		   
		   FROM ".$wls_curriculo." a
		   
		   		left join ".$wls_areas." b
					on a.id_area = b.id
		   
		   where 1=1 $where order by a.nome asc"; 
		
   // executa a query 
   $query = mysql_query($sql, $con) or die(mysql_error()); 
   #$query2 = mysql_query($sql, $con) or die(mysql_error()); 
   
   #$dados2 = mysql_fetch_assoc($query);
   
   
   $html = "<table width='90%' border='1'>
				";
   
   #while($dados2 = mysql_fetch_array($query, MYSQL_ASSOC)){
		#print_r($dados2); 
	   $html .= "<tr>";	
	   
	   $html .= "<th>Nome</th>";
	   $html .= "<th>Sexo</th>";
	   $html .= "<th>Estado civil</th>";
	   $html .= "<th>Idade</th>";
	   $html .= "<th>Telefon</th>";
	   $html .= "<th>Celular</th>";
	   $html .= "<th>E-mail</th>";
	   $html .= "<th>Skype</th>";
	   $html .= "<th>Site/Blog</th>";
	   $html .= "<th>Área de serviço</th>";
	   $html .= "<th>CPF</th>";
	   $html .= "<th>Remuneração</th>";
	   $html .= "<th>Login</th>";
	   $html .= "<th>Senha</th>";
	   $html .= "<th>CEP</th>";
	   $html .= "<th>Rua</th>";
	   $html .= "<th>Númera</th>";
	   $html .= "<th>Bairro</th>";
	   $html .= "<th>Cidade</th>";
	   $html .= "<th>Estado</th>";
	   $html .= "<th>Descrição</th>";
		
	   $html .= "</tr>";
	   
   #}

   			 
   while($dados = mysql_fetch_array($query, MYSQL_ASSOC)){
	   
	   $html .= "<tr>";
	   
	   $html .= "<td>".$dados['nome']."</td>";
	   $html .= "<td>".$dados['sexo']."</td>";
	   $html .= "<td>".$dados['estado_civil']."</td>";
	   $html .= "<td>".$dados['idade']."</td>";
	   $html .= "<td>".$dados['telefone']."</td>";
	   $html .= "<td>".$dados['celular']."</td>";
	   $html .= "<td>".$dados['email']."</td>";
	   $html .= "<td>".$dados['skype']."</td>";
	   $html .= "<td>".$dados['site_blog']."</td>";
	   $html .= "<td>".$dados['area']."</td>";
	   $html .= "<td>".$dados['cpf']."</td>";
	   $html .= "<td>".$dados['remuneracao']."</td>";
	   $html .= "<td>".$dados['login']."</td>";
	   $html .= "<td>".$dados['senha']."</td>";
	   $html .= "<td>".$dados['cep']."</td>";
	   $html .= "<td>".$dados['rua']."</td>";
	   $html .= "<td>".$dados['numero']."</td>";
	   $html .= "<td>".$dados['bairro']."</td>";
	   $html .= "<td>".$dados['cidade']."</td>";
	   $html .= "<td>".$dados['estado']."</td>";
	   $html .= "<td>".$dados['descricao']."</td>";
	   
	   $html .= "</tr>";
   }
   
   $html .= "</table>";
   
   #echo $html;
   #exit;
   
   // Determina que o arquivo é uma planilha do Excel
   header("Content-type: application/vnd.ms-excel");   

   // Força o download do arquivo
   header("Content-type: application/force-download");  

   // Seta o nome do arquivo
   header("Content-Disposition: attachment; filename=registros.xls");

   header("Pragma: no-cache");
   // Imprime o conteúdo da nossa tabela no arquivo que será gerado
   echo $html;
	   
?>