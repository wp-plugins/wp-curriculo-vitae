<?php
// Acesso ao objeto global de gestão de bases de dados
global $wpdb;

// Vamos checar se a nova tabela existe
// A propriedade prefix é o prefixo de tabela escolhido na
// instalação do WordPress
$tablename = $wpdb->prefix . 'wls_curriculo';
$tablename = $wpdb->prefix . 'wls_area';

// Se a tabela não existe vamos criá-la
if ( $wpdb->get_var( "SHOW TABLES LIKE '$tablename'" ) != $tablename || $wpdb->get_var( "SHOW TABLES LIKE '$tablename'" ) != $tablename ) {

  $sql = "CREATE TABLE wls_curriculo (
			id int(11) NOT NULL AUTO_INCREMENT,
			id_area int(255),
			nome varchar(255) COLLATE latin1_bin DEFAULT NULL,
			descricao text COLLATE latin1_bin,
			login varchar(255) COLLATE latin1_bin DEFAULT NULL,
			senha varchar(255) COLLATE latin1_bin DEFAULT NULL,
			cpf varchar(255) COLLATE latin1_bin DEFAULT NULL,
			email varchar(255) COLLATE latin1_bin DEFAULT NULL,
			curriculo varchar(255) COLLATE latin1_bin DEFAULT NULL,
			PRIMARY KEY (`id`)
		  );
		  
		CREATE TABLE wls_areas (
			id int(11) NOT NULL AUTO_INCREMENT,
			area varchar(255) COLLATE latin1_bin DEFAULT NULL,
			PRIMARY KEY (`id`)
	  	)";

  // Para usarmos a função dbDelta() é necessário carregar este ficheiro
  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

  // Esta função cria a tabela na base de dados e executa as otimizações
  // necessárias.
  dbDelta( $sql );
  
  $upload = wp_upload_dir();
  $upload_dir = $upload['basedir'];
  $upload_dir = $upload_dir . '/curriculos';
  
  if (! is_dir($upload_dir)) {
	 mkdir( $upload_dir, 777 );
  }

}
?>