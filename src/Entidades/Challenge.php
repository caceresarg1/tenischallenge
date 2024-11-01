<?php

namespace tenischallenge\Entidades;

class Challenge {
    private $jugadores = [];
    private $detallePartidos = [];
    private $fase = 1;

    public function __construct($jugadores) {
        $this->jugadores = $jugadores;
    }

    private function simularPartido(Jugador $jugador1, Jugador $jugador2): Jugador {
        $suerte1 = rand(0, 100);
        $suerte2 = rand(0, 100);

        $rendimiento1 = $jugador1->calcularRendimiento() + $suerte1;
        $rendimiento2 = $jugador2->calcularRendimiento() + $suerte2;

        // echo $jugador1->obtenerNombre() . " (" . $rendimiento1 . ") vs " . $jugador2->obtenerNombre() . " (" . $rendimiento2 . ")\n";

        $this->registrarPartido($jugador1, $jugador2, $rendimiento1, $rendimiento2);

        return $rendimiento1 >= $rendimiento2 ? $jugador1 : $jugador2;
    }
    
    // public function iniciarChallenge(): Jugador {
    //     $fase           = 1;
    //     $rondaJugadores = $this->jugadores;

    //     while (count($rondaJugadores) > 1) {
    //         echo "<br>";
    //         echo "Fase $fase:\n ";
    //         echo "<br>";

    //         $rondaJugadores = $this->iniciarRonda($rondaJugadores);
    //         $fase++;
    //     }

    //     return $rondaJugadores[0]; // Ganador final
    // }

    public function iniciarChallenge(): Jugador {
        $rondaJugadores = $this->jugadores;

        while (count($rondaJugadores) > 1) {
            $rondaJugadores = $this->iniciarRonda($rondaJugadores);
            $this->fase++;
        }

        return $rondaJugadores[0]; // Ganador final
    }

    private function iniciarRonda(array $jugadores) : array {
        $ganadores = [];

        for ($i = 0; $i < count($jugadores); $i += 2) {
            if (!isset($jugadores[$i + 1])) {
                $ganadores[] = $jugadores[$i];
            } else {
                $ganador = $this->simularPartido($jugadores[$i], $jugadores[$i + 1]);
                $ganadores[] = $ganador;
            }
        }
        return $ganadores;
    }

    public function  registrarPartido(Jugador $jugador1, Jugador $jugador2, int $rendimiento1, int $rendimiento2) {
        $this->detallePartidos[] = [
            'fase' => $this->fase,
            'jugador1' => $jugador1->obtenerNombre(),
            'rendimiento1' => $rendimiento1,
            'jugador2' => $jugador2->obtenerNombre(),
            'rendimiento2' => $rendimiento2
        ];
    }

    public function obtenerDetallesPartido(): array {
        return $this->detallePartidos;
    }
}
