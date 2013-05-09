<?php
wp_register_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_register_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );
wp_register_style( "prettyPhotoCSS", plugins_url('css/prettyPhoto.css', __FILE__) );

wp_enqueue_style( "bootstrap");
wp_enqueue_style( "responsive");
wp_enqueue_style( "prettyPhotoCSS");

wp_register_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));
wp_register_script( 'prettyPhotoJS', plugins_url('js/jquery.prettyPhoto.js', __FILE__));

wp_enqueue_script( 'jquery');	
wp_enqueue_script( 'bootstrapJS');
wp_enqueue_script( 'prettyPhotoJS');

?>