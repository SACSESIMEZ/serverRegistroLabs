<?php

	include('conBD.php');

	$json = array();
	$months = [4, 7, 10, 13];
	$numAccess = 0;
	$result;
	$flag = false;
	$check = 0;
	try {
		if(isset($_REQUEST["idUsuario"])){
			$query = $connection->prepare("SELECT count(id_acceso) as numAccess FROM accesos WHERE id_usuario = :idUsuario and extract(MONTH FROM fecha) < :month");
			$month = date('n');
			if($month < 7){
				$check++;
			} else if($month < 10){
				$check++;
			} else if($month < 13){
				$check++;
			}
			$query->bindParam("month", $months[$check], PDO::PARAM_STR);
			$query->bindParam("idUsuario", $_REQUEST["idUsuario"], PDO::PARAM_STR);
			$query->execute();
			if($query->rowCount() != 0){
	            $result = $query->fetch(PDO::FETCH_ASSOC);
	            $numAccess = $result["numAccess"];
	        }
			array_push($json, array("res" => $numAccess == 2, "msg" => "Consulta exitosa"));
		} else{
			array_push($json, array("res" => false, "msg" => "No se enviaron todos los datos"));
		}
	} catch (Exception $e) {
		array_push($json, array("res" => false, "msg" => $e));	
	}
	echo json_encode($json);
?>