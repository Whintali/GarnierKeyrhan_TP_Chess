<?php
namespace ChessGame\Exception;
use Exception;
use ChessGame\Piece\Piece;

class WrongTurnException extends Exception {
    private Piece $pieceActual; 

    public function __construct(Piece $pieceActual) {
        $this->pieceActual = $pieceActual;
        $returnMessage = "Can't move this piece (".$pieceActual->render()."), it's not your turn";
        parent::__construct($returnMessage);
    }
}