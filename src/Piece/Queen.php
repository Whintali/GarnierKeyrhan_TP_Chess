<?php
namespace ChessGame\Piece;

use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Board;
use Exception;

class Queen extends Piece {

    public function __construct(PieceColor $color, Position $position) {
        parent::__construct($color,$position);
        $this->type = PieceType::QUEEN;
    }
    public function render(): string
    {
        return match ($this->color) {
            PieceColor::BLACK => "q",
            PieceColor::WHITE => "Q",
            default => throw new \Exception("Erreur couleur invalide")
        };
    }
    protected function isValidMovementShape(Position $target): bool
    {
        return true;
    }
    public function canMove(Board $board, Position $target): bool
    {
        return parent::canMove($board, $target);
    }
}