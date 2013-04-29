<?php
global $post,$wpdb;

  // Vamos checar se a nova tabela existe
  // A propriedade prefix é o prefixo de tabela escolhido na
  // instalação do WordPress

	$sql = "SELECT * FROM wls_curriculo where 1=1  ";
	$query = $wpdb->get_results( $sql );
	print_r($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>