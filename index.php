<?php
require 'vendor/autoload.php';
// require __DIR__ . '/routes.php'; // Incluye las rutas para la API

use tenischallenge\Repositorios\DataJugadores;
use  tenischallenge\Entidades\Masculino;

// use tenischallenge\Servicios\ChallengeServicios;

$dataJugadores = new DataJugadores();

// $torneoServicios = new ChallengeServicios($dataJugadores);
$jugadores = $dataJugadores->leerJugadores();
$nombresMasculinos = array_map(function($jugador) {
    return $jugador->obtenerNombre();
}, $jugadores['jugadorasFemeninos']);

echo json_encode($nombresMasculinos, JSON_UNESCAPED_UNICODE);
// Obtener los ganadores de los torneos
// $ganadores = $torneoServicios->torneoXGeneros();

// echo '<br><br>';
// echo "\n=== Resultados Finales ===\n";
// echo '<br>';
// echo "Ganador Challenge Masculino: " . $ganadores['masculino']->obtenerNombre();
// echo '<br>';
// echo "Ganador Challenge Femenino: " . $ganadores['femenino']->obtenerNombre();