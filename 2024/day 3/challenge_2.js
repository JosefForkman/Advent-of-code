import { readFileSync } from "fs";

let file = readFileSync("input1.txt", { encoding: "utf8" });
file = `do()${file}`;
const matches = file.match(/do\((.*?)don't\(\)/g) ?? [];

const formets = matches.map((matche) => {
    const result = matche.match(/mul\(\d+,\d+\)/g);

    return result;
});

const t = formets
    .map((matche) => {
        const results = [...matche.map((ma) => ma.match(/\((.*),(.*)\)/))].map(
            (result) => [Number(result[1]), Number(result[2])],
        );
        // console.log(results);

        return results;
    })
    .flat();
console.log(t.filter((f) => f.length != 2));

const sulusion = t.reduce(
    (previousValue, currentValue) =>
        previousValue += currentValue[0] * currentValue[1],
    0,
);

console.log(sulusion);
