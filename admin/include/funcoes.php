<?php


function delete($id, $tabela=""){
	
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$array_url = explode("&", $location);

	$path = removeMsg($location);
	
	$path = $array_url[0];
	
	$delete = "DELETE FROM ".$tabela. " WHERE id = ".$id." ";
	
	$wpdb->query($delete);
	
	$msg = "&msg=3";
	
	echo "<script>location.href='".$path."".$msg."'</script>";
}

function deleteSub($id, $tabela=""){
	
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$array_url = explode("&", $location);

	$path = removeMsg($location).'&msg=3';
	
	$path = $array_url[0];
	
	$delete = "DELETE FROM ".$tabela. " WHERE id_cadastro = ".$id." ";
	
	$wpdb->query($delete);
	
}

function removeMsg($link){
	$return  = str_replace('&amp;msg=1','', str_replace('&amp;msg=2','', str_replace('&amp;msg=3','', str_replace('&amp;msg=4','', $link))));
	
	return $return;
}

function dataHora($dataHora, $tipo){
	/*
		tipo = 1 igual dia/mês/ano às hora:min:seg
		tipo = 2 igual dia/mês/ano
		tipo = 3 igual hora:min:seg
		tipo = 4 igual dia/mês/ano às hora:min
	*/
	
	$array = explode(" ", $dataHora);
	
	
	
	if($tipo==5 || $tipo==6){
		
		$dataArray = explode("/", $array[0]);
		
		$ano = $dataArray[2];
		$mes = $dataArray[1];
		$dia = $dataArray[0];
		
	}else{
		
		$dataArray = explode("-", $array[0]);
		
		$ano = $dataArray[0];
		$mes = $dataArray[1];
		$dia = $dataArray[2];
		
	}
	
	$horaArray = explode(":", $array[1]);
	
	$hora 	= $horaArray[0];
	$min 	= $horaArray[1];
	$seg 	= $horaArray[2];
	
	$anoAtual = date("Y");
	
	switch($tipo){
		case 1:{
			
			$data = $dia . "/" . $mes . "/" . $ano;
			$horario = $hora . ":"  . $min;
			
			$return = $data . " &agrave;s "  . $horario . " hrs";
			
			break;
		}
		case 2:{
			
			$data = $dia . "/" . $mes . "/" . $ano;
			$return = $data;
			
			break;
		}
		case 3:{
			
			$horario = $hora . ":"  . $min . " hrs";
			$return = $data . " &agrave;s "  . $horario;
			
			break;
		}
		case 4:{
			
			$data = $dia . "/" . $mes . "/" . str_replace("20", "", $ano);
			$horario = $hora . ":"  . $min;
			
			$return = $data . "<br/>"  . $horario . " hrs";
			
			break;
		}
		case 5:{
			
			$data = $ano . "-" . $mes . "-" . $dia;
			$return = $data;
			break;
		}
		case 6:{
			$data = $anoAtual - $ano;
			$return = $data;
			break;
		}
		default:{
			
			$return = $dataHora;
			
			break;
		}
	}
	
	return $return;
}

function zerarEdit($tabela, $id){
	
	global $wpdb;
	
	$sql 	= "SELECT * FROM ".$tabela." where id_cadastro = ".$id."";
	$query 	= $wpdb->get_results( $sql );
	foreach($query as $k => $v){			
	  
		  $var = array(
			  'edit' 	=> 0,
					
		  );
		  
		  $wpdb->update( $tabela, $var, array('id' => @$v->id), $format = null, $where_format = null );
	}
	
}

function deletarZero($tabela, $qtde){
	
	global $wpdb;
	
	for ($i=0; $i<$qtde; $i++) { 

		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$tabela." WHERE edit = %d" , array('edit' => 0) ) );
		
	}
}

?>