<?php
namespace ChessGame\Piece;

use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use Exception;

class Pawn extends Piece {

    public function __construct(PieceColor $color, Position $position) {
        parent::__construct($color,$position);
        $this->type = PieceType::PAWN;
    }
    public function render(): string
    {
        return match ($this->color) {
            PieceColor::BLACK => "p",
            PieceColor::WHITE => "P",
            default => throw new \Exception("Erreur couleur invalide")
        };
    }

    protected function isValidMovementShape(Position $target): bool
    {
        if($target->getColumn() === $this->position->getColumn()) { 
            if($this->getColor() === PieceColor::BLACK){
                if(($target->getRow() === ($this->getPosition()->getRow()+2) && $this->getPosition()->getRow() === 1)  || $target->getRow() === $this->position->getRow()+1) {
                    return true;
                }
            }
            else if($this->getColor() === PieceColor::WHITE) {
                if(($target->getRow() === ($this->getPosition()->getRow()-2) && $this->getPosition()->getRow() === 6)  || $target->getRow() === $this->position->getRow()-1) {
                    return true;
                }
            }
        }
        return false;
    }
    
}