import { readFileSync } from "fs";

const file = readFileSync("example1.txt", { encoding: "utf8" }).split("\r\n");

// let count = 0;

function findWord(value) {
    const SAMX = value.match(/(SAMX)/g) ?? [];
    const XMAS = value.match(/(XMAS)/g) ?? [];

    return SAMX.concat(XMAS);
}

// Right to Left and Left to Right
// count += file
//     .map(findWord)
//     .filter((val) => val.length != 0)
//     .flat().length;

const matchs = file.map((val) => val.split(""));

// Virtical
// const virticalFormat = [];
// let currentRwo = 0;
// for (let col = 0; col < file.length; col++) {
//     for (let row = 0; row < matchs.length; row++) {
//         const element = matchs[row][col];

//         virticalFormat.push(element);
//     }
// }

// let Diginal = [];

// Bottom Right diginal
// for (let i = matchs[0].length; i >= 0; i--) {
//     let colIndex = matchs[0].length;

//     for (let row = i; row < matchs.length; row++) {
//         if (colIndex == i) {
//             colIndex = matchs[row].length;
//         } else {
//             colIndex--;
//         }
//         const match = matchs[row][colIndex];
//         // console.log({row, colIndex});

//         Diginal.push(match);
//     }
// }

// top left

const d = [];
for (let row = 0; row < matchs.length; row++) {
    for (let col = 0; col < matchs[row].length; col++) {
        
        for (let i = -3; i < 4; i++) {
            for (let j = -3; j < 4; j++) {
                // console.log(i, j);
                const yPos = row - i;
                const xPos = col - j;

                if (
                    yPos > 0 &&
                    yPos < matchs.length &&
                    xPos > 0 &&
                    xPos < matchs[row].length
                ) {

                    const match = matchs[yPos][xPos];
                    d.push(match);
                }
            }
        }
    }
}

console.log(findWord(d.join("")).length);

// count += findWord(virticalFormat.join("")).length;
// count += findWord(Diginal.join("")).length;
// negativDiagonal = negativDiagonal.filter((val) => val).join("");
// count += findWord(negativDiagonal).length;
// console.log(negativDiagonal);

// console.log(count);
