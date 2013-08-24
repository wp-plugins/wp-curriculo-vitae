<?php

global $wpdb;
	
$table = "wls_curriculo";

$pg = $_GET['pg'];

$buscar = $_POST['buscar'];

$msg = $_GET['msg'];

$where = "";

if($buscar){
	$where .= " and (nome LIKE  '%".$buscar."%' or descricao LIKE '%".$buscar."%')";
}


########### Função para excluir registro

if(isset($_POST['delete_x'])||isset($_POST['delete_y'])){
	delete($_POST['id_registro']);
}

function delete($id){
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$path = $location.'&msg=3';
	
	$delete = "DELETE FROM wls_curriculo WHERE id = ".$id." ";
	
	$wpdb->query($delete);

	echo "<script>location.href='".$path."'</script>";
}

//######### INICIO Paginação
$numreg = 20; // Quantos registros por página vai ser mostrado
if (!isset($pg)) {
	$pg = 0;
}
$inicial = $pg * $numreg;

//######### FIM dados Paginação

$sql = "SELECT a.*,
			   b.area
		
		FROM wls_curriculo a
		
			left join wls_areas b
				on a.id_area = b.id
		
		where 1=1 $where LIMIT $inicial, $numreg ";
		
$query = $wpdb->get_results( $sql );

$sqlRow = "SELECT a.*,
				  b.area
		   
		   FROM wls_curriculo a
		   
		   		left join wls_areas b
					on a.id_area = b.id
		   
		   where 1=1 $where";
		   
$queryRow = $wpdb->get_results( $sqlRow );
$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação		

wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );
wp_enqueue_style( "prettyPhotoCSS", plugins_url('css/prettyPhoto.css', __FILE__) );

wp_enqueue_script( 'jquery');	
wp_enqueue_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));
wp_enqueue_script( 'prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));

?>

    <div class="container-fluid">
      <h2>Lista de currículos</h2>
      
	  <?php if(@$_GET['msg']==2){ ?>
  
  	  	<div class="alert alert-success" style="text-align:center;">Currículo Atualizado com sucesso!</div>	
  
	  <?php }elseif($msg==3){ ?>
      
          <div class="alert alert-success" style="text-align:center;">Registro deletado com sucesso!</div>	
          
      <?php }?>
      
      <table class="table table-striped table-bordered" width="100%">
        <thead>
          <tr>
            <th>Nome</th>
            <th>Descrição</th>
            <th>Área de serviço</th>
            <th width="50">E-mail</th>
            <th width="50">Arquivo</th>
            <th width="30">Editar</th>
            <th width="30">Excluir</th>
          </tr>
        </thead>
        <tbody>
        
        <?php 
        	$x=0;
          	foreach($query as $k => $v){
            //print_r($v);
        ?>
              <tr>
                <td><?php echo $v->nome ?></td>
                
                <td><a class="various" href="#curriculo_<?php echo $x; ?>" rel="prettyPhoto[inline]">Descrição completa</a><?php #echo $v->descricao ?></td>
                <div style='display:none'>
                    <div id='curriculo_<?php echo $x; ?>' style='padding:10px; background:#fff;'>
                        
                        <h2><?php echo $v->nome ?></h2>
                        <p>
                            <?php echo nl2br($v->descricao) ?>
                        </p>
                        
                        <a href="mailto:<?php echo $v->email?>" target="_blank">
                      <img src="<?php echo plugins_url('img/email.png', __FILE__)?>" width="16" height="16" alt="<?php echo $v->email?>" /> <?php echo $v->email?></a><br />
                        
                        <a href="<?php echo content_url( 'uploads/curriculos/'.$v->curriculo); ?>" target="_blank" >Baixar currículo</a>
                    </div>
                </div>
                
                <td><?php echo $v->area ?></td>
                
                <td style="text-align:center;"><a href="mailto:<?php echo $v->email?>" target="_blank">
                <img src="<?php echo plugins_url('img/email.png', __FILE__) ?>" width="16" height="16" alt="<?php echo $v->email?>" /></a></td>
                
                <td style="text-align:center;"><a href="<?php echo content_url( 'uploads/curriculos/'.$v->curriculo); ?>" target="_blank" > <img src="<?php echo plugins_url('img/page_white_text.png', __FILE__) ?>" width="16" height="16" alt="<?php echo $v->curriculo?>" /></a></td>
                
                <td style="text-align:center;">
                	
                    <a href="#edite_<?php echo $x; ?>" rel="edite[inline]">
                      <img src="<?php echo plugins_url('img/user_edit.png', __FILE__)?>" width="16" height="16" alt="<?php echo $v->nome?>" /></a><br />
                    
                    <?php include( plugin_dir_path( __FILE__ ) . 'formEdite.php' ); ?>
                    
                    
                </td>
                
                <form action="" method="post">
                    <td style="text-align:center;">
                        <input type="hidden" name="id_registro" value="<?php echo $v->id ?>" />
                        <input type="hidden" name="nome_registro" value="<?php echo $v->nome ?>" />
                        <input type="image" name="delete" src="<?php echo plugins_url('img/delete.png',__FILE__)?>" width="16" height="16" />
                    </td>
                </form>
                
              </tr>
              
        <?php $x++; }  ?>
          
        </tbody>
      </table>
      
      <?php include( plugin_dir_path( __FILE__ ) . 'classes/paginacao2.php' ); ?>
      
    </div>

<?php wp_enqueue_script('scriptJS', plugins_url('js/script.js', __FILE__)); ?>