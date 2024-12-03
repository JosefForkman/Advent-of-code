import { readFileSync } from "fs";

const file = readFileSync("input1.txt", { encoding: "utf8" });

// console.log(file);

const matches = file.match(/mul\(\d+,\d+\)/g);
console.log(matches);

const formets = matches.map(matche => {

    const result = matche.match(/\((.*),(.*)\)/)
    // console.log(result[1]);
    return {
        first: result[1],
        second: result[2],
    }
})

const sulusion = formets.reduce((previousValue, currentValue) => previousValue += (currentValue.first * currentValue.second) ,0)

console.log(sulusion);
