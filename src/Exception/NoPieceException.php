<?php
namespace ChessGame\Exception;
use Exception;
use ChessGame\Piece\Piece;
use ChessGame\Position;

class NoPieceException extends Exception {
    private Position $position;

    public function __construct(Position $position) {
        $this->position = $position;
        $returnMessage = "No piece at this position : ". $this->position->toKey();
        parent::__construct($returnMessage);
    }
}