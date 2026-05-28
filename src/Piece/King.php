<?php
namespace ChessGame\Piece;

use BcMath\Number;
use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Board;
use Exception;

class King extends Piece {

    public function __construct(PieceColor $color, Position $position) {
        parent::__construct($color,$position);
        $this->type = PieceType::KING;
    }
    public function render(): string
    {
        return match ($this->color) {
            PieceColor::BLACK => "k",
            PieceColor::WHITE => "K",
            default => throw new \Exception("Erreur couleur invalide")
        };
    }
    protected function isValidMovementShape(Position $target): bool
    {
        $kingCaseMovementColumn = $target->getColumn() - $this->position->getColumn(); 
        $kingCaseMovementRow = $target->getRow() - $this->position->getRow();
        if($kingCaseMovementColumn <= 1 && $kingCaseMovementRow <=1 && $kingCaseMovementColumn >= -1 && $kingCaseMovementRow >= -1) {
            return true;
        }
        return false;
    }
    public function canMove(Board $board, Position $target): bool
    {
        return parent::canMove($board, $target);
    }
}