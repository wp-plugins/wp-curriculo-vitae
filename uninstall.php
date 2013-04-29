<?php
 
// Vamos garantir que é o WordPress que chama este ficheiro
// e que realmente está a desistalar o plugin.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
  die();
 

// Acesso ao objeto global de gestão de bases de dados
global $wpdb;

// Vamos checar se a nova tabela existe
// A propriedade prefix é o prefixo de tabela escolhido na
// instalação do WordPress
$tablename = $wpdb->prefix . 'wls_curriculo';

// Se a tabela não existe vamos criá-la
if ( $wpdb->get_var( "SHOW TABLES LIKE '$tablename'" ) != $tablename ) {

  $sql = "DROP TABLE wls_curriculo;";

  // Para usarmos a função dbDelta() é necessário carregar este ficheiro
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  dbDelta( $sql );
  
  $upload = wp_upload_dir();
  $upload_dir = $upload['basedir'];
  $upload_dir = $upload_dir . '/curriculos';
  
  @rmdir($upload_dir);
}

 
// Vamos remover as opções que criámos na instalação
#delete_option( 'ewp_opcao' );
 
?>