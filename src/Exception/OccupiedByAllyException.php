<?php
namespace ChessGame\Exception;
use Exception;
use ChessGame\Piece\Piece;

class OccupiedByAllyException extends Exception {
    private Piece $pieceActual; 
    private Piece $pieceAlly;

    public function __construct(Piece $pieceActual, Piece $pieceAlly) {
        $this->pieceActual = $pieceActual;
        $this->pieceAlly = $pieceAlly;
        $returnMessage = "This piece (".$pieceActual->render().")  can't move on this case, it's already used by an ally (".$pieceAlly->render().")";
        parent::__construct($returnMessage);
    }
}