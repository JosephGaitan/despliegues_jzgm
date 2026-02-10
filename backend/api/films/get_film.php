<?php
require_once "../../utils/utils.php";
require_once "../db/db.php";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {

		//Control errores falta de un dato
		if(empty($_GET["id"])) {
			echo getResponse(400,"KO_MISSING","Falta el atributo id");
			exit;
		}

        $resp = getFilmDB($_GET["id"]);

        if(is_null($resp))
            echo getResponse(500,"KO","Error interno de base de datos");
        else 
            echo count($resp) > 0 ? getResponse(200,"OK", "Película obtenida correctamente", $resp[0]) : getResponse(404,"KO_NOT_FOUND", "Película no encontrada");

    } else {
        echo getResponse(400,"KO_REQUEST","Tipo de petición incorrecta");
    }

} catch(Exception $e) {
    echo getResponse(500,"KO","Error interno");
}