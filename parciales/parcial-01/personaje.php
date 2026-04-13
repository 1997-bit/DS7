<?php
require_once 'DañoFijo.php';
require_once 'Habilidad.php';



class Personaje
{

    /* Estrategia
        Personaje.php será la clase para crear todos los personajes so el ogro y Gandalf . 
        Los atributos básicos que debe tener son: nombre, vida, mana y habilidades (arreglo). 
        Debe incluir como mínimo los métodos 
        estaVivo(), usarHabilidad(),  () y recibirDanio().

        */
    protected $nombre;
    protected $vida;
    protected $mana;
    protected $habilidades = [];
    protected $nivel;
    protected $experiencia;

    public function __construct($nombre, $vida, $mana)
    {
        $this->nombre = $nombre;
        $this->vida = $vida;
        $this->mana = $mana;
        $this->nivel = 1;
        $this->experiencia = 0;
    }

    public function getVida()
    {
        return $this->vida;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getMana()
    {
        return $this->mana;
    }

    public function usarHabilidad(string $nombreHab, Personaje $objetivo)
    {
        if (!isset($this->habilidades[$nombreHab])) {
            throw new Exception("Error: El personaje no conoce la habilidad '$nombreHab'.");
        }

        $habilidad = $this->habilidades[$nombreHab];

        // 2. Validar mana suficiente [1]
        if ($this->mana < $habilidad->getCostoMana()) {
            throw new Exception("Error: Mana insuficiente para usar " . $habilidad->getNombre() . ".");
        }

        $this->mana -= $habilidad->getCostoMana();

        $daño = $habilidad->calcularDaño();
        $objetivo->recibirDaño($daño);

        if (!$objetivo->estaVivo()) {
            $this->ganarExperiencia(50);
        }
    }


    public function aprenderHabilidad(Habilidad $habilidad)
    {
        $this->habilidades[$habilidad->getNombre()] = $habilidad;
        echo "- {$this->nombre} aprendió: " . $habilidad->getNombre() . "<br>";
    }

    public function recibirdaño($daño)
    {


        $this->vida -= $daño;
        if ($this->vida < 0) {
            $this->vida = 0;
        }
        echo "{$this->nombre} ha recibido $daño de daño <br> {$this->vida} restante.<br>";

        if (!$this->estavivo()) {
            echo "{$this->nombre} ha sido asesinado...<br>";
        }
    }

    public function estavivo()
    {
        return $this->vida > 0;
    }

    public function ganarExperiencia($xp)
    {
        $this->experiencia += $xp;
        echo "{$this->nombre} gano {$xp} XP<br>";

        $this->subirNivel();
    }

    private function subirNivel()
    {

        $xpNecesaria = $this->nivel * 50;

        if ($this->experiencia >= $xpNecesaria) {
            $this->nivel++;
            $this->experiencia = 0;


            $this->vida += 20;
            $this->mana += 10;

            echo "{$this->nombre} subio a nivel {$this->nivel}!<br>";
        }
    }
}
