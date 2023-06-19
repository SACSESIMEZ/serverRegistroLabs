<?php

	include('conBD.php');

	$json = array();
	if(isset($_POST["numero"], $_POST["numeroLab"]){
		$consulta;
		$bandera = false;
		if(isset($_POST["idComputadora"])){
			$consulta = $connection->prepare("UPDATE computadoras SET numero = :numero, numero_lab = :numeroLab WHERE id_computadora = :idComputadora");
			$consulta->bindParam("idComputadora", $_POST["idComputadora"], PDO::PARAM_STR);
			$bandera = true;
		} else{
			$consulta = $connection->prepare("INSERT INTO computadoras (numero, numero_lab) VALUES (:numero, :numeroLab");	
		}
		$consulta->bindParam("numero", $_POST["numero"], PDO::PARAM_STR);
		$consulta->bindParam("numeroLab", $_POST["numeroLab"], PDO::PARAM_STR);
		if($consulta->execute()){
			array_push($json, array("res" => $bandera ? $consulta->lastInsertId() : 0);
		} else{
			array_push($json, array("res" => -1);
		}
		
	} else{
		array_push($json, array("res" => -1);
	}
	echo json_encode($json);
?>