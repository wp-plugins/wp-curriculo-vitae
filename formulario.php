<?php

global $wpdb, $wpcvf, $wls_curriculo, $wls_areas, $wls_curriculo_options;

if(isset($_POST['cadastrar'])){
	include_once( plugin_dir_path( __FILE__ ) . 'admin/include/enviarCadastro.php' );
}

$sqlF = "SELECT * FROM ".$wls_curriculo." where id = '".@$_SESSION['id_cadastro']."'";
			
$queryF = $wpdb->get_results( $sqlF, ARRAY_A );
foreach($queryF as $kF => $vF){
	$dadosF = $vF;
}

?>
	
<div class="container-fluid">

  <?php if(@$_GET['msg']==1){ ?>
  
  	  <div class="alert alert-success" style="text-align:center; color: #3c763d;">Curriculo cadastrado com sucesso!</div>	
      
  <?php }elseif(@$_GET['msg']==2){ ?>
  
  	  <div class="alert alert-success" style="text-align:center; color: #3c763d;">Curriculo Atualizado com sucesso!</div>	
  
  <?php }elseif(@$_GET['msg']==3){ ?>
      
      <div class="alert alert-success" style="text-align:center; color: #3c763d;">Conta excluido com sucesso!</div>	
      
  <?php }?>
  
  <form name="wp-curriculo-cadastro" method="post" enctype="multipart/form-data" onsubmit="">
  	<input type="hidden" name="tipo" value="site" />
    
	<?php if(@$_SESSION['logado']==1) { ?>
    	<input type="hidden" name="mod" value="edit" />
        <input type="hidden" name="id_cadastro" value="<?php echo @$dadosF['id']; ?>" />
        <div class="form-group">
          <div class="controls">
            <span style="font-size:14px;">Excluir a conta</span> <input type="checkbox" name="excluirConta" value="1" style="margin-top:-2px;"> 
          </div>
        </div>
    <?php }else{ ?>
  		<input type="hidden" name="mod" value="new" />
        <input type="hidden" name="excluirConta" value="0" />
    <?php }?>
    
    <div class="form-group">
      <label class="control-label">Nome:</label>
      <div class="controls">
        <input type="text" name="nome" class="form-control" value="<?php echo @$dadosF['nome']?>" > 
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-4">
        	<div class="form-group">
              <label class="control-label">Sexo: </label>
              <div class="controls">
                <select class="form-control" name="sexo">
                  <option></option>	
                  <option value="0" 	<?php echo @$dadosF['sexo']=="0"?"selected":"" ?> >Feminino</option>
                  <option value="1" 	<?php echo @$dadosF['sexo']=="1"?"selected":""?> >Masculino</option>
                </select>
              </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="form-group">
              <label class="control-label">Estado cívil:</label>
              <div class="controls">
                <select name="estado_civil" class="form-control">
                    <option value="0"></option>
                    <option value="1" <?php echo @$dadosF['estado_civil']=="1"?"selected":"";?>>Solteiro(a)</option>
                    <option value="2" <?php echo @$dadosF['estado_civil']=="2"?"selected":"";?>>Viuvo(a)</option>
                    <option value="3" <?php echo @$dadosF['estado_civil']=="3"?"selected":"";?>>Casado(a)</option>
                    <option value="4" <?php echo @$dadosF['estado_civil']=="4"?"selected":"";?>>Divorciado(a)</option>
                    <option value="5" <?php echo @$dadosF['estado_civil']=="5"?"selected":"";?>>Amigável</option>
                </select>
              </div>
            </div>
        </div>
        <div class="col-md-4">
        	<div class="form-group">
              <label class="control-label">Data de nascimento:</label>
              <div class="controls">
                <input type="text" name="idade" id="idade" value="<?php echo @$dadosF['idade']?>" class="form-control"> 
              </div>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-5">
        	<div class="form-group">
              <label class="control-label">Telefone:</label>
              <div class="controls">
                <input type="text" name="telefone" id="telefone" value="<?php echo @$dadosF['telefone']?>" class="form-control"> 
              </div>
            </div>
        </div>
        <div class="col-md-5">
        	<div class="form-group">
              <label class="control-label">Celular:</label>
              <div class="controls">
                <input type="text" name="celular" id="celular" value="<?php echo @$dadosF['celular']?>" class="form-control"> 
              </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Email:</label>
      <div class="controls">
        <input type="email" name="email" value="<?php echo @$dadosF['email']?>" class="form-control" style="padding: 0px 12px;"> 
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Site/blog:</label>
      <div class="controls">
        <input type="text" name="site_blog" value="<?php echo @$dadosF['site_blog']?>" class="form-control"> 
      </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Skype:</label>
      <div class="controls">
        <input type="text" name="skype" value="<?php echo @$dadosF['skype']?>" class="form-control"> 
      </div>
    </div>
	
    <div class="row">
    	<div class="col-md-6">
        	<div class="form-group">
			  <?php              
				  
                  $sqlArea = "SELECT * FROM ".$wls_areas." where 1=1 group by area";
                  $queryArea = $wpdb->get_results( $sqlArea );
              ?>
              <label class="control-label">Área pretendida:</label>
              <div class="controls">
                <select name="id_area" id="id_area" class="form-control">
                  <option value="0">Selecione um área</option>
                  <?php foreach($queryArea as $k => $v){?>
                      <option value="<?php echo $v->id?>" <?php echo @$dadosF['id_area']==$v->id?"selected":"";?> ><?php echo $v->area?></option>
                  <?php }?>
                  <option value="outro">Outro</option>
                </select>
              </div>
            </div>
        </div>
        <div class="col-md-6">
        	<div class="form-group" id="campoArea" style="display:none;">
                <label class="control-label">Escreva sua área:</label>
                <div class="controls">
                    <input type="text" name="area" class="form-control" />
                </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Remuneração:</label>
      <div class="controls">
        <input type="text" name="remuneracao" value="<?php echo @$dadosF['remuneracao']?>" class="form-control"> 
      </div>
    </div>
	
    <div class="row">
    	<div class="col-md-5">
        	<div class="form-group">
              <label class="control-label">CPF:</label>
              <div class="controls">
              
              	<div class="row">
                	  <div class="col-md-7">
                    	<input type="text" name="cpf" id="cpf" value="<?php echo @$dadosF['cpf']?>" class="form-control">
                    </div>
                    <div class="col-md-1">
                    	<img id="tick" src="<?php echo plugins_url('img/tick.png', __FILE__) ?>" class="pull-left" width="16" height="16"/>
                		<img id="cross" src="<?php echo plugins_url('img/cross.png', __FILE__) ?>" class="pull-left" width="16" height="16"/>
                    </div>
                </div>
               
                <span id="msgCpf">CPF já está cadastrado.</span>
              </div>
            </div>
        </div>
        <div class="col-md-5">
        	<div class="form-group cep">
              <label class="control-label">CEP:</label>
              <div class="controls">
              	
                <input type="text" name="cep" id="cep" value="<?php echo @$dadosF['cep']?>" class="form-control" /> 
              </div>
            </div>
        </div>
    </div>
    
    <div class="row">
    	<div class="col-md-8">
        	<div class="form-group rua">
            <label class="control-label">Rua:</label>
            <div class="controls">
              <input type="text" name="rua" id="rua" value="<?php echo @$dadosF['rua']?>" class="form-control" /> 
            </div>
          </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group numero">
              <label class="control-label">Nº:</label>
              <div class="controls">
                <input type="text" name="numero" id="numero" value="<?php echo @$dadosF['numero']?>" class="form-control" /> 
              </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Bairro:</label>
      <div class="controls">
        <input type="text" name="bairro" id="bairro" value="<?php echo @$dadosF['bairro']?>" class="form-control" /> 
      </div>
    </div>
    
    <div class="row">
    	<div class="col-md-8">
        	<div class="form-group cidade">
              <label class="control-label">Cidade:</label>
              <div class="controls">
                <input type="text" name="cidade" id="cidade" value="<?php echo @$dadosF['cidade']?>" class="form-control" /> 
              </div>
            </div>
        </div>
        <div class="col-md-2">
        	<div class="form-group estado">
              <label class="control-label">Estado:</label>
              <div class="controls">
                <input type="text" name="estado" id="estado" value="<?php echo @$dadosF['estado']?>" class="form-control" /> 
              </div>
            </div>
        </div>
    </div>
    
    <div class="form-group">
      <label class="control-label">Descrição:</label>
      <div class="controls">
        <textarea class="form-control" name="descricao"><?php echo @$dadosF['descricao']?></textarea>
      </div>
    </div>
    
	<?php if($dadosF['curriculo']){ ?>
      <input type="hidden" name="curriculoCar" value="<?php echo @$dadoF['curriculo'];?>" />
    	<div class="form-group">
        	<label class="control-label">Arquivo já salvo:</label>	
            <div class="well">
                <a href="<?php echo content_url( 'uploads/curriculos/'.@$dadosF['curriculo']); ?>" target="_blank" > <?php echo @$_SESSION['curriculo'] ?></a>
            </div>
        </div>
    <?php } ?>
      
    <div class="form-group">
      <label class="control-label">Enviar currículo:</label>
      <div class="controls">
        <input type="file" name="curriculo" id="curriculo" class="input-medium input-block-level">
        <span id="msgFile">Não é permitido enviar arquivo com extensão <b><span id="ext"></span></b>. Extensões permitidas: <strong>pdf</strong>, <strong>doc</strong> e <strong>docx</strong>.</span>  
      </div>
    </div>
    
    <div style="clear:both;"></div>
  
	<?php if($dadosF['id']){ ?>
      <button type="submit"  id="cadastrar" name="cadastrar" class="btn btn-primary">Atualizar</button>
    <?php }else{ ?>
      <button type="submit"  id="cadastrar" name="cadastrar" class="btn btn-primary">Cadastrar</button>
    <?php } ?>
      
  </form>
</div>

<?php wp_enqueue_script('scriptAreaJS', plugins_url('js/scriptArea.js', __FILE__)); ?>