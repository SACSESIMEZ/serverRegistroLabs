<?php

	include('conBD.php');

	$json = array();
	if(isset($_POST["idAcceso"])){
		$consulta = $connection->prepare("INSERT INTO accesos (hora_salida) VALUES (:horaSalida) WHERE id_acceso = :idAcceso");
		$consulta->bindParam("idAcceso", $_POST["idAcceso"], PDO::PARAM_STR);
		$consulta->bindParam("horaSalida", date("H-i-s"), PDO::PARAM_STR);
		
		array_push($json, array("res" => $consulta->execute()));
	} else{
		array_push($json, array("res" => false));
	}
	echo json_encode($json);
?>