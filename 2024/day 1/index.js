import { readFileSync } from "fs";

const file = readFileSync("input2.txt", { encoding: "utf8" });
const fileArray = file.split("\r\n");

const lefts = [];
const rights = [];

fileArray.forEach((value) => {
    const splitValue = value.split("   ");
    lefts.push(splitValue.at(0));
    rights.push(splitValue.at(1));
});
lefts.sort();
rights.sort();

const dist = [];
for (let i = 0; i < lefts.length; i++) {
    const left = Number(lefts[i]);
    const right = Number(rights[i]);

    dist.push(Math.abs(right - left));
}

const similarity = [];
lefts.forEach((left) => {
    let count = rights.filter((right) => right == left).length;
    similarity.push(Number(left) * count);
});

console.log(similarity);

// const solushion = dist.reduce(
//     (previousValue, currentValue) => previousValue + currentValue,
//     0,
// );
const solushion = similarity.reduce((previousValue, currentValue) => {
    return previousValue + currentValue;
}, 0);

console.log(solushion);
