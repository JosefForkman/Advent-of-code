import { readFileSync } from "fs";
import {
    Distant,
    FindObstructionPosition,
    FindPlayerPosition,
    Move,
    SetPlayerPosision,
} from "./helpers.js";
import { Direction, posision } from "./types.js";
console.clear();

const file = readFileSync("example.txt", { encoding: "utf8" })
    .split("\r\n")
    .map((val) => val.split(""));

let playerPosition = FindPlayerPosition(file);

let dist = new Set<posision>();
let directionIndex = Direction.Up;
let next: posision | undefined;
let obstructionPosition: posision[] = [];

directionIndex = Direction.Up;
console.log("\n");

console.log(Direction[directionIndex]);

console.log("playerPosition", playerPosition);
obstructionPosition = FindObstructionPosition(playerPosition, file);
console.log("obstructionPosition", obstructionPosition);
next = Move(obstructionPosition, playerPosition, directionIndex);
console.log("next", next);
if (next) {
    Distant(dist, directionIndex, next, playerPosition);
}
playerPosition = SetPlayerPosision(directionIndex, playerPosition, next);
console.log("playerPosition", playerPosition);
console.log("dist", dist.size);

while (next) {
    if (directionIndex > Direction.Left) {
        directionIndex = Direction.Up;
    }
    console.log("\n");

    console.log(Direction[directionIndex]);

    console.log("playerPosition", playerPosition);
    obstructionPosition = FindObstructionPosition(playerPosition, file);
    console.log("obstructionPosition", obstructionPosition);
    next = Move(obstructionPosition, playerPosition, directionIndex);
    console.log("next", next);
    if (next) {
        Distant(dist, directionIndex, next, playerPosition);
    }
    playerPosition = SetPlayerPosision(directionIndex, playerPosition, next);
    console.log("playerPosition", playerPosition);

    directionIndex++;
}
console.log("dist", dist.size);
// console.table(dist.entries());
