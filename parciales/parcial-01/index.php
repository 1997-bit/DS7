<?php
    require_once 'Interface.php';
    require_once 'DañoFijo.php';
    require_once 'DañoAleatorio.php';
    require_once 'Habilidad.php';
    require_once 'personaje.php';
    require_once 'Random.php';

    //Index: Emulacion de combate con try catch incluido.

    $random = new RandomPool();
    try {
        echo "<h1>🎮 Simulación de Combate RPG</h1>";
        echo "<h3>--- Fase de Preparación ---</h3>";


        $fijo = new DañoFijo();
        $critico = new DañoAleatorio();

        $bolaFuego = new Habilidad("Bola de Fuego", $random->rCostMana(), $random->rDaño(), $fijo);
        $rayo = new Habilidad("Rayo Divino", $random->rCostMana(), $random->rdaño(), $critico);

        $gandalf = new Personaje("P1", $random->rVida(), $random->rMana());
        $orco = new Personaje("P2", $random->rVidaEne(),0);

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
                $gandalf->recibirDaño($random->rDañoEne());
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