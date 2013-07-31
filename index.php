<?php
/*
Plugin Name: WP-Currículo Vitae - Free
Plugin URI: http://wiliamluis.wordpress.com/plugin/
Description: O *WP-Curriculo Vitae* possibilita o cadastro de informações profissional do usuário, onde que esse cadastro vai se torna publico.
Terá uma lista com as informações dos cadastro, podendo entrar em contato com o cadastrado.
Na Própria lista pode buscar um nome ou uma especificação, facilitando a busca.
Version: 2.2
Author: William Luis da Silva
Author URI: http://wiliamluis.wordpress.com/plugin/
License: GPLv2
*/


// Vamos criar uma tabela que irá guardar os IPs dos usuários que
// acessam o nosso website.
// ATENÇÃO: Este código é apenas didático. Se o usar para produção
// poderá vir a sofrer tempos de resposta maiores, pois irá guardar
// muitos dados na base de dados.


// Registamos a função para correr na ativação do plugin
register_activation_hook( __FILE__, 'ewp_install_hook' );

register_deactivation_hook( __FILE__, 'ewp_unistall_hook' );

function ewp_install_hook() {
  // Vamos testar a versão do PHP e do WordPress
  // caso as versões sejam antigas, desativamos
  // o nosso plugin.
  if ( version_compare( PHP_VERSION, '5.2.1', '<' )
    or version_compare( get_bloginfo( 'version' ), '3.3', '<' ) ) {
      deactivate_plugins( basename( __FILE__ ) );
  }
}

function ewp_unistall_hook(){
	include_once( plugin_dir_path( __FILE__ ) . 'uninstall.php' );
}

add_action( 'init', 'ewp_create_table' ); #Cria o banco de dados e a pasta onde vai ser salvo os arquivos

add_action('wp_print_styles', 'estilos'); #Onde é chamado os CSSs do plugin - Visual externo do plugin

add_action('admin_menu', 'ewp_pagina_opcoes'); #Cria um painel do plugin no administrativo do wordpress
 
function ewp_pagina_opcoes() {
  	
	#Cria um menu dentro do menu options
	add_menu_page( 'WP-Currículo Vitae Free - Painel', 'Currículo Vitae Free', 'manage_options', 'curriculo_vitae','menu_curriculo_vitae', plugins_url('img/User-Files-icon2.png', __FILE__) );
	
	#Submenu que exibe a lista de currículos cadastrados
	add_submenu_page( 'curriculo_vitae', 'Lista de currículos', 'Lista de currículos', 'manage_options', 'lista-de-curriculos', 'submenu_lista_curriculos' );
	
	#Submenu que exibe as áreas de serviços cadastrada e possibilita cadastrar novas áreas  
	add_submenu_page( 'curriculo_vitae', 'Áreas de serviços', 'Áreas de serviços', 'manage_options', 'areas-de-servicos', 'submenu_areas' );

}

// Interior da página de Opções.
// Esta função imprime o conteúdo da página no ecrã.
// O HTML necessário encontra-se já escrito.
function menu_curriculo_vitae() {
	include_once( plugin_dir_path( __FILE__ ) . 'informativo.php' );
}

function submenu_lista_curriculos() {
	include_once( plugin_dir_path( __FILE__ ) . 'listaCurriculosAdmin.php' );
}

function submenu_areas() {
	include_once( plugin_dir_path( __FILE__ ) . 'areasServicos.php' );
}

#Função que faz instalação do banco e cria a pasta
function ewp_create_table() {
  include_once( plugin_dir_path( __FILE__ ) . 'install.php' );
}

#funcão que faz o cadastro
function cadastrar() {
	include_once( plugin_dir_path( __FILE__ ) . 'formCadastro.php' );
}

function listCurriculos() {
	include_once( plugin_dir_path( __FILE__ ) . 'listaCurriculos.php' );
}

#shortcode que chama formulario de cadastro
add_shortcode( 'formCadastro', 'cadastrar');
	
#shortcode para listar os currículos
add_shortcode( 'listCurriculos', 'listCurriculos' );

function estilos() {
	include_once( plugin_dir_path( __FILE__ ) . 'style.php' );
}

?>