<?php

namespace ChessGame\Exception;
use Exception;
use ChessGame\Piece\Piece;
use ChessGame\Position;

class InvalidMoveException extends Exception {
    private Position $from;
    private Position $to;

    public function __construct(Position $from,Position $to) {
        $this->to = $to;
        $this->from = $from;
        $returnMessage = "Can't move on this position ". $this->to->toKey() ." from this position ". $this->from->toKey();
        parent::__construct($returnMessage);
    }
}