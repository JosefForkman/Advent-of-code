import { readFileSync } from "fs";

const file = readFileSync("example1.txt", { encoding: "utf8" }).split(
    "\r\n\r\n",
);

const roles = file[0]
    .split("\r\n")
    .map((val) => val.split("|"))
    .map((val) => {
        return { x: val[0], y: val[1] };
    });
const newPages = file[1].split("\r\n").map((val) => val.split(","));
const solosion = evaluatePageRoles(newPages, roles);

const gropeSolosion = Object.values(Object.groupBy(solosion, ({ row }) => row));

console.log(newPages);

const correctRows = [];
for (let i = 0; i < gropeSolosion.length; i++) {
    const grop = gropeSolosion[i];
    correctRows.push(grop.every((v) => v.correct));
}

console.log(CountRows(correctRows, newPages));

function CountRows(correctRows, newPages) {
    let count = 0;
    for (let i = 0; i < correctRows.length; i++) {
        const value = correctRows[i];
        const index = newPages[i];
        if (value) {
            count += Number(index[(index.length - 1) / 2]);
        }
    }
    return count;
}

function evaluatePageRoles(newPages, roles) {
    const solosion = [];
    for (let row = 0; row < roles.length; row++) {
        const role = roles[row];

        newPages.forEach((page, i) => {
            const a = page.findIndex((pg) => pg == role.y);
            const b = page.findIndex((pg) => pg == role.x);
            if (a != -1 && b != -1) {
                const correct = a > b;
                solosion.push({ row: i, correct });
            }
        });
    }

    return solosion;
}

const t = [];

for (let row = 0; row < roles.length; row++) {
    const role = roles[row];
    newPages.forEach((page, i) => {
        const a = page.findIndex((pg) => pg == role.y);
        const b = page.findIndex((pg) => pg == role.x);
        if (a != -1 && b != -1) {
            const correct = a > b;
            console.log({a, b, correct});
            if (correct) {
                
            }
            t.push({ row: i });
        }
    });
}
// console.log(t);
