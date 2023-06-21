<?php

	include('conBD.php');

	$json = array();
	try{
		if(isset($_POST["num"], $_POST["numLab"])){
			$consulta;
			$bandera = false;
			if(isset($_POST["idComputadora"])){
				$consulta = $connection->prepare("UPDATE computadoras SET num = :num, num_lab = :numLab WHERE id_computadora = :idComputadora");
				$consulta->bindParam("idComputadora", $_POST["idComputadora"], PDO::PARAM_STR);
				$bandera = true;
			} else{
				$consulta = $connection->prepare("INSERT INTO computadoras (num, num_lab) VALUES (:num, :numLab)");	
			}
			$consulta->bindParam("num", $_POST["num"], PDO::PARAM_STR);
			$consulta->bindParam("numLab", $_POST["numLab"], PDO::PARAM_STR);
			if($consulta->execute()){
				array_push($json, array("res" => $bandera ? $consulta->lastInsertId() : 0, "msg" => "Registro exitoso"));
			} else{
				array_push($json, array("res" => -1, "msg" => "Error al registrar"));
			}
			
		} else{
			array_push($json, array("res" => -1, "msg" => "No se enviaron todos los datos".$_POST["num"]." ".$_POST["numLab"]));
		}
	} catch(Exception $e){
		array_push($json, array("res" => -1, "msg" => $e));
	}
	
	echo json_encode($json);
?>