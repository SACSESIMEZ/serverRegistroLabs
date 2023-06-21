<?php

	include('conBD.php');

	$json = array();
	try{
		if(isset($_REQUEST["idAcceso"])){
			$consulta = $connection->prepare("UPDATE accesos SET hora_salida = :horaSalida WHERE id_acceso = :idAcceso");
			$consulta->bindParam("idAcceso", $_REQUEST["idAcceso"], PDO::PARAM_STR);
			$time = date("H:i:s", time());
			$consulta->bindParam("horaSalida", $time, PDO::PARAM_STR);
			
			array_push($json, array("res" => $consulta->execute(), "msg" => "Salida exitosa"));
		} else{
			array_push($json, array("res" => false, "msg" => "No se enviaron todos los datos"));
		}
	} catch(Exception $e){
		array_push($json, array("res" => false, "msg" => $e));
	}
	echo json_encode($json);
?>