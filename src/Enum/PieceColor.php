<?php
namespace ChessGame\Enum;
enum PieceColor {
    case WHITE;
    case BLACK;

    public function opposite() : PieceColor {
        if($this::BLACK) return self::WHITE;
        if($this::WHITE) return self::BLACK;
        throw new Exception("Couleur incorrect");
    }
}
