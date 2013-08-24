<?php
include_once( plugin_dir_path( __FILE__ ) . 'enviarCadastro.php' );
wp_enqueue_script( 'jquery');	
?>
	
<div class="wp_conteiner">
  
  <?php if(@$_GET['msg']==1){ ?>
  
  	  <div class="alert alert-success" style="text-align:center;">Currículo cadastrado com sucesso!</div>	
      
  <?php }elseif(@$_GET['msg']==2){ ?>
  
  	  <div class="alert alert-success" style="text-align:center;">Currículo Atualizado com sucesso!</div>	
  
  <?php }elseif(@$_GET['msg']==3){ ?>
      
      <div class="alert alert-success" style="text-align:center;">Conta excluido com sucesso!</div>	
      
  <?php }?>
  
  <form id="wp-curriculo-cadastro" name="wp-curriculo-cadastro" method="post" enctype="multipart/form-data">
    
    <div class="control-group">
      <label class="control-label">Nome:</label>
      <div class="controls">
        <input type="text" name="nome" value="<?php echo @$_SESSION['nome']?>" /> 
      </div>
    </div>
   
    <div class="control-group">
      <label class="control-label">Email:</label>
      <div class="controls">
        <input type="email" name="email" value="<?php echo @$_SESSION['email']?>" class="input-block-level input-medium"> 
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">CPF:</label>
      <div class="controls">
        <input type="text" name="cpf" value="<?php echo @$_SESSION['cpf']?>" class="input-medium input-block-level"> 
      </div>
    </div>
    
    <div class="control-group">
      
	  <?php
          global $wpdb;
          $sqlArea = "SELECT * FROM wls_areas where 1=1";
          $queryArea = $wpdb->get_results( $sqlArea );
      ?>
      
      <label class="control-label">Área de serviço:</label>
      
      <div class="controls">
        <select name="id_area" id="id_area">
          <option>Selecione um área</option>
          <?php foreach($queryArea as $k => $v){?>
              <option value="<?php echo $v->id?>"><?php echo $v->area?></option>
          <?php }?>
          <option value="outro">Outro</option>
        </select>
      </div>
      
      <div id="campoArea" style="display:none;">
          <label class="control-label">Escreva sua área:</label>
          <div class="controls">
              <input type="text" name="area" class="input-medium input-block-level" />
          </div>
      </div>
      
    </div>
    
    <div class="control-group">
      <label class="control-label">Descrição:</label>
      <div class="controls">
        <textarea class="input-block-level" name="descricao"><?php echo @$_SESSION['descricao']?></textarea>
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Enviar currículo:</label>
      <?php if($_SESSION['curriculo']){ ?>
          <div class="well">
              <a href="<?php echo content_url( 'uploads/curriculos/'.@$_SESSION['curriculo']); ?>" target="_blank" > <?php echo @$_SESSION['curriculo'] ?></a>
          </div>
      <?php } ?>
      <div class="controls">
        <input type="file" name="curriculo" class="input-medium input-block-level"> 
      </div>
    </div>

      <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
  </form>
</div>

<?php wp_enqueue_script('scriptJS', plugins_url('js/scriptArea.js', __FILE__)); ?>