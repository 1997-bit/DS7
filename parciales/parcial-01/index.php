<?php
    require_once 'Interface.php';
    require_once 'DañoFijo.php';
    require_once 'DañoAleatorio.php';
    require_once 'Habilidad.php';
    require_once 'personaje.php';

    //Index: Emulacion de combate con try catch incluido.

    try {
        echo "<h1>🎮 Simulación de Combate RPG</h1>";
        echo "<h3>--- Fase de Preparación ---</h3>";

        $fijo = new DañoFijo();
        $critico = new DañoAleatorio();

        $bolaFuego = new Habilidad("Bola de Fuego", 20, 50, $fijo);
        $rayo = new Habilidad("Rayo Divino", 30, 60, $critico);

        $gandalf = new Personaje("Gandalf", 100, 80);
        $orco = new Personaje("Orco", 150, 0);

        $gandalf->aprenderHabilidad($bolaFuego);
        $gandalf->aprenderHabilidad($rayo);

        echo "<br><h3>--- ¡COMIENZA EL COMBATE! ---</h3>";

        $turno = 1;
        while ($gandalf->estaVivo() && $orco->estaVivo()) {
            echo "<strong>Turno $turno:</strong><br>";
            try {
                $habilidadUsada = ($turno % 2 == 0) ? "Rayo Divino" : "Bola de Fuego";
                $gandalf->usarHabilidad($habilidadUsada, $orco);
            } catch (Exception $e) {
                echo "Gandalf intentó atacar pero: " . $e->getMessage() . "<br>";
            }

            if ($orco->estaVivo()) {
                $gandalf->recibirDano(15);
            }

            $turno++;
            echo "<hr>";
        }

        echo "<h3>--- COMBATE FINALIZADO ---</h3>";
        if (!$orco->estaVivo()) {
            echo "<strong>¡La victoria es de Gandalf! El Orco ha regresado a las sombras.</strong>";
        } else {
            echo "<strong>Gandalf ha caído... El mundo se sumerge en la oscuridad.</strong>";
        }
    } catch (Exception $e) {
        echo "<strong>Error Crítico del Sistema:</strong> " . $e->getMessage();
    }
?>