<?php
require_once __DIR__ . '/vendor/autoload.php';

use ChessGame\Game;
use ChessGame\Position;
use ChessGame\Move;

echo "=== JEU D'ECHECS - TEST CAPTURE DAME ===\n\n";

$game = new Game();
$game->start();

echo "--- Plateau initial ---\n";
echo $game->getBoard()->render();
echo "\n\nJoueur actuel : " . $game->getCurrentPlayer()->name . "\n\n";

echo "--- Coup 1 : Pion blanc e2 → e4 ---\n";
try {
    $move = new Move(new Position(6, 4), new Position(4, 4));
    $game->play($move);
    echo "✓ Coup joué\n";
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage() . "\n";
}
echo "Joueur actuel : " . $game->getCurrentPlayer()->name . "\n";
echo $game->getBoard()->render() . "\n\n";

echo "--- Coup 2 : Pion noir e7 → e5 ---\n";
try {
    $move = new Move(new Position(1, 4), new Position(3, 4));
    $game->play($move);
    echo "✓ Coup joué\n";
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage() . "\n";
}
echo "Joueur actuel : " . $game->getCurrentPlayer()->name . "\n";
echo $game->getBoard()->render() . "\n\n";

echo "--- Coup 3 : Dame blanche d1 → h5 ---\n";
try {
    $move = new Move(new Position(7, 3), new Position(3, 7));
    $game->play($move);
    echo "✓ Coup joué\n";
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage() . "\n";
}
echo "Joueur actuel : " . $game->getCurrentPlayer()->name . "\n";
echo $game->getBoard()->render() . "\n\n";

echo "--- Coup 4 : Pion noir a7 → a6 ---\n";
try {
    $move = new Move(new Position(1, 0), new Position(2, 0));
    $game->play($move);
    echo "✓ Coup joué\n";
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage() . "\n";
}
echo "Joueur actuel : " . $game->getCurrentPlayer()->name . "\n";
echo $game->getBoard()->render() . "\n\n";

echo "--- Coup 5 : Dame blanche h5 × e5 (CAPTURE) ---\n";
try {
    $move = new Move(new Position(3, 7), new Position(3, 4));
    $game->play($move);
    echo "✓ Pion noir capturé\n";
} catch (Exception $e) {
    echo "✗ Erreur : " . $e->getMessage() . "\n";
}
echo "Joueur actuel : " . $game->getCurrentPlayer()->name . "\n";
echo $game->getBoard()->render() . "\n\n";