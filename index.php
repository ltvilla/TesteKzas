<?php

require __DIR__ . "/vendor/autoload.php";

header('Content-Type: application/json; charset: utf-8');

class ApiPuro
{
    public static function open($classe, $metodo)
    {

        try {
            if(class_exists($classe)){
                if(method_exists($classe, $metodo)){
                    $companies = \App\Company::all();
                    return json_encode(array('status' => 'sucesso', $dados => $companies));
            } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'Metodo inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'dados' => 'erro na api'));
        }
    }
}

if(isset($_REQUEST)){
    ApiPuro::open($_REQUEST['classe'], $_REQUEST['metodo']);
}
