<?php

//Quiero que todas las respuestas tengan el mismo formato, para ello me creo una función que me devuelve la respuesta
function getResponse($code=200, $status="",$message="",$data="") {
    $response = array(
        "status"=>$status,
        "message"=>$message,
        "data"=>$data
    );

    header("Content-Type:application/json");
    http_response_code($code);
    return json_encode($response,JSON_UNESCAPED_UNICODE);
}
 