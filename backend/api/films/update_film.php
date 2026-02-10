<?php
require_once "../../utils/utils.php";
require_once "../db/db.php";

try {
	if ($_SERVER["REQUEST_METHOD"] == "PUT") {

		//Recibir un JSON
		$jsonBody = file_get_contents('php://input');
		$jsonBody = json_decode($jsonBody,true);

		//Control errores falta de un dato
		if(empty($jsonBody["name"]) || empty($jsonBody["director"]) || empty($jsonBody["classification"])
		|| empty($jsonBody["img"])|| empty($jsonBody["plot"])|| empty($jsonBody["id"])) {
			echo getResponse(400,"KO_MISSING","Falta algún atributo");
			exit;
		}

		$name = $jsonBody["name"];
		$director = $jsonBody["director"];
		$classification = $jsonBody["classification"];
		$img = $jsonBody["img"];
		$plot = $jsonBody["plot"];
		$id = $jsonBody["id"];

		$data = array(
            "name" => $name,
            "director" => $director,
            "classification" => $classification,
            "img" => $img,
            "plot" => $plot,
			"id" => $id
        );

		$resp = updateFilmDB($data);

		if(is_null($resp))
			echo getResponse(500,"KO","Error interno de base de datos");
		else
            echo $resp > 0 ? getResponse(200,"OK","Película actualizada correctamente!") : getResponse(500,"KO_ADD","Error al actualizar película");

	} else {
		echo getResponse(400,"KO_REQUEST","Tipo de petición incorrecta");
	}

} catch(Exception $e) {
	echo getResponse(500,"KO","Error interno");
}