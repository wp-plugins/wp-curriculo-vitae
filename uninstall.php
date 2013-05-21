<?php
 
// Vamos garantir que é o WordPress que chama este ficheiro
// e que realmente está a desistalar o plugin.
#if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
 # die();
 

// Acesso ao objeto global de gestão de bases de dados
global $wpdb;

// Vamos checar se a nova tabela existe
// A propriedade prefix é o prefixo de tabela escolhido na
// instalação do WordPress


// Se a tabela não existe vamos criá-la

  $sql = "DROP TABLE wls_curriculo";
  $wpdb->query($sql);
  
  $sql = "DROP TABLE wls_areas";
  $wpdb->query($sql);

  $upload = wp_upload_dir();
  $upload_dir = $upload['basedir'];
  $upload_dir = $upload_dir . '/curriculos';
  
  @rmdir($upload_dir);

 
?>