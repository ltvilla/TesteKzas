<?php

require __DIR__ . "/vendor/autoload.php";

require_once 'Listapi.php';

header('Content-Type: application/json; charset=utf-8');

class ApiPuro
{
    public static function open($request)
    {
        $url = explode('/', $request['url']);

        $classe = ucfirst($url[0]);
        array_shift($url);

        $metodo = $url[0];
        array_shift($url);

        $parametros = array();
        $parametros = $url;

        try{
            if (class_exists($classe)) {
                if (method_exists($classe, $metodo)){
                    $retorno = call_user_func_array(array(new $classe, $metodo), $parametros);
                    return json_encode(array('status' => 'sucesso', 'dados' => $retorno));
                } else {
                    return json_encode(array('status' => 'erro', 'dados' => 'Metodo Inexistente!'));
                }
            } else {
                return json_encode(array('status' => 'erro', 'dados' => 'Classe Inexistente!'));
            }
        } catch (Exception $e) {
            return json_encode(array('status' => 'erro', 'dados' => $e->getMessage()));
        }

//
//        try {
//            if(class_exists($classe)){
//                if(method_exists($classe, $metodo)){
//                    $companies = \App\Company::all();
//                    return json_encode(array('status' => 'sucesso', $dados => $companies));
//            } else {
//                    return json_encode(array('status' => 'erro', 'dados' => 'Metodo inexistente!'));
//                }
//            } else {
//                return json_encode(array('status' => 'erro', 'dados' => 'Classe inexistente!'));
//            }
//        } catch (Exception $e) {
//            return json_encode(array('status' => 'erro', 'dados' => 'erro na api'));
//        }
    }


}

if(isset($_REQUEST)){
    echo ApiPuro::open($_REQUEST);


//    ApiPuro::open($_REQUEST['classe'], $_REQUEST['metodo']);
}
