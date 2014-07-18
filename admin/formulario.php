<?php
global $wpdb;

$id_cadastro = @$_GET['id_cadastro'];

$wls_curriculo 					= $wpdb->prefix . 'wls_curriculo';
$wls_areas 						= $wpdb->prefix . 'wls_areas';
$wls_curriculo_options 			= $wpdb->prefix . 'wls_curriculo_options';

#print_r($_POST);
if(isset($_POST['cadastrar'])){
	include_once( plugin_dir_path( __FILE__ ) . 'include/enviarCadastro.php' );
}

$dado = $wpdb->get_row("SELECT a.*,
								 b.area
						  
						  FROM ".$wpdb->prefix."wls_curriculo a
						  
							  left join ".$wpdb->prefix."wls_areas b
								  on a.id_area = b.id
						  
						  where a.id = '".@$id_cadastro."'", ARRAY_A);
						  
wp_enqueue_style('wpcva_bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));
wp_enqueue_style('wpcva_style', plugins_url('css/style.css', __FILE__));

wp_enqueue_script('jquery');	
wp_enqueue_script('wpcva_bootstrapJS', plugins_url('../js/bootstrap.min.js', __FILE__));
wp_enqueue_script('wpcva_scriptMask', plugins_url('../js/jquery.maskedinput-1.1.4.pack.js', __FILE__));
wp_enqueue_script('wpcva_scriptAreaJS', plugins_url('../js/scriptArea.js', __FILE__));
wp_enqueue_script('wpcva_script', plugins_url('js/script.js', __FILE__));
wp_enqueue_script('wpcva_ckeditor', plugins_url('../classes/ckeditor/ckeditor.js', __FILE__));
wp_enqueue_script('wpcva_adapters', plugins_url('../classes/ckeditor/adapters/jquery.js', __FILE__));

wp_enqueue_script('wpcva_scriptckeditor', plugins_url('js/scriptckeditor.js', __FILE__));
?>

<div class="container-fluid">
  <?php if($id_cadastro){ ?>
  	<h2>Editar Cadastro</h2>  
  <?php }else{ ?>
  	<h2>Novo Cadastro</h2>  
  <?php } ?>
  
  <?php if(@$_GET['msg']==2){ ?>
  		
        <div style="clear:both;"></div>
    	<div class="alert alert-success" style="text-align:center;">Currículo Atualizado com sucesso!</div>	

  <?php }elseif($msg==1){ ?>
  	
    	<div style="clear:both;"></div>
      	<div class="alert alert-success" style="text-align:center;">Currículo cadastrado com sucesso!</div>	
      
  <?php }?>
  
  <form id="formCadastro" name="formCadastro" method="post" enctype="multipart/form-data">
  	
    <input type="hidden" name="tipo" value="admin" />
    
	<?php if($dado['id']) { ?>
    	<input type="hidden" name="mod" value="edit" />
        <input type="hidden" name="id_cadastro" value="<?php echo $dado['id']; ?>" />
    <?php }else{ ?>
  		<input type="hidden" name="mod" value="new" />
    <?php }?>
    
    
    
    <div class="container-fluid">
        	<?php /*?><h4><b>Dados Pessoais</b></h4><? */ ?>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label class="control-label">Nome:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="nome" value="<?php echo @$dado['nome']?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Sexo:</label>
                  <div class="controls">
                    <select class="form-control" name="sexo">
                      <option></option>	
                      <option value="0" 	<?php echo @$dado['sexo']=="0"?"selected":"" ?> 	>Feminino</option>
                      <option value="1" 	<?php echo @$dado['sexo']=="1"?"selected":""?>	>Masculino</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Estado c&iacute;vil:</label>
                  <div class="controls">
                    <select class="form-control" name="estado_civil">
                      <option value="0"></option>
                      <option value="1" <?php echo @$dado['estado_civil']=="1"?"selected":"";?>>Solteiro(a)</option>
                      <option value="2" <?php echo @$dado['estado_civil']=="2"?"selected":"";?>>Viuvo(a)</option>
                      <option value="3" <?php echo @$dado['estado_civil']=="3"?"selected":"";?>>Casado(a)</option>
                      <option value="4" <?php echo @$dado['estado_civil']=="4"?"selected":"";?>>Divorciado(a)</option>
                      <option value="5" <?php echo @$dado['estado_civil']=="5"?"selected":"";?>>Amigável</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Data de nascimento:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="idade" id="idade" value="<?php echo @$dado['idade']?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Telefone:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo @$dado['telefone']?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">Celular:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="celular" id="celular" value="<?php echo @$dado['celular']?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">E-mail:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="email" value="<?php echo @$dado['email']?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Skype:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="skype" value="<?php echo @$dado['skype']?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Site/Blog:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="site_blog" value="<?php echo @$dado['site_blog']?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                
                <?php
                    global $wpdb;
                    $sqlArea = "SELECT * FROM ".$wls_areas." where 1=1";
                    $queryArea = $wpdb->get_results( $sqlArea, ARRAY_A );
                ?>
                
                  <label class="control-label">&Aacute;rea de servi&ccedil;o:</label>
                  <div class="controls">
                    <select class="form-control" id="id_area" name="id_area">
                    	  <option></option>
                      <?php foreach($queryArea as $kA => $vA){?>
                          <option value="<?php echo $vA['id']?>" <?php echo @$dado['id_area']==$vA['id']?"selected":"";?> ><?php echo $vA['area']?></option>
                      <?php }?>	
                      <option value="outro">Outro</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group" id="campoArea" style="display:none;">
                  <label class="control-label">Escreva sua &aacute;rea:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="area">
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">CPF:</label>
                  <div style="clear:both;"></div>
                  <div class="controls">
                    
                    <div class="row">
                      <div class="col-md-11">
                        <input type="text" class="form-control pull-left" name="cpf" id="cpf" value="<?php echo @$dado['cpf'];?>">
                      </div>
                      <div class="col-md-1">
                        <img id="tick" src="<?php echo plugins_url('../img/wp-cv-correto.png', __FILE__) ?>" class="pull-left" width="16" height="16"/>
                        <img id="cross" src="<?php echo plugins_url('../img/wp-cv-incorreto.png', __FILE__) ?>" class="pull-left" width="16" height="16"/>
                      </div>
                    </div>
                    <span id="msgCpf">Só é permitido um CPF por cadastro.</span>
                    
                  </div>
                    
                </div>
              </div>
              <div class="col-md-8">
                <div class="form-group">
                  <label class="control-label">Remunera&ccedil;&atilde;o:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="remuneracao" value="<?php echo @$dado['remuneracao'];?>" />
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-2">
                <div class="form-group">
                  <label class="control-label">CEP:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="cep" id="cep" value="<?php echo @$dado['cep'];?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="control-label">Rua:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="rua" id="rua" value="<?php echo @$dado['rua'];?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">N&ordm;:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="numero" id="numero" value="<?php echo @$dado['numero'];?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-5">
                <div class="form-group">
                  <label class="control-label">Bairro:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo @$dado['bairro'];?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-11">
                <div class="form-group">
                  <label class="control-label">Cidade:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo @$dado['cidade'];?>" />
                  </div>
                </div>
              </div>
              <div class="col-md-1">
                <div class="form-group">
                  <label class="control-label">Estado:</label>
                  <div class="controls">
                    <input type="text" class="form-control" name="estado" id="estado" value="<?php echo @$dado['estado'];?>" />
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label class="control-label">Descri&ccedil;&atilde;o:</label>
                  <div class="controls">
                    <textarea class="form-control input-block-level" name="descricao" id="descricao"><?php echo @$dado['descricao'];?></textarea>
                  </div>
                </div>
              </div>
        	  
              <div style="clear:both;"></div>
              <?php if($dado['curriculo']){ ?>
              	
                  <div class="container-fluid">
                  	  <label class="control-label">Arquivo já salvo:</label>	
                      <div class="well">
                          <a href="<?php echo content_url( 'uploads/curriculos/'.$dado['curriculo']); ?>" target="_blank" > <?php echo @$dado['curriculo'] ?></a>
                      </div>
                  </div>
                  
              <?php } ?>
              <div class="form-group" style="margin-left:15px;">
                <label class="control-label">Enviar currículo:</label>
                
                <div class="controls">
                  <input type="file" name="curriculo" id="curriculo" class="input-medium input-block-level"> <br />
          	<span id="msgFile">Não é permitido enviar arquivo com extensão <b><span id="ext"></span></b>. Extensões permitidas: <strong>pdf</strong>, <strong>doc</strong> e <strong>docx</strong>.
            </span>  
                </div>
              </div>
    
    	</div>
	  <?php if($id_cadastro){ ?>
        <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-primary">Atualizar</button>  
      <?php }else{ ?>
        <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-primary">Cadastrar</button>
      <?php } ?>	
      
  </form>

</div>
