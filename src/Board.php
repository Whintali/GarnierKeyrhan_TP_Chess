<?php
namespace ChessGame;
use ChessGame\Contract\Renderable;
use ChessGame\Enum\PieceColor;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Exception\NoPieceException;
use ChessGame\Exception\InvalidMoveException;

class Board implements Renderable {
    private array $pieces = [];
    // Permet de placer la pière AU DEBUT du jeu
    public function placePiece(Piece $piece): void {
        $this->pieces[$piece->getPosition()->toKey()] = $piece;
    }
    public function getPieceAt(Position $position): ?Piece {
        $pieceToReturn = $this->pieces[$position->toKey()];
        if($pieceToReturn === null){
            throw new NoPieceException($position);
        }
        return $pieceToReturn;
    }

    public function hasPieceAt(Position $position): bool {
        $pieceToReturn = $this->pieces[$position->toKey()] ?? null;
        if($pieceToReturn === null){
            return false;
        }
        return true;
    }
    public function removePieceAt(Position $position): void {
        $pieceToRemove = $this->pieces[$position->toKey()];
        if($pieceToRemove === null){
            throw new NoPieceException($position);
        }
        unset($this->pieces[$position->toKey()]);
    }
    // permet de déplacer les pièces PENDANT le jeu
    public function movePiece(Position $from, Position $to): void {
        /**  @var ?Piece **/
        $pieceToMove = $this->pieces[$from->toKey()] ?? null;
        if($pieceToMove === null){
            throw new NoPieceException($from);
        }
        if($pieceToMove->canMove($this,$to)) {
            $pieceToMove->setPosition($to);
            $this->pieces[$from->toKey()] = null;
            $this->pieces[$to->toKey()] = $pieceToMove;
        }
        else {
            throw new InvalidMoveException($from,$to);
        }
    }
    public function isPathClear(Position $from, Position $to): bool {
        $positionColumn = 0;
        $positionRow = 0;
        // TODO à tester
        if($from->getColumn() != $to->getColumn() && $from->getRow() != $to->getRow()) {
            // cas où trajet diagonale
            for($i=1; $i <= 7;$i++) {
                if(($to->getColumn() - $from->getColumn()) < 0 ) {
                    $positionColumn = $from->getColumn() - $i;
                }
                else {
                    $positionColumn = $from->getColumn() + $i;
                }
                if($positionColumn < -7 || $positionColumn > 7) break;
                if(($to->getRow() - $from->getRow()) < 0 ) {
                    $positionRow = $from->getRow() - $i;
                }
                else {
                    $positionRow = $from->getRow() + $i;
                }
                if($positionRow < 0 || $positionRow > 7) break;
                /** @var Position **/
                $positionTemp = new Position($positionRow,$positionColumn);
                if($positionTemp->equals($to)) break;
                if($this->hasPieceAt($positionTemp)) {
                    return false;
                }
            }
        }
        if($from->getColumn() != $to->getColumn() && $from->getRow() === $to->getRow()) {
            // cas où déplacement en colonne
            for($i=1; $i<=7; $i++) {
                if(($to->getColumn() - $from->getColumn()) < 0 ) {
                    $positionColumn = $from->getColumn() - $i;
                }
                else {
                    $positionColumn = $from->getColumn() + $i;
                }
                if($positionColumn < 0 || $positionColumn > 7) break;
                /** @var Position **/
                $positionTemp = new Position($from->getRow(),$positionColumn);
                if($positionTemp->equals($to)) break;
                $pieceTemp = $this->pieces[$positionTemp->toKey()] ?? null;
                if($pieceTemp != null) {
                    return false;
                }
            }
        }
        if($from->getColumn() === $to->getColumn() && $from->getRow() != $to->getRow()) {
            // cas où déplacement en ligne
            for($i=1; $i<=7; $i++) {
                if(($to->getRow() - $from->getRow()) < 0 ) {
                    $positionRow = $from->getRow() - $i;
                }
                else {
                    $positionRow = $from->getRow() + $i;
                }
                if($positionRow < 0 || $positionRow > 7) break;
                /** @var Position **/
                $positionTemp = new Position($positionRow,$from->getColumn());
                if($positionTemp->equals($to)) break;
                $pieceTemp = $this->pieces[$positionTemp->toKey()] ?? null;
                if($pieceTemp != null) {
                    return false;
                }
            }
        }
        return true;
    }
    public function getPieces(): array {
        return $this->pieces;
    }
    public function getKingPosition(PieceColor $color): ?Position {
        return null;
    }
    public function render(): string {
        $boardTab = "";
        for($i=0;$i<=7;$i++){
            for($j=0;$j<=7;$j++) {
                $position = new Position($i,$j);
                $pieceToRender = $this->pieces[$position->toKey()] ?? null;
                if($pieceToRender != null){
                    $boardTab = $boardTab . $pieceToRender->render();
                }
                else {
                    $boardTab = $boardTab . "*";
                }
            }
            if($i != 7){
                $boardTab = $boardTab . "\n";
            }
        }
        return $boardTab;
    }
}