<?php
require_once __DIR__ . '/vendor/autoload.php';

use ChessGame\Game;
use ChessGame\Position;
use ChessGame\Move;

echo "=== JEU D'ECHECS ===\n\n";

$game = new Game();
$game->start();

echo "--- Plateau initial ---\n";
echo $game->getBoard()->render();
echo "\n\nJoueur Suivant : " . $game->getCurrentPlayer()->name . "\n\n";



try {
    $move = new Move(new Position(6, 5), new Position(5, 5));
    $game->play($move);
    echo "Coup joué\n";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
echo $game->getBoard()->render();
echo "\n\nJoueur Suivant : " . $game->getCurrentPlayer()->name . "\n\n";


try {
    $move = new Move(new Position(0, 1), new Position(2, 0));
    $game->play($move);
    echo "Coup joué\n";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
echo $game->getBoard()->render();
echo "\n\nJoueur Suivant : " . $game->getCurrentPlayer()->name . "\n\n";


try {
    $move = new Move(new Position(7, 4), new Position(6, 5));
    $game->play($move);
    echo "Coup joué\n";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
echo $game->getBoard()->render();
echo "\n\nJoueur Suivant : " . $game->getCurrentPlayer()->name . "\n\n";


try {
    $move = new Move(new Position(0, 0), new Position(0, 1));
    $game->play($move);
    echo "Coup joué\n";
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage() . "\n";
}
echo $game->getBoard()->render();
echo "\n\nJoueur Suivant : " . $game->getCurrentPlayer()->name . "\n\n";
