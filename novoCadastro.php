<?php
global $wpdb;

$id_cadastro = @$_GET['id_cadastro'];

include_once( plugin_dir_path( __FILE__ ) . 'enviarCadastro.php' );

$dado = $wpdb->get_row("SELECT a.*,
								 b.area
						  
						  FROM wls_curriculo a
						  
							  left join wls_areas b
								  on a.id_area = b.id
						  
						  where a.id = '".@$id_cadastro."'");
						  
wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );

wp_enqueue_script( 'jquery');	
wp_enqueue_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));
wp_enqueue_script( 'prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));
?>

<div class="container-fluid">
  <?php if($id_cadastro){ ?>
  	<h2>Editar Cadastro</h2>  
  <?php }else{ ?>
  	<h2>Novo Cadastro</h2>  
  <?php } ?>
  
  <?php if(@$_GET['msg']==2){ ?>
  
    <div class="alert alert-success" style="text-align:center;">Currículo Atualizado com sucesso!</div>	

  <?php }elseif($msg==3){ ?>
  
      <div class="alert alert-success" style="text-align:center;">Registro deletado com sucesso!</div>	
      
  <?php }?>
  
  <form id="formCadastro" name="formCadastro" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="admin" value="1" />
    <input type="hidden" name="id" value="<?php echo $dado->id; ?>" />
    
    <div class="control-group">
      <label class="control-label">Nome:</label>
      <div class="controls">
        <input type="text" name="nome" value="<?php echo $dado->nome; ?>" class="input-medium input-block-level width400"> 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Login:</label>
      <div class="controls">
        <input type="text" name="login" value="<?php echo $dado->login;?>" class="input-medium input-block-level width400"> 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Senha:</label>
      <div class="controls">
        <input type="password" name="senha" value="" class="input-block-level input-medium width400"> 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Email:</label>
      <div class="controls">
        <input type="email" name="email" value="<?php echo $dado->email;?>" class="input-block-level input-medium width400"> 
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">CPF:</label>
      <div class="controls">
        <input type="text" name="cpf" id="cpf" value="<?php echo $dado->cpf;?>" class="input-medium input-block-level"> 
        <img id="tick" src="<?php echo plugins_url('img/tick.png', __FILE__) ?>" width="16" height="16"/>
        <img id="cross" src="<?php echo plugins_url('img/cross.png', __FILE__) ?>" width="16" height="16"/><br/>
        <span id="msgCpf">Só é permitido um cadastro por CPF.</span>
      </div>
    </div>
    
    <div style="clear:both;"></div>
    
    <div class="control-group">
      <?php
          global $wpdb;
          $sqlArea = "SELECT * FROM wls_areas where 1=1";
          $queryArea = $wpdb->get_results( $sqlArea );
      ?>
      <label class="control-label">Área de serviço:</label>
      <div class="controls">
        <select name="id_area" id="id_area" class="width400">
          <option>Selecione um área</option>
          <?php foreach($queryArea as $kA => $vA){?>
              <option value="<?php echo $vA->id?>" <?php echo $dado->id_area==$vA->id?"selected":"";?> ><?php echo $vA->area?></option>
          <?php }?>
          <option value="outro">Outro</option>
        </select>
      </div>
      <div id="campoArea" style="display:none;">
          <label class="control-label">Escreva sua área:</label>
          <div class="controls">
              <input type="text" name="area" class="input-medium input-block-level width400" />
          </div>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Descrição:</label>
      <div class="controls">
        <textarea class="input-block-level width400" name="descricao"><?php echo $dado->descricao?></textarea>
      </div>
    </div>
    <div class="control-group">
      <label class="control-label">Enviar currículo:</label>
      <?php if($dado->curriculo){ ?>
          <div class="well">
              <a href="<?php echo content_url( 'uploads/curriculos/'.$dado->curriculo); ?>" target="_blank" > <?php echo @$dado->curriculo ?></a>
          </div>
      <?php } ?>
      <div class="controls">
        <input type="file" name="curriculo" class="input-medium input-block-level width400"> 
      </div>
    </div>
	  <?php if($id_cadastro){ ?>
        <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-primary">Atualizar</button>  
      <?php }else{ ?>
        <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-primary">Cadastrar</button>
      <?php } ?>	
      
  </form>

</div>

<?php wp_enqueue_script('scriptMask', plugins_url('js/jquery.maskedinput-1.1.4.pack.js', __FILE__)); ?>
<?php wp_enqueue_script('scriptAreaJS', plugins_url('js/scriptArea.js', __FILE__)); ?>
<?php wp_enqueue_script('script', plugins_url('js/scriptAdm.js', __FILE__)); ?>
