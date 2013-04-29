<?php
include_once( plugin_dir_path( __FILE__ ) . 'enviarCadastro.php' );
?>
	
      <div class="container-fluid" style="font-size:12px;">
        <p>Cadastre seu currículo aqui.</p>
        <span class="help-inline">Todos os campos são obrigatórios.</span>
        <form id="formCadastro" name="formCadastro" method="post" enctype="multipart/form-data">
          <div class="control-group">
            <label class="control-label">Nome:</label>
            <div class="controls">
              <input type="text" name="nome" value="<?php echo @$_SESSION['nome']?>" class="input-medium input-block-level"> 
            </div>
          </div>
         <?php /*
          <div class="control-group">
            <label class="control-label">Login:</label>
            <div class="controls">
              <input type="text" name="login" value="<?php echo @$_SESSION['login']?>" class="input-medium input-block-level"> 
            </div>
          </div>
          <div class="control-group">
            <label class="control-label">Senha:</label>
            <div class="controls">
              <input type="password" name="senha" value="" class="input-block-level input-medium"> 
            </div>
          </div>
		  */ ?>
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
   