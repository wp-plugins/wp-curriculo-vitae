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
?>
<div class="wrap">
  <?php screen_icon(); ?>
  <h2>WP-CV - Painel</h2>
  <br/>
        <style type="text/css">
		  /*body {margin: 20px; padding: 0; font-family: Verdana; font-size: 11px;}*/
		  
		  /* Estilo utilizado no exemplo */

		  div#caixa {display: inline-block; width: 800px; height: 600px;}
		  div#caixa p#abas {display: inline-block; width: 790px; height: 40px; margin: 0 10px 0 10px; padding: 0; overflow: hidden; vertical-align: bottom;}
		  div#caixa p#abas a {display: inline-block; font-size: 14px; font-weight: bold; color: #666; text-decoration: none; padding: 12px 26px 12px 26px; margin: 0 5px 0 0; background-color: #f0f0f0;}
		  div#caixa p#abas a:hover {background-color: #999; color: white;}
		  div#caixa p#abas a.selected {background-color: #ffcc00; color: #000;}
		  div#caixa ul#conteudos {display: inline-block; width: 798px; margin: 0; padding: 0; border: 1px solid #ccc;}
		  div#caixa ul#conteudos li {display: inline-block; width: 758px; margin: 10px 20px 10px 20px; padding: 0; overflow: auto;}
			
		</style>

        	<?php
				wp_enqueue_script('script2JS', plugins_url('js/script2.js', __FILE__));
			?>
  
  <div id="caixa">
    	
	    	<!-- Início: Seleção de abas -->
			
			<p id="abas">
				<?php if($msg==3){ ?>
                    <a href="#aba1">Home</a>
                    <a href="#aba2" class="selected">Lista</a>
                <?php }else{ ?>
                	<a href="#aba1" class="selected">Home</a>
                    <a href="#aba2">Lista</a>
                <?php } ?>
				<?php #<a href="#aba3">Aba 3</a> ?>
			</p>
			
			<!-- Fim: Seleção de abas -->
			
			<!-- Início: Conteúdo das abas -->
			
			<ul id="conteudos">
			
				<!-- Início: Conteúdo da Aba 1 -->
			
				<li id="aba1">
				
					<h2>Demonstração de texto1</h2>					
					<p>Para cria o formulário de cadastro use shortcode <strong>[formCadastro]</strong></p>
                    <p>Para cria a listagem dos currículos use shortcode <strong>[listCurriculos]</strong></p>
                    <p>Use o widget "Cadastro currículo - Login", para os usúarios cadastrados, poder ter acesso ao seu dados e poder alterar se necessário.</p>
                    <p>Use o widget "Cadastro currículo - Busca", para procurar o nome ou a profissão que estão cadastrados.</p>
                    <p>Qualquer dúvida envie uma mensagem para o email <a href="mailto:wiliamluisilva@gmail.com">wiliamluisilva@gmail.com</a> ou acesse o blog e deixe uma mensagem no contato <a href="http://wiliamluis.wordpress.com/contato/">clicando aqui</a></p>

				</li>
				
				<!-- Fim: Conteúdo da Aba 1 -->
				
				<!-- Início: Conteúdo da Aba 2 -->
				
				<li id="aba2">
				
					<h2>Lista de currículos</h2>
					<?php include_once( plugin_dir_path( __FILE__ ) . 'listaCurriculosAdmin.php' );?>
					
				</li>
				
				<!-- Fim: Conteúdo da Aba 2 -->
				
				<!-- Início: Conteúdo da Aba 3 -->
				<?php /*
				<li id="aba3">
				
					<h2>Trololooooooo</h2>
					<iframe width="756" height="480" src="http://www.youtube.com/embed/v1PBptSDIh8" frameborder="0" allowfullscreen></iframe>
					
				</li>
				*/ ?>
	
				<!-- Fim: Conteúdo da Aba 3 -->
				
			</ul>
			
			<!-- Fim: Conteúdo das abas -->
		
		</div>
  
  <?php /*
  <form action="options.php" method="post">
    // Todo o conteúdo tem de vir aqui dentro
  </form> */ ?>
</div>
