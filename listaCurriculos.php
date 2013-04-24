<?php

global $wpdb;
	
$pg = $_GET['pg'];

$buscar = $_POST['buscar'];

$where = "";

if($buscar){
	$where .= " and (nome LIKE  '%".$buscar."%' or descricao LIKE '%".$buscar."%')";
}

######### INICIO Paginação
$numreg = 20; // Quantos registros por página vai ser mostrado
if (!isset($pg)) {
	$pg = 0;
}

$inicial = $pg * $numreg;

######### FIM dados Paginação

$sql = "SELECT * FROM wls_curriculo where 1=1 $where LIMIT $inicial, $numreg ";
$query = $wpdb->get_results( $sql );

$sqlRow = "SELECT * FROM wls_curriculo where 1=1 $where";
$queryRow = $wpdb->get_results( $sqlRow );
$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação

wp_enqueue_style( "prettyPhotoCSS", plugins_url('css/prettyPhoto.css', __FILE__));
wp_enqueue_script('prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));	
?>


<div class="container-fluid">
	<div class="well" style="font-size:12px; color:#666;">
        <form method="post" class="navbar-search pull-right">
          <input type="text" name="buscar" class="search-query input-block-level" placeholder="Pesquisar currículo..."> 
        </form>
        <p>Aqui está todos currículos cadastrados.</p>
        <div>Clique no arquivo do currículo para baixar o mesmo.
          <br>
          <div>Clique no e-mail para enviar uma mensagem para a pessoa desejada.</div>
        </div>
        <table class="table table-striped table-bordered">
          <thead>
            <tr>
              <th>Nome</th>
              <th>Descrição</th>
              <th width="50">E-mail</th>
              <th width="50">Arquivo</th>
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
                  <td ><a class="various" href="#curriculo_<?php echo $x; ?>" rel="prettyPhoto[inline]">Descrição completa</a><?php #echo $v->descricao ?></td>
                  <td style="text-align:center;"><a href="mailto:<?php echo $v->email?>" target="_blank">
                  <img src="<?php echo plugins_url('img/email.png', __FILE__) ?>" width="16" height="16" alt="<?php echo $v->email?>" /></a></td>
                  <td style="text-align:center;"><a href="<?php echo content_url( 'uploads/curriculos/'.$v->curriculo); ?>" target="_blank" > <img src="<?php echo plugins_url('img/page_white_text.png', __FILE__) ?>" width="16" height="16" alt="<?php echo $v->curriculo?>" /></a></td>
                  
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
                  
                </tr>
                
          
                
          <?php $x++; }  ?>
            
          </tbody>
        </table>
        <?php include( plugin_dir_path( __FILE__ ) . 'classes/paginacao.php' ); // Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >> ?>
        
    </div>
</div>
<?php
wp_enqueue_script('scriptJS', plugins_url('js/script.js', __FILE__));
?>
