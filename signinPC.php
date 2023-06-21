<?php

	include('conBD.php');

	/*function getLastInsertId(){
		$consulta = $connection->prepare("SELECT id_computadora FROM  computadoras WHERE numero = :num AND numero_lab = :numLab");
		$consulta->bindParam("num", $_REQUEST["num"], PDO::PARAM_STR);
		$consulta->bindParam("numLab", $_REQUEST["numLab"], PDO::PARAM_STR);
		$consulta->execute();
		if($consulta->rowCount() != 0){
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            return $resultado["id_computadora"];
        }
	}*/

	$json = array();
	try{
		if(isset($_REQUEST["num"], $_REQUEST["numLab"])){
			$consulta;
			$bandera = false;
			if(isset($_REQUEST["idComputadora"])){
				$consulta = $connection->prepare("UPDATE computadoras SET numero = :num, numero_lab = :numLab WHERE id_computadora = :idComputadora");
				$consulta->bindParam("idComputadora", $_REQUEST["idComputadora"], PDO::PARAM_STR);
				$bandera = true;
			} else{
				$consulta = $connection->prepare("INSERT INTO computadoras (numero, numero_lab) VALUES (:num, :numLab)");	
			}
			$consulta->bindParam("num", $_REQUEST["num"], PDO::PARAM_STR);
			$consulta->bindParam("numLab", $_REQUEST["numLab"], PDO::PARAM_STR);
			if($consulta->execute()){
				array_push($json, array("res" => $bandera ? 0 : $connection->lastInsertId(), "msg" => "Registro exitoso"));
			} else{
				array_push($json, array("res" => -1, "msg" => "Error al registrar"));
			}
			
		} else{
			array_push($json, array("res" => -1, "msg" => "No se enviaron todos los datos"));
		}
	} catch(Exception $e){
		array_push($json, array("res" => -1, "msg" => $e));
	}
	
	echo json_encode($json);
?>