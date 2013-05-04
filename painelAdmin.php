<?php

if(isset($_POST['delete_x'])||isset($_POST['delete_y'])){
	delete($_POST['id']);
}

$msg = $_GET['msg'];

function curPageURL() { 
	$pageURL = 'http'; if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
	$pageURL .= "://"; if ($_SERVER["SERVER_PORT"] != "80") { 
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else { 
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
	} 
	return $pageURL; 
}

function delete($id){
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$path = $location.'&msg=3';
	$delete = $wpdb->query( "DELETE FROM wls_curriculo WHERE id = '".$id."'" );
	mysql_query($delete);

	echo "<script>location.href='".$path."'</script>";
}

wp_enqueue_style( "bootstrap", plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style( "bootstrapresponsive", plugins_url('css/bootstrap-responsive.css', __FILE__));
wp_enqueue_script('jquery');
wp_enqueue_script('bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));

?>
<div class="wrap">
   <?php screen_icon(); ?>
   <h2>WP - Currículo Vitae Free - Painel</h2>
   <div class="tabbable"> <!-- Only required for left/right tabs -->
    <ul class="nav nav-tabs">
      <?php if($msg==3){ ?>
          <li><a href="#tab1" data-toggle="tab">Home</a></li>
          <li class="active" ><a href="#tab2" data-toggle="tab">Lista</a></li>
      <?php }else{ ?>
          <li class="active"><a href="#tab1" data-toggle="tab">Home</a></li>
          <li><a href="#tab2" data-toggle="tab">Lista</a></li>
      <?php } ?>
    </ul>
    <div class="tab-content">
      <?php if($msg==3)	{ ?>
      	<div class="tab-pane" id="tab1">
      <?php }else{ ?>
      	<div class="tab-pane active" id="tab1">
      <?php } ?>
      
        <h2>Informações do plugin</h2>					
        <p>Para cria o formulário de cadastro use shortcode <strong>[formCadastro]</strong></p>
        <p>Para cria a listagem dos currículos use shortcode <strong>[listCurriculos]</strong></p>
        <p>Use o widget "Cadastro currículo - Login", para os usúarios cadastrados, poder ter acesso ao seu dados e poder alterar se necessário.</p>
        <p>Use o widget "Cadastro currículo - Busca", para procurar o nome ou a profissão que estão cadastrados.</p>
        <p>Qualquer dúvida envie uma mensagem para o email <a href="mailto:wiliamluisilva@gmail.com">wiliamluisilva@gmail.com</a> ou acesse o blog e deixe uma mensagem no contato <a href="http://wiliamluis.wordpress.com/contato/">clicando aqui</a></p>
      </div>
      
       <?php if($msg==3)	{ ?>
       	<div class="tab-pane active" id="tab2">
       <?php }else{ ?>
       	<div class="tab-pane" id="tab2">
       <?php } ?>
      
        <h2>Lista de currículos</h2>
		<?php include_once( plugin_dir_path( __FILE__ ) . 'listaCurriculosAdmin.php' );?>
      </div>
    </div>
  </div>
</div>
<?php wp_enqueue_script('scriptJS', plugins_url('js/script.js', __FILE__)); ?>