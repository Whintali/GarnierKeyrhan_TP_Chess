<?php
namespace ChessGame\Piece;

use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Board;
use Exception;

class Knight extends Piece {

    public function __construct(PieceColor $color, Position $position) {
        parent::__construct($color,$position);
        $this->type = PieceType::KNIGHT;
    }
    public function render(): string
    {
        return match ($this->color) {
            PieceColor::BLACK => "n",
            PieceColor::WHITE => "N",
            default => throw new \Exception("Erreur couleur invalide")
        };
    }
    protected function isValidMovementShape(Position $target): bool
    {
        $knightDifferenceColumn = $target->getColumn() - $this->position->getColumn();
        $knightDifferenceRow = $target->getRow() - $this->position->getRow();
        
        // Knight : (2,1) ou (1,2) ou (-2,1) ou (-1,2) etc
        if(($knightDifferenceColumn === 2 && $knightDifferenceRow === 1) || ($knightDifferenceColumn === 2 && $knightDifferenceRow === -1) ||
        ($knightDifferenceColumn === -2 && $knightDifferenceRow === 1) || ($knightDifferenceColumn === -2 && $knightDifferenceRow === -1) ||
        ($knightDifferenceColumn === 1 && $knightDifferenceRow === 2) || ($knightDifferenceColumn === 1 && $knightDifferenceRow === -2) ||
        ($knightDifferenceColumn === -1 && $knightDifferenceRow === 2) || ($knightDifferenceColumn === -1 && $knightDifferenceRow === -2)) {
            return true;
        }
        return false;
    }
    public function canMove(Board $board, Position $target): bool
    {
        return parent::canMove($board, $target);
    }
}