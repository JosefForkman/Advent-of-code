import { Direction, posision } from "./types.js";

function FindPlayerPosition(file: string[][]) {
    let pos = {
        x: 0,
        y: 0,
    };
    file.forEach((map, rowIndex) => {
        const colIndex = map.findIndex((col) => col == "^");

        if (colIndex != -1) {
            pos.x = colIndex;
            pos.y = rowIndex;
            return;
        }
    });
    return pos;
}
function FindObstructionPosition(playerPosition: posision, file: string[][]) {
    const obstructions: posision[] = [];
    file.forEach((row, rowIndex) => {
        if (rowIndex == playerPosition.y) {
            row.forEach((col, colIndex) => {
                if (col == "#") {
                    obstructions.push({
                        x: colIndex,
                        y: rowIndex,
                    });
                }
            });
        }
        row.forEach((col, colIndex) => {
            if (colIndex == playerPosition.x) {
                if (col == "#") {
                    obstructions.push({
                        x: colIndex,
                        y: rowIndex,
                    });
                }
            }
        });
    });
    return obstructions;
}

function Move(
    obstructions: posision[],
    playerPosition: posision,
    direction: Direction,
) {
    if (direction == Direction.Up) {
        return obstructions
            .filter(
                (obstruction) =>
                    obstruction.y <= playerPosition.y &&
                    playerPosition.x == obstruction.x,
            )
            .sort((a, b) => b.y - a.y)
            [0];
    }
    if (direction == Direction.Down) {
        return obstructions
            .filter(
                (obstruction) =>
                    obstruction.y >= playerPosition.y &&
                    playerPosition.x == obstruction.x,
            )
            .sort((a, b) => b.y - a.y)
            [0];
    }
    if (direction == Direction.Right) {
        return obstructions
            .filter(
                (obstruction) =>
                    obstruction.x >= playerPosition.x &&
                    playerPosition.y == obstruction.y,
            )
            .sort((a, b) => a.x - b.x)
            [0];
    }
    if (direction == Direction.Left) {
        return obstructions
            .filter(
                (obstruction) =>
                    obstruction.x <= playerPosition.x &&
                    playerPosition.y == obstruction.y,
            )
            .sort((a, b) => b.y - a.y)
            [0];
    }
}

function Distant(dist: Set<posision>, direction: Direction,from: posision, to?: posision) {
    if (!to) {
        return;
    }
    if (direction == Direction.Up) {
        for (let i = from.y; i <= to.y; i++) {
            dist.add({ x: from.x, y: i });
        }
    }
    if (direction == Direction.Down) {
        for (let i = from.y; i >= to.y; i--) {
            dist.add({ x: from.x, y: i });
        }
    }

    if (direction == Direction.Left) {
        for (let i = from.x; i >= to.x; i--) {
            dist.add({ x: i, y: from.y });
        }
    }
    if (direction == Direction.Right) {
        for (let i = from.x; i <= to.x; i++) {
            dist.add({ x: i, y: from.y });
        }
    }
}

function SetPlayerPosision(
    direction: Direction,
    Player: posision,
    To?: posision,
) {
    if (!To) {
        return Player;
    }
    if (direction == Direction.Up) {
        return {
            y: To.y + 1,
            x: Player.x,
        };
    }
    if (direction == Direction.Down) {
        return {
            y: To.y - 1,
            x: Player.x,
        };
    }
    if (direction == Direction.Right) {
        return {
            y: Player.y,
            x: To.x - 1,
        };
    }
    if (direction == Direction.Left) {
        return {
            y: Player.y,
            x: To.x + 1,
        };
    }
    return Player;
}

export {
    FindPlayerPosition,
    FindObstructionPosition,
    Move,
    Distant,
    SetPlayerPosision,
};
