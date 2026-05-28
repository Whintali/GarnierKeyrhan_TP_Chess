<?php
namespace ChessGame\Piece;

use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Board;
use Exception;

class Bishop extends Piece {

    public function __construct(PieceColor $color, Position $position) {
        parent::__construct($color,$position);
        $this->type = PieceType::BISHOP;
    }
    public function render(): string
    {
        return match ($this->color) {
            PieceColor::BLACK => "b",
            PieceColor::WHITE => "B",
            default => throw new \Exception("Erreur couleur invalide")
        };
    }
    protected function isValidMovementShape(Position $target): bool
    {
        if(($target->getColumn() != $this->position->getColumn()) && ($target->getRow() != $this->position->getRow())) {
            return true;
        }
        return false;
    }
    public function canMove(Board $board, Position $target): bool
    {
        return parent::canMove($board, $target);
    }
}