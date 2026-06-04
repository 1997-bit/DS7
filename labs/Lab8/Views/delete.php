<?php
$libro = json_encode(["id" => $_POST['id']]);

$opciones = [
    "http" => [
        "method"  => "DELETE",
        "header"  => "Content-Type: application/json",
        "content" => $libro
    ]
];
$contexto = stream_context_create($opciones);
file_get_contents("http://localhost/DS7/labs/Lab8/Server/Index.php", false, $contexto);

header("Location: index.php");
exit;
?>