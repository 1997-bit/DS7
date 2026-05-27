<?php
$persona = [
            "nombre" => "Maria",
            "edad" => 24,
            "ciudad" =>"Madrid",
            "hobbies" =>["musica", "cine", "deporte"]
            ];
            $jsonString = json_encode($persona);
            file_put_contents("persona.json", $jsonString);

?>