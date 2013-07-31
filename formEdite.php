<?php

include_once( plugin_dir_path( __FILE__ ) . 'include/atualizarCadastro.php' );

wp_enqueue_script( 'jquery');
$dado = $wpdb->get_row("SELECT a.*,
								 b.area
						  
						  FROM wls_curriculo a
						  
							  left join wls_areas b
								  on a.id_area = b.id
						  
						  where a.id = '".$v->id."'");

?>

<div id='edite_<?php echo $x; ?>' style='display:none; padding:10px; background:#fff;'>	

<div class="container-fluid" >
  
  <form id="formCadastro" name="formCadastro" method="post" enctype="multipart/form-data">
  	<input type="hidden" name="admin" value="1" />
    <input type="hidden" name="id" value="<?php echo $dado->id; ?>" />
    
    <div class="control-group">
      <label class="control-label">Nome:</label>
      <div class="controls">
        <input type="text" name="nome" value="<?php echo $dado->nome; ?>" class="input-medium input-block-level"> 
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">Email:</label>
      <div class="controls">
        <input type="email" name="email" value="<?php echo $dado->email;?>" class="input-block-level input-medium"> 
      </div>
    </div>
    
    <div class="control-group">
      <label class="control-label">CPF:</label>
      <div class="controls">
        <input type="text" name="cpf" value="<?php echo $dado->cpf;?>" class="input-medium input-block-level"> 
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
              <option value="<?php echo $v->id?>" <?php echo $dado->id_area==$v->id?"selected":"";?> ><?php echo $v->area?></option>
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
        <textarea class="input-block-level" name="descricao"><?php echo $dado->descricao?></textarea>
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
        <input type="file" name="curriculo" class="input-medium input-block-level"> 
      </div>
    </div>

      <button type="submit" name="cadastrar" class="btn btn-primary">Cadastrar</button>
  </form>
</div>
</div>
