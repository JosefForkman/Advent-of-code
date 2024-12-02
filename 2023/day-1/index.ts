import fs from "node:fs";

// const pusselOne = (path: string) => {
//     const file = fs.readFileSync(path, "utf8");
//     const lines = file
//         .split("\r\n")
//         .map((line) => {
//             return line
//                 .split("")
//                 .reduce((previousValue, currentValue) => {
//                     if (Number.parseInt(currentValue)) {
//                         return (previousValue += currentValue);
//                     }
//                     return previousValue;
//                 }, "")
//                 .split("");
//         })
//         .map((val) => {
//             if (val.length == 1) {
//                 return val[0] + val[0];
//             } else {
//                 return val[0] + val[val.length - 1];
//             }
//         })
//         .reduce((previousValue, currentValue) => {
//             return (previousValue += Number.parseInt(currentValue));
//         }, 0);

//     // console.log(lines);
// };
const pusselOne = (path: string) => {
    const file = fs.readFileSync(path, "utf8");
    const lines = file.split("\r\n");

    const output = lines
        .map((line) => {
            const match = Array.from(line.matchAll(/\d/g));

            const firstMatch = match.at(0)?.[0].toString() ?? "-1";
            const lastMatch =
                match.at(match.length - 1)?.[0].toString() ?? "-1";

            return Number(firstMatch + lastMatch);
        })
        .reduce(
            (previousValue, currentValue) => (previousValue += currentValue)
        );

    console.log(output);
};

// pusselOne("./data/example1.txt");
// pusselOne("./data/input1.txt");

const numberWord = [
    "1",
    "2",
    "3",
    "4",
    "5",
    "6",
    "7",
    "8",
    "9",
    "one",
    "two",
    "three",
    "four",
    "five",
    "six",
    "seven",
    "eight",
    "nine",
] as const;
const numberWordV2 = [
    "\\d",
    "one",
    "two",
    "three",
    "four",
    "five",
    "six",
    "seven",
    "eight",
    "nine",
    "teen",
];

const RegExReverse = new RegExp(numberWordV2.reverse().join("|"), "g");
const RegEx = new RegExp(numberWordV2.join("|"), "g");

// const pusselTwo = (path: string) => {
//     const file = fs.readFileSync(path, "utf-8");

//     const lines = file.split("\n");

//     type lineType = {
//         Index: number;
//         value: number;
//         line: string;
//     };

//     const output = lines
//         .map((line) => {
//             let arrayLine: lineType[] = [];
//             numberWord.forEach((number) => {
//                 const first = line.indexOf(number);
//                 const last = line.lastIndexOf(number);

//                 if (first >= 0) {
//                     arrayLine.push({
//                         Index: first,
//                         value: Number.parseInt(parceNumber(number)),
//                         line,
//                     });
//                 }
//                 if (last >= 0) {
//                     arrayLine.push({
//                         Index: last,
//                         value: Number.parseInt(parceNumber(number)),
//                         line,
//                     });
//                 }
//             });
//             arrayLine = arrayLine.sort((a, b) => (a.Index > b.Index ? 1 : -1));
//             const firstValue = arrayLine.at(0);
//             const lastValue = arrayLine.at(arrayLine.length - 1);
//             if (firstValue && lastValue) {
//                 return Number(
//                     firstValue.value.toString() + lastValue.value.toString()
//                 );
//             }
//             return 0;
//         })
//         .reduce(
//             (previousValue, currentValue) => (previousValue += currentValue),
//             0
//         );

//     console.log(output);
// };
const pusselTwo = (path: string) => {
    const file = fs.readFileSync(path, "utf-8");

    const lines = file.split("\n");

    const output = lines
        .map((line, index) => {
            // const firstNumber = line.split("").find((v) => Number.parseInt(v));
            // const lastNumber = line
            //     .split("")
            //     .reverse()
            //     .find((v) => Number.parseInt(v));

            const match = Array.from(line.matchAll(RegEx));

            const firstNumber = Number.parseInt(
                parceNumber(match.at(0)?.[0] ?? "-1")
            ).toString();
            const lastNumber = Number.parseInt(
                parceNumber(match.at(match.length - 1)?.[0] ?? "-1")
            ).toString();

            return Number(firstNumber + lastNumber);
        })
        .reduce((previousValue, currentValue) => {
            return (previousValue += currentValue);
        }, 0);
    console.log(output);
};

// pusselTwo("./data/example2.txt");
pusselTwo("./data/input2.txt");

function parceNumber(word: string) {
    switch (word) {
        case "one":
            return "1";
        case "two":
            return "2";
        case "three":
            return "3";
        case "four":
            return "4";
        case "five":
            return "5";
        case "six":
            return "6";
        case "seven":
            return "7";
        case "eight":
            return "8";
        case "nine":
            return "9";
        case "teen":
            return "10";
        default:
            return word;
    }
}
