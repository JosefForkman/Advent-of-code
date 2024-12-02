import { readFileSync } from "fs";

const file = readFileSync("example1.txt", { encoding: "utf8" });
const fileArray = file
    .split("\r\n")
    .map((file) => file.split(" ").map((file) => Number(file)));

const status = [];
for (let i = 0; i < fileArray.length; i++) {
    const levels = fileArray[i];
    const first = levels.at(0);
    const last = levels.at(-1);

    const isIncreasing = first <= last;

    const row = [];
    for (let j = 0; j < levels.length; j++) {
        if (j != 0) {
            const currentLevel = levels[j];
            const beforeLevel = levels[j - 1];

            if (isIncreasing) {
                const value = currentLevel - beforeLevel;
                row.push(value >= 1 && value <= 3);
            } else {
                const value = beforeLevel - currentLevel;
                row.push(value >= 1 && value <= 3);
            }
        }
    }
    status.push(row);
}

const sulusions = [];
status.forEach((level) => sulusions.push(level.every((lev) => lev)));

const sulusion = sulusions.reduce(
    (previousValue, currentValue) =>
        currentValue ? previousValue + 1 : previousValue,
    0,
);

console.log(sulusion);