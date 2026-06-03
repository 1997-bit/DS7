<?php
//Es el cliente que consume el WSDL. 
class SoapController {
    public function ejecutarOperacion() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Capa 3: Saneamiento de datos [8, 9]
            $n1 = filter_var($_POST['n1'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $n2 = filter_var($_POST['n2'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            $op = $_POST['operacion'];

            try {
                // Instancia el cliente usando el WSDL
                $client = new SoapClient("http://localhost/DS7/labs/Lab7/Server/servicio.wsdl");
                
                // Ejecución remota del método
                return $client->$op($n1, $n2);

            } catch (SoapFault $e) {
                return "Error: " . $e->getMessage();
            }
        }
        return null;
    }
}
?>