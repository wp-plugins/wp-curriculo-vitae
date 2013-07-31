<?php

global $wpdb;

########### Função para excluir registro

function delete($id){
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$path = $location.'&msg=3';
	$delete = $wpdb->query( "DELETE FROM wls_areas WHERE id = '".$id."'" );
	mysql_query($delete);

	echo "<script>location.href='".$path."'</script>";
}

if(isset($_POST['delete_x'])||isset($_POST['delete_y'])){
	delete($_POST['id']);
}


$cadastrar 		= @$_POST["cadastrar"];
$cadastrar_x 	= @$_POST["cadastrar_x"];

if(isset($_POST["cadastrar"])){

	global $wpdb;
   
	$area 		= $_POST["area"];
	
	// A Hora a que o usuário acessou
	$current_time = current_time( 'mysql' );
	
	// Checamos se não existe nenhum registo procedemos
	$var = array(
	  'area' 		=> $area,
	);
	
	/*print"<pre>";
	print_r($var);
	print"</pre>";*/
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$path = $location;
	
	$sql = "SELECT * FROM wls_areas where area = '".$area."' ";
	$query = $wpdb->get_results( $sql );
	$rows = $wpdb->num_rows;
	
	if($rows == 0){
		
		// Guardar os valores na tabela
		$wpdb->insert("wls_areas", $var );
		echo "<script>location.href='".$path."&msg=1'</script>";
		
	}else{
		
		echo "<script>location.href='".$path."&msg=2'</script>";
		
	}

	#$wpdb->show_errors();
	#$wpdb->print_error();

}

wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );
wp_enqueue_style( "prettyPhotoCSS", plugins_url('css/prettyPhoto.css', __FILE__) );

wp_enqueue_script( 'jquery');	
wp_enqueue_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));
wp_enqueue_script( 'prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));

?>
<div class="container-fluid">
    <h2>Áreas de serviços</h2>					
    <form method="post">
      <label>Cadastrar uma nova área</label>
      <input type="text" name="area" class="input-medium" style="width:300px;height:30px;">
      <br>
      <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
    </form>
    <?php
	
		$table = "wls_areas";
		
		//######### INICIO Paginação
		$numreg = 10; // Quantos registros por página vai ser mostrado
		if (!isset($pg)) {
			$pg = 0;
		}
		$inicial = $pg * $numreg;
		
		//######### FIM dados Paginação

		$sql = "SELECT * FROM ".$table." where 1=1 $where group by area LIMIT $inicial, $numreg ";
		$query = @$wpdb->get_results( @$sql );
				
		$sqlRow = "SELECT * FROM ".$table." where 1=1 ";
		$queryRow = $wpdb->get_results( $sqlRow );
		$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação
		if($queryRow){
	?>
    		<?php if($_GET['msg']==1){?>
    			<div class="alert alert-success" style="text-align:center;">Área de serviço cadastrado com sucesso!</div>
            <?php }elseif($_GET['msg']==2){?>
            	<div class="alert alert-error" style="text-align:center;">Essa área já existe.</div>
            <?php }elseif($_GET['msg']==3){ ?>
            	<div class="alert alert-success" style="text-align:center;">Área deletado com sucesso!</div>
            <?php }?>
    		
                <table class="table table-striped table-bordered table-condensed table-hover">
                  <thead>
                    <tr>
                      <th>Áreas cadastradas</th>
                      <th width="5%" align="center">Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                  
                  <?php 
                      $x=0;
                      foreach($query as $k => $v){
                      //print_r($v);
                  ?>
                  
                    <tr>
                      <td><?php echo @$v->area ?></td>
                      <td style="text-align:center;">
                      	<form action="" method="post">
                            <input type="hidden" name="id" value="<?php echo $v->id ?>" />
                            <input type="image" name="delete" src="<?php echo plugins_url('img/delete.png',__FILE__)?>" width="16" height="16" />
                        </form>
                      </td>
                    </tr>
                    
                  <?php $x++; }  ?>
                  
                  </tbody>
                </table>
            
            
		<?php }else{ ?>
        
        	<div class="alert alert-success" style="text-align:center;">Nenhum cadastro de área encontrado.</div>
            
        <?php } ?>
        
    	<?php include( plugin_dir_path( __FILE__ ) . 'classes/paginacao2.php' ); ?>
    
</div>