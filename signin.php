<?php

	include('conBD.php');

	$json = array();
	try{
		if(isset($_REQUEST["idUsuario"], $_REQUEST["nombre"], $_REQUEST["correo"], $_REQUEST["idTipo"], $_REQUEST["idDeptoCarrera"])){
			$consulta = $connection->prepare("INSERT INTO usuarios VALUES (:idUsuario, :nombre, :correo, :idTipo)");
			$consulta->bindParam("idUsuario", $_REQUEST["idUsuario"], PDO::PARAM_STR);
			$consulta->bindParam("nombre", $_REQUEST["nombre"], PDO::PARAM_STR);
			$consulta->bindParam("correo", $_REQUEST["correo"], PDO::PARAM_STR);
			$consulta->bindParam("idTipo", $_REQUEST["idTipo"], PDO::PARAM_STR);
			if($consulta->execute()){
				if($_REQUEST["idTipo"] == 4){
					$consulta = $connection->prepare("INSERT INTO usuario_depto (id_usuario, id_depto) VALUES (:idUsuario, :idDepto)");
					$consulta->bindParam("idUsuario", $_REQUEST["idUsuario"], PDO::PARAM_STR);
					$consulta->bindParam("idDepto", $_REQUEST["idDeptoCarrera"], PDO::PARAM_STR);
				} else{
					$consulta = $connection->prepare("INSERT INTO usuario_carrera (id_usuario, id_carrera) VALUES (:idUsuario, :idCarrera)");
					$consulta->bindParam("idUsuario", $_REQUEST["idUsuario"], PDO::PARAM_STR);
					$consulta->bindParam("idCarrera", $_REQUEST["idDeptoCarrera"], PDO::PARAM_STR);
				}
				array_push($json, array("res" => $consulta->execute(), "msg" => "Registrado"));
			} else{
				array_push($json, array("res" => false, "msg" => "Error en insert"));
			}
		} else{
			array_push($json, array("res" => false, "msg" => "No se enviaron todos los datos"));
		}
	}catch(Exception $e){
		array_push($json, array("res" => false, "msg" => $e));
	}

	echo json_encode($json);
?>