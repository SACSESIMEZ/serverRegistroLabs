<?php

	include('conBD.php');

	$json = array();
	if(isset($_POST["idUsuario"], $_POST["nombre"], $_POST["correo"], $_POST["idTipo"], $_POST["idDeptoCarrera"])){
		$consulta = $connection->prepare("INSERT INTO usuarios VALUES (:idUsuario, :nombre, :correo, :idTipo");
		$consulta->bindParam("idUsuario", $_POST["idUsuario"], PDO::PARAM_STR);
		$consulta->bindParam("nombre", $_POST["nombre"], PDO::PARAM_STR);
		$consulta->bindParam("correo", $_POST["correo"], PDO::PARAM_STR);
		$consulta->bindParam("idTipo", $_POST["idTipo"], PDO::PARAM_STR);
		if($consulta->execute()){
			if($_POST["idTipo"] == 4){
				$consulta = $connection->prepare("INSERT INTO usuario_depto (id_usuario, id_depto) VALUES (:idUsuario, :idDepto");
				$consulta->bindParam("idUsuario", $_POST["idUsuario"], PDO::PARAM_STR);
				$consulta->bindParam("idDepto", $_POST["idDeptoCarrera"], PDO::PARAM_STR);
			} else{
				$consulta = $connection->prepare("INSERT INTO usuario_carrera (id_usuario, id_carrera) VALUES (:idUsuario, :idCarrera");
				$consulta->bindParam("idUsuario", $_POST["idUsuario"], PDO::PARAM_STR);
				$consulta->bindParam("idCarrera", $_POST["idDeptoCarrera"], PDO::PARAM_STR);
			}
			array_push($json, array("res" => $consulta->execute());
			echo json_encode($json);
		}
	} else{
		array_push($json, array("res" => false);
		echo json_encode($json);
	}
?>