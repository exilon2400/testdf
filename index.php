<?php
$method = $_SERVER["REQUEST_METHOD"];

if ($method == "POST") {
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);

    $text = $json->queryResult->queryText;
    $action = $json->queryResult->action;
    $parameters = $json->queryResult->parameters;

    if ($action == "calc") {
        $a = $parameters->a;
        $b = $parameters->$b;
        $a++; $a--;
        $b++; $b--;

        if ($parameters->math_operator == "+") {
            $r = $a + $b;
            $speech = "ça fait ".$r." !";
        } elseif ($parameters->math_operator == "-") {
            $r = $a - $b;
            $speech = "ça fait ".$r." !";
        } elseif ($parameters->math_operator == "/") {
            $r = $a / $b;
            $speech = "ça fait ".$r." !";
        } elseif ($parameters->math_operator == "*") {
            $r = $a * $b;
            $speech = "ça fait ".$r." !";
        }
    } else {
        $speech = "Inconnue";
    }


    $response = new \stdClass();
    $response->speech = $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    echo json_encode($response);

} else {
    echo "Method not allowed";
}