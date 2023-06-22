<?php

	include('conBD.php');

	$json = array();
	$result;
	try {
		if(isset($_REQUEST["numLab"], $_REQUEST["answers"], $_REQUEST["programms"], $_REQUEST["suggestions"], $_REQUEST["idAcceso"])){
			$query = $connection->prepare("INSERT INTO encuestas (respuestas, programas, sugerencias, fecha, numero_lab) VALUES (:answers, :programms, :suggestions, :dateSurvey, :numLab)");
			$date = date("Y-m-d");
			$query->bindParam("answers", $_REQUEST["answers"], PDO::PARAM_STR);
			$query->bindParam("programms", $_REQUEST["programms"], PDO::PARAM_STR);
			$query->bindParam("suggestions", $_REQUEST["suggestions"], PDO::PARAM_STR);
			$query->bindParam("dateSurvey", $date, PDO::PARAM_STR);
			$query->bindParam("numLab", $_REQUEST["numLab"], PDO::PARAM_STR);
			if($query->execute()){
				array_push($json, array("res" => true, "msg" => "Encuesta registrada"));
			} else{
				$query = $connection->prepare("DELETE FROM accesos WHERE id_acceso = :idAcceso");
				$query->bindParam("idAcceso", $_REQUEST["idAcceso"], PDO::PARAM_STR);
				if($query->execute()){
					array_push($json, array("res" => false, "msg" => "Acceso denegado"));
				} else{
					array_push($json, array("res" => false, "msg" => "Error al guardar encuesta"));
				}
			}
		} else{
			array_push($json, array("res" => false, "msg" => "No se enviaron todos los datos"));
		}
	} catch (Exception $e) {
		array_push($json, array("res" => false, "msg" => $e));	
	}
	echo json_encode($json);
?>