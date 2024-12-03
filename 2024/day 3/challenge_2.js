import { readFileSync } from "fs";

let file = readFileSync("input1.txt", { encoding: "utf8" });
const matchs = file.match(/mul\(\d+,\d+\)|do\(\)|don't\(\)/g);

const values = [];
let runing = true;
matchs.forEach((match) => {
    if (match == "don't()") {
        runing = false;
    } else if (match == "do()") {
        runing = true;
    }

    if (runing && match != "do()") {
        values.push(match);
    }
});

const sulusion = values.map((val) => val.match(/\d+/g)).reduce(
    (previousValue, currentValue) =>
        (previousValue += currentValue[0] * currentValue[1]),
    0,
);

console.log(sulusion);

// console.log(values.map((val) => val.match(/\d+/g)));
