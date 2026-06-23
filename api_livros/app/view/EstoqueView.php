<?php

//[Sprint 11] Implementa Gestão de Estoque
class EstoqueView{

    public function sendResponse($data, $statusCode=200){
        http_response_code($statusCode);
        echo json_encode($data);
    }
}
?>