<?php
namespace ChessGame;
use Exception;
class Position {
    private int $row; // compris entre 0 et 7
    private int $column; // compris entre 0 et 7

    public function __construct(int $row, int $column)
    {
        if($column > 7 || $column < 0 || $row < 0 || $row > 7){
            throw new Exception("Aie données incorrectes !");
        }
        $this->row = $row;
        $this->column = $column;
    }
    public function getRow(): int 
    {
        return $this->row;
    }
    public function getColumn(): int
    {
        return $this->column;
    }
    public function equals(Position $other): bool {
        return $this == $other;
    }
    public function toKey(): string 
    {
        return $this->row . ":" . $this->column;
    } // Doit retourner une chaîne du type 6:4
    public static function fromKey(string $key): Position 
    {
        $string_array = explode(":",$key);
        if(count($string_array) != 2) {
            throw new Exception("Erreur key incorrect, doit contenir au moins deux valeurs");
        }
        return new Position((int) $string_array[0], (int) $string_array[1]);
    }
}