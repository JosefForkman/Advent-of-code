const fs = require("node:fs");

const pusselOne = (path) => {
    const file = fs.readFileSync(path, "utf8");
    const lines = file
        .split("\r\n")
        .map((line) => {
            return line
                .split("")
                .reduce((previousValue, currentValue) => {
                    if (Number.parseInt(currentValue)) {
                        return (previousValue += currentValue);
                    }
                    return previousValue;
                }, "")
                .split("");
        })
        .map((val) => {
            if (val.length == 1) {
                return val + val;
            } else {
                return val[0] + val[val.length - 1];
            }
        })
        .reduce((previousValue, currentValue) => {
            return (previousValue += Number.parseInt(currentValue));
        }, 0);

    console.log(lines);
};

// pusselOne("./example1.txt");
// pusselOne("./input1.txt");

const pusselTwo = (path) => {
    const file = fs.readFileSync(path, "utf8");

    const lines = file.split("\r\n");

    // const output = lines
    //     .map((val) => {
    //         const pattern =
    //             /(one|two|three|four|five|six|seven|eight|nine|teen)/g;
    //         return val.split(pattern);
    //     })
    //     .map((val) => val.filter((val) => val != ""))
    //     .map((val) => {
    //         return val.map((val) => {
    //             const matchValue = val.match(/\d/g);
    //             if (matchValue) {
    //                 return matchValue;
    //             }
    //             return parceNumber(val);
    //         });
    //     })
    //     .map((val) => val.filter((valInt) => Number.parseInt(valInt)));
    const output = lines
        .map((val) => {
            const pattern =
                /(one|two|three|four|five|six|seven|eight|nine|teen)/g;
            return val.split(pattern);
        })
        .map((line) => line.filter((val) => val != ""))
        .map((line) => {
            return line.flatMap((item) => {
                const matchValue = item.match(/\d/g);
                // console.log(item);
                if (matchValue) {
                    return matchValue;
                }
                return parceNumber(item);
            });
        });

    console.log(output);

    const t = output
        .map((val) => {
            val = val.filter(item => Number.parseInt(item));
            if (val.length == 1) {
                return val + val;
            } else {
                return val[0] + val[val.length - 1];
            }
        })
        .reduce((previousValue, currentValue) => {
            // console.log(Number.parseInt(currentValue));
            return (previousValue += Number.parseInt(currentValue));
        }, 0);

    console.log(t);
};

pusselTwo("./input2.txt");
// pusselTwo("./input2.txt");
function parceNumber(word) {
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
        // case "teen":
        //     return "10";
        default:
            return word;
    }
}
