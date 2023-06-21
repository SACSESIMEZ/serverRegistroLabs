<?php

	include('conBD.php');

	$json = array();
	try {
		if(isset($_REQUEST["idUsuario"]) && isset($_REQUEST["idComputadora"])){
			$consulta = $connection->prepare("INSERT INTO accesos (id_computadora, id_usuario, fecha, hora_entrada) VALUES (:idComputadora, :idUsuario, :fecha, :horaEntrada)");
			$consulta->bindParam("idComputadora", $_REQUEST["idComputadora"], PDO::PARAM_STR);
			$consulta->bindParam("idUsuario", $_REQUEST["idUsuario"], PDO::PARAM_STR);
			$consulta->bindParam("fecha", date("Y-m-d"), PDO::PARAM_STR);
			$consulta->bindParam("horaEntrada", date("H-i-s"), PDO::PARAM_STR);
			$idAcceso = ($consulta->execute()) ? $connection->lastInsertId() : -1;
			array_push($json, array("res" => $idAcceso, "msg" => "Inicio exitoso"));
		} else{
			array_push($json, array("res" => -1, "msg" => "No se enviaron todos los datos"));
		}
	} catch (Exception $e) {
		array_push($json, array("res" => -1, "msg" => $e));	
	}
	echo json_encode($json);
?>