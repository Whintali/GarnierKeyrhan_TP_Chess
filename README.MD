# TP Chess

## Structure du projet

- **src/** : Code source principal
  - **Board.php** : Gestion du plateau
  - **Game.php** : Orchestration du jeu
  - **Move.php** : Représentation d'un coup
  - **Position.php** : Coordonnées
  - **Piece/** : Classes des pièces
  - **Enum/** : Énumérations (PieceColor, PieceType)
  - **Exception/** : Exceptions personnalisées
  - **Factory/** : Fabrique de pièces
  - **Contract/** : Interfaces

- **vendor/** : Dépendances Composer
- **composer.json** : Configuration Composer
- **composer.lock** : Verrou des dépendances
- **index.php** : Point d'entrée

## Tâches Effectuées

Classes
principales

    ✅ Position
        ✅ __construct()
        ✅ getRow()
        ✅ getColumn()
        ✅ equals()
        ✅ toKey()
        ✅ fromKey()

    ✅ Move
        ✅ __construct()
        ✅ getFrom()
        ✅ getTo()

    ✅ Board
        ✅ placePiece()
        ✅ getPieceAt()
        ✅ hasPieceAt()
        ✅ removePieceAt()
        ✅ movePiece()
        ✅ isPathClear()
        ✅ getPieces()
        ✅ getKingPosition()
        ✅ render()

    ✅ Game
        ✅ __construct()
        ✅ start()
        ✅ getBoard()
        ✅ getCurrentPlayer()
        ✅ play()
        ✅ isCheck()
        ✅ setupPieces()
        ✅ switchPlayer()

Pièces

    ✅ Piece
        ✅ __construct()
        ✅ getColor()
        ✅ getPosition()
        ✅ setPosition()
        ✅ getType()
        ✅ render()
        ✅ canMove()
        ✅ isValidMovementShape()
        ✅ canCapture()

    ✅ King
        ✅ isValidMovementShape()

    ✅ Queen
        ✅ isValidMovementShape()

    ✅ Rook
        ✅ isValidMovementShape()

    ✅ Bishop
        ✅ isValidMovementShape()

    ✅ Knight
        ✅ isValidMovementShape()

    ✅ Pawn
        ✅ isValidMovementShape()

Factory

    ✅ PieceFactory
        ✅ create()

Interface / Enums

    ✅ Renderable
        ✅ render()

    ✅ PieceColor
        ✅ WHITE
        ✅ BLACK
        ✅ opposite()

    ✅ PieceType
        ✅ KING
        ✅ QUEEN
        ✅ ROOK
        ✅ BISHOP
        ✅ KNIGHT
        ✅ PAWN

Exceptions

    ✅ ChessException
    ✅ InvalidMoveException
    ✅ NoPieceException
    ✅ WrongTurnException
    ✅ OccupiedByAllyException

Bonus

    ❌ Roque
    ❌ Promotion du pion
    ❌ Prise en passant
    ❌ Interdiction de mettre son propre roi en échec
    ❌ Échec et mat
    ❌ Pat
    ❌ Historique complet des coups