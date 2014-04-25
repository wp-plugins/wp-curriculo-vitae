<?php
/**
 * Adds Foo_Widget widget.
 */
class wpcvFormLogin extends WP_Widget {
	
		
	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {
		parent::__construct(
	 		'wpcvf_form_login', // Base ID
			'WP-Currículo Vitae - Login', // Name
			array( 'description' => __( 'Entre com seu login e senha para ter acesso ao seu cadastro, para poder editalo.', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		global $wpdb;
		$wls_curriculo 					= $wpdb->prefix . 'wls_curriculo';
		
		if(isset($_POST['novaSenha'])){
			include( plugin_dir_path( __FILE__ ) . '../emails/esqueceu_senha.php' );
		}
		
		$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
  
		if($_GET){
		
			$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."&";
			
		}else{
			
			$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."?";
			
		}
		
		$path = $location;
		
		if(isset($_POST['logar'])&& $_POST['login']!="" && $_POST['senha']!=""){
			#session_start();
			
			$login = $_POST['login'];
			$senha = $_POST['senha'];
			$senha2 = md5($senha);
			
			$sqlL = "SELECT * FROM ".$wls_curriculo." where login = '".$login."' and senha = '".$senha2."'";
			
			$queryL = $wpdb->get_results( $sqlL );
			foreach($queryL as $kL => $vL){
				$dadosL = $vL;
			}
			
			$_SESSION['logado'] 		= 1;
			$_SESSION['nome'] 			= $dadosL->nome;
			$_SESSION['id_cadastro'] 	= $dadosL->id;
			
			#print_r($_SESSION);
			#exit;
			
			echo "<script>location.href='".str_replace("logout=1","",$path)."'</script>";

			
			if(isset($_POST['logar']) && $_SESSION['nome'] = ""){  @session_unset();
				echo "<div style=\" color:red; \">Login ou senha incorreta.</div>";
			}
			
		}
		
		if($_SESSION['logado']==1){
			
			$sqlO = "SELECT * FROM ".$wls_curriculo." where id = '".$_SESSION['id_cadastro']."'";
			
			$queryO = $wpdb->get_results( $sqlO );
			foreach($queryO as $kO => $vO){
				$dadosO = $vO;
			}
		?>
        <div class="well" style="overflow: hidden;">
        	<h4><?php echo $instance['titulo']?></h4>
            Ol&aacute; <strong><?php echo $_SESSION['nome']?$_SESSION['nome']:$dadosO->nome; ?></strong>,<br />
            Para alterar seu cadastro, acesse a página de cadastro.
            <a href="<?php echo $path ?>&logout=1">Sair</a>
        </div>
        <?php
			
		}else{
			
		?>
        <div class="container-fluid" style="overflow: hidden;">
        	
            <div id="wpcvf_formLoginSenha">
            
                <h4><?php echo $instance['titulo']?></h4>
                
                <?php if(isset($query[0]) && isset($_POST['logar'])){ ?>
                <div class="alert alert-error">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <b>Aviso!</b> Login ou senha incorreta.
                </div>
                <?php } ?>
            
            
                <form method="post" >
                    <div class="form-group">
                      <div class="controls">
                        <input type="text" name="login" class="form-control" placeholder="Login" > 
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="controls">
                        <input type="password" name="senha" class="form-control" placeholder="Senha" > 
                      </div>
                    </div>   

                  	<button type="submit" name="logar" class="btn btn-primary">Logar</button>
                  <span class="help-block" id="wpcvf_linkEsqueceu" style="cursor:pointer;">Esqueceu sua senha? Clique aqui.</span>
                </form>
                <br />
            </div>
            
            <div id="wpcvf_formEsqueceuSenha" style="display:none;">
                <h4>Esqueceu sua senha</h4>
                
                <form method="post" >
                  <div class="form-group">
                    <div class="controls">
                      <input type="text" name="cpf" id="cpf" maxlength="14" onkeydown="Mascara(this,Cpf);" onkeypress="Mascara(this,Cpf);" onkeyup="Mascara(this,Cpf);" class="form-control" placeholder="CPF" > 
                    </div>
                  </div>   
                  <button type="submit" name="novaSenha" class="btn btn-primary">Lembrar</button>
                  <br>
                  <span class="help-block" id="wpcvf_linkLogin" style="cursor:pointer;">Voltar para o login.</span>
                </form>
            </div>
          
         </div>
		<?php

		}
		
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['titulo'] = strip_tags( $new_instance['titulo'] );
		
		return $instance;
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form($instance) {
		if ( isset( $instance[ 'titulo' ] ) ) {
			$titulo = $instance[ 'titulo' ];
		}
		else {
			$titulo = __( 'T&iacute;tulo da widget', 'text_domain' );
		}
	?>
    <p>
    	Esse widget ira colocar um formul&aacute;rio de login, para o us&uacute;ario ter acesso ao seu cadastro e poder modificalo, com forme sua vontade.
    </p>
    <p>
    <label for="<?php echo $this->get_field_id( 'titulo' ); ?>">
        <?php _e( 'T&iacute;tulo da widget' ); ?>
    </label> 
    <input class="widefat" id="<?php echo $this->get_field_id( 'titulo' ); ?>" name="<?php echo $this->get_field_name( 'titulo' ); ?>" type="text" value="<?php echo esc_attr( $titulo ); ?>" />
    </p>

	<?php 
	}

} // class Foo_Widget

?>