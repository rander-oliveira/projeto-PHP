﻿<?php
	// include("Connections/tig.php");

	$hostname_TIG = "localhost";
	$database_TIG = "nomeBancoDados";
	$username_TIG = "userLocal";
	$password_TIG = "senhaUserLocal";
	$TIG = new mysqli( $hostname_TIG, $username_TIG, $password_TIG); 
	mysqli_set_charset( $TIG, 'utf8' );

	// Create connection
	$TIG = new mysqli( $hostname_TIG, $username_TIG, $password_TIG); 
	mysqli_set_charset( $TIG, 'utf8' );

	// Check connection
	if ($TIG->connect_error) {
	   die("Connection failed: " . $TIG->connect_error);
	} 

	$sl_user = mysqli_query( $TIG, "SELECT * FROM nomeBancoDados.users
		WHERE users.id_usuario = '".$user."'" ) or die( mysqli_error( $TIG ) );


	$slUser = mysqli_query($TIG, "SELECT * FROM u793605722_tig5.users
									LEFT JOIN nomeBancoDados.interesse
										ON (users.email = interesse.email_usuario)
									LEFT JOIN nomeBancoDados.cadastro
										ON(cadastro.fk_usuario = users.id_usuario)
									WHERE '".$user."' = cadastro.fk_usuario") or die( mysqli_error( $TIG ) );

	$slInteresse = mysqli_query($TIG, "SELECT * FROM u793605722_tig5.materia
									JOIN nomeBancoDados.interesse
										ON (interesse.fk_materia = materia.id)
									 LEFT JOIN nomeBancoDados.users
										ON (users.email = interesse.email_usuario)
									WHERE users.id_usuario = '".$user."' ORDER BY interesse.id") or die( mysqli_error( $TIG ) );

?>
