<?php

wp_enqueue_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_enqueue_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );
wp_enqueue_style( "prettyPhotoCSS", plugins_url('css/prettyPhoto.css', __FILE__) );

wp_enqueue_script( 'jquery');
wp_enqueue_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));
wp_enqueue_script( 'prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));

?>
<div class="container-fluid">
    <h2>Informações do plugin</h2>
    <p>O <strong>WP-Curriculo Vitae</strong> e um plugin que permite que usuários a cadastrem seu currículo no site para divulgação online ou para uso do site.</p>
    <p>O plugin trabalha com duas versoes:</p>
    <p><strong>Versão gratuita:</strong></p>
    <p>1. Cadastrar o currículo;<br>
    2. Listagem de currículos com sistema de busca.</p>
    <p>Para acessar a versão gratuita&nbsp;<a title="Plugin WP - Currículo Vitae" href="http://wordpress.org/extend/plugins/wp-curriculo-vitae/" target="_blank">clique aqui</a>.</p>
    <p><strong>Versão paga:</strong></p>
    <p>1. Cadastrar o currículo;<br>
    2. Editar atráves de área restrita;<br>
    3. Widget de login na área restrita;<br>
    4. Listagem de currículos com sistema de busca;<br>
    5. Widget de Busca de Currículos.</p>

    <p>Para comprar a versão paga clique no botão abaixo:</p>

    <?php /*<!-- INICIO FORMULARIO BOTAO PAGSEGURO -->
<form target="pagseguro" action="https://pagseguro.uol.com.br/checkout/v2/payment.html" method="post">
<!-- NÃO EDITE OS COMANDOS DAS LINHAS ABAIXO -->
<input type="hidden" name="code" value="2A503DF5D6D66EDFF46EBFA2EED8B23A" />
<input type="image" src="https://p.simg.uol.com.br/out/pagseguro/i/botoes/pagamentos/164x37-comprar-assina.gif" name="submit" alt="Pague com PagSeguro - é rápido, grátis e seguro!" />
</form>
<!-- FINAL FORMULARIO BOTAO PAGSEGURO -->*/ ?>

    <p><strong>Como utilizar</strong></p>
    <p>Para exibir o formulário de cadastro, crie uma pagina e coloque o shortcode <strong>[formCadastro]</strong>.</p>
    <p>Para exibir a listagem dos cadastrados, crie uma página e coloque o shortcode <strong>[listCurriculos]</strong>.</p>
    <p>Use o widget <strong>WP-Curriculo Vitae busca</strong> para exibir a busca rápida de currículo em todas as páginas.</p>
    <p>Use o widget <strong>WP-Curriculo Vitae login</strong> para exibir o formulário de login em todas as páginas.</p>
    <p><em>Obs.</em> Os widget são apenas para a versão paga.</p>
    <p>Qualquer dúvida envie uma mensagem para o email <a href="mailto:wiliamluisilva@gmail.com">wiliamluisilva@gmail.com</a> ou acesse o blog e deixe uma mensagem no contato <a href="http://wiliamluis.wordpress.com/contato/">clicando aqui</a>.</p>
</div>
