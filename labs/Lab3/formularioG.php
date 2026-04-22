<?php
// IMC GET
?>
        <style>
            body
            {
                background-color: rgba(93, 81, 226, 0.73);
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                height: 100vh;
                font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
           }

            section
            {
                background: rgba(15, 234, 15, 0.73);
                padding: 30px;
                border-radius: 15px;
                box-shadow: 0 10px 25px rgba(37, 7, 136, 0.73);
                width: 190px;
            }

            input
            {
                padding: 10px;
                border: 3px solid #754404;
                border-radius: 8px;
                transition: 0.3s;
            }

           #Enviar
           {
            cursor: pointer;
            margin-left: 50px;
           }

           #Enviar:hover
           {
                color: red;
                background: #e6df08;

           }

           #IrIMC {
                 cursor: pointer;
                 margin-left: 46px;
                 margin-top: 10px;
            }

            #IrIMC:hover {
                color: red;
                background: #e6df08;
            }

        </style>
<body>
    <form action="salidaG.php" method="GET">
    Nombre:<br>
    <input type="text" name="nombre" required><br><br>
    Peso (kg):<br>
    <input type="number" name="peso" required><br><br>
    Altura (m):<br>
    <input type="number" name="altura" step="any" required><br><br>
    <input type="submit" value="Calcular IMC">
    <input type="button" value="Regresar" id="IrConacto" onclick="window.location.href='formularioP.php'">

    </form>

    </form>

</body>

