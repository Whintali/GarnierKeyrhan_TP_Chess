<?php
namespace ChessGame\Piece;

use ChessGame\Board;
use ChessGame\Contract\Renderable;
use ChessGame\Enum\PieceType;
use ChessGame\Enum\PieceColor;
use ChessGame\Exception\OccupiedByAllyException;
use ChessGame\Position;
use Exception;
abstract class Piece implements Renderable {
    protected PieceColor $color;
    protected Position $position;
    protected PieceType $type;

    public function __construct(PieceColor $color, Position $position){
        $this->color = $color;
        $this->position = $position;
    }
    public function getColor(): PieceColor {
        return $this->color;
    }
    public function getPosition(): Position {
        return $this->position;
    }
    public function setPosition(Position $position): void {
        $this->position = $position;
    }
    public function getType(): PieceType {
        return $this->type;
    }
    public function canMove(Board $board, Position $target): bool {
        
        if($this->position == $target) {
            echo "a";
            return false;
        }
        
        if(!$this->isValidMovementShape($target)) {
            echo $board->getPieceAt($target)->render();
            echo $this->render();
            echo "f";
            return false;
        }

        if($board->hasPieceAt($target) && $board->getPieceAt($target)->getColor() === $this->getColor()) {
            echo new OccupiedByAllyException($this,$board->getPieceAt($target));
            return false;
        }
        
        if($board->hasPieceAt($target) && !$this->canCapture($board,$target)) {
            echo "t";
            return false;
        }

        if(!$board->isPathClear($this->getPosition(),$target) && $this->getType() != PieceType::KNIGHT) {
            echo "r";
            return false;
        }


        return true;
    }
    protected function canCapture(Board $board, Position $target): bool {
        
        if($board->hasPieceAt($target) && $board->getPieceAt($target)->getColor() !== $this->getColor()) {
            return true; 
        }
        return false;
    }
    abstract protected function isValidMovementShape(Position $target) : bool;
}