﻿<?php 

	$hostname_TIG = "localhost";
	$database_TIG = "nomeBancoDados";
	$username_TIG = "userLocal";
	$password_TIG = "passUserLocal";

	// Create connection
	$TIG = new mysqli( $hostname_TIG, $username_TIG, $password_TIG); 
	mysqli_set_charset( $TIG, 'utf8' );

	// Check connection
	if ($TIG->connect_error) {
	   die("Connection failed: " . $TIG->connect_error);
	} 	

	$RsQtdResposta =  "SELECT COUNT(*) AS qtd_respostas FROM nomeBancoDados.resposta WHERE (resposta.fk_pergunta = '".$pergunta."')"; 

	$result = mysqli_query($TIG, $RsQtdResposta);
	$row_RsQtdResposta = mysqli_fetch_assoc($result);
	
	$RsNivel = "SELECT SUM(avaliacao.avaliacao) AS cls_respostas FROM nomeBancoDados.avaliacao
		LEFT JOIN (nomeBancoDados.resposta)
			ON (resposta.fk_pergunta = '".$pergunta."')
			WHERE (avaliacao.fk_resposta = resposta.id AND resposta.fk_pergunta = '".$pergunta."')";	

	$result = mysqli_query($TIG, $RsNivel);
	$row_RsNivel = mysqli_fetch_assoc($result);
	
	$RsNivelResposta = "SELECT SUM(avaliacao.avaliacao) AS cls_respostas FROM nomeBancoDados.avaliacao
		LEFT JOIN (nomeBancoDados.resposta)
			ON (resposta.id = avaliacao.fk_resposta)
			WHERE (resposta.id = '".$id_resposta."')";	

	$result = mysqli_query($TIG, $RsNivelResposta);
	$row_RsNivelResposta = mysqli_fetch_assoc($result);

	$RsNivelUser = "SELECT SUM(avaliacao.avaliacao) AS cls_respostas FROM nomeBancoDados.avaliacao
		LEFT JOIN (nomeBancoDados.resposta)
			ON (resposta.fk_pergunta = '".$pergunta."')
			WHERE (avaliacao.fk_resposta = '".$id_resposta."' AND avaliacao.fk_usuario = '".$user."')";	

	$result = mysqli_query($TIG, $RsNivelUser);
	$row_RsNivelUser = mysqli_fetch_assoc($result);

	$TIG->close();

?>
