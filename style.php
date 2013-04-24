<?php
wp_register_style( 'bootstrap', plugins_url('css/bootstrap.css', __FILE__));
wp_register_style( 'responsive', plugins_url('css/bootstrap-responsive.css', __FILE__) );

wp_enqueue_style( "bootstrap");
wp_enqueue_style( "responsive");

wp_register_script( 'bootstrapJS', plugins_url('js/bootstrap.min.js', __FILE__));

wp_enqueue_script('jquery');	
wp_enqueue_script('bootstrapJS');
?>