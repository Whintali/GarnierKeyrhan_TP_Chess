<?php

namespace ChessGame;

use ChessGame\Board;
use ChessGame\Factory\PieceFactory;
use ChessGame\Enum\PieceColor;
use ChessGame\Enum\PieceType;
use ChessGame\Exception\InvalidMoveException;
use ChessGame\Piece\Piece;
use ChessGame\Position;
use ChessGame\Move;
use ChessGame\Exception\NoPieceException;
use ChessGame\Exception\WrongTurnException;

class Game {
    private Board $board;
    private PieceColor $currentPlayer;
    private PieceFactory $pieceFactory;

    public function __construct() {
        $this->pieceFactory = new PieceFactory();
    }
    public function start(): void {
        self::__construct();
        $this->board = new Board();
        $this->currentPlayer = PieceColor::WHITE;
        $this->setupPieces();
    }
    public function getBoard(): Board {
        return $this->board;
    }
    public function getCurrentPlayer(): PieceColor {
        return $this->currentPlayer;
    }
    public function play(Move $move): void {
        /** @var ?Piece */
        $pieceSource = $this->board->getPieceAt($move->getFrom()) ?? null;
        if($pieceSource != null) {
            if($pieceSource->getColor() === $this->currentPlayer){
                // Pas besoin de vérifier si ça peut se déplacer déjà fait dans movePiece mais sinon il faudrait :
                if ($pieceSource->canMove($this->board,$move->getTo())) {
                    $this->board->movePiece($move->getFrom(),$move->getTo());
                    $this->switchPlayer();
                }
                else {
                     throw new InvalidMoveException($move->getFrom(),$move->getTo());
                }
                     
            }
            else {
                throw new WrongTurnException($pieceSource);
            }
        }
        else {
            throw new NoPieceException($move->getFrom());
        }
    }
    public function isCheck(PieceColor $color): bool {
        return false;
    }
    private function setupPieces(): void {
        $tabOrder = [PieceType::ROOK,PieceType::KNIGHT,PieceType::BISHOP,PieceType::QUEEN,PieceType::KING,PieceType::BISHOP,PieceType::KNIGHT,PieceType::ROOK];
        $actualColor = PieceColor::WHITE;
        $actualRow = 7;
        $notFinished = true;
        $didPawnPlaced = false;
        while($notFinished) {
            for($j=0; $j< count($tabOrder); $j++){
                $positionTemp = new Position($actualRow,$j);   
                $pieceTemp = null;
                if($actualRow === 6 || $actualRow === 1){
                    $pieceTemp = $this->pieceFactory->create(PieceType::PAWN,$actualColor,$positionTemp);
                }
                else {
                    $pieceTemp = $this->pieceFactory->create($tabOrder[$j],$actualColor,$positionTemp);
                }
                if($pieceTemp != null){
                    $this->board->placePiece($pieceTemp);
                }
                if($j===7 && $actualColor === PieceColor::WHITE) {
                    echo "WHITE at row $actualRow\n";
                    if($didPawnPlaced){
                        $actualColor = PieceColor::BLACK;
                        $actualRow= 0;
                        $didPawnPlaced = false;
                    }
                    else {
                        $actualRow= 6;
                        $didPawnPlaced= true;
                    }
                }
                else {
                    if($j===7) {
                        if(!$didPawnPlaced) {
                            $didPawnPlaced = true; 
                            $actualRow = 1;
                        }
                        else {
                            $notFinished = false;
                            break;
                        }
                    }
                }
            }
        }
    }
    private function switchPlayer(): void {
        if($this->currentPlayer === PieceColor::BLACK) {
            $this->currentPlayer = PieceColor::WHITE;
        }
        else {
            $this->currentPlayer = PieceColor::BLACK;
        }
    }
}