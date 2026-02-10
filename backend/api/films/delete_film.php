<?php
require_once "../../utils/utils.php";
require_once "../db/db.php";

try {
	if ($_SERVER["REQUEST_METHOD"] == "DELETE") {

		//Recibir un JSON
		$jsonBody = file_get_contents('php://input');
		$jsonBody = json_decode($jsonBody,true);

		//Control errores falta de un dato
		if(empty($jsonBody["id"])) {
			echo getResponse(400,"KO_MISSING","Falta el atributo id");
			exit;
		}

		$resp = deleteFilmDB($jsonBody["id"]);

		if(is_null($resp))
			echo getResponse(500,"KO","Error interno de base de datos");
		else
            echo $resp > 0 ? getResponse(200,"OK","Película eliminada correctamente!") : getResponse(500,"KO_ADD","Error al eliminar película");

	} else {
		echo getResponse(400,"KO_REQUEST","Tipo de petición incorrecta");
	}

} catch(Exception $e) {
	echo getResponse(500,"KO","Error interno");
}