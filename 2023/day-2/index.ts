import fs from "node:fs";

type PartialRecord<K extends keyof any, T> = {
    [P in K]?: T;
};

const cubs = ["red", "green", "blue"] as const;
type cubeType = (typeof cubs)[number];
type set = PartialRecord<cubeType, number>;

type gameType = {
    name: string;
    sets: set[];
};

const pusselOne = (path: string) => {
    const file = fs.readFileSync(path, "utf8");
    const lines = file.split("\r\n");

    const bag = lines
        .map((line) => {
            const sets = line
                .split(": ")[1]
                .trim()
                .split("; ")
                .map((sets) => checkSets(sets))
                .flat()
                .every((set) => set);

            return sets;
        })
        .reduce(
            (previousValue, currentValue, index) =>
                (previousValue += currentValue ? index + 1 : 0),
            0
        );

    console.log(bag);
};

// pusselOne("./data/example1.txt");
pusselOne("./data/input1.txt");

function checkSets(sets: string) {
    const maxCount: set = { red: 12, green: 13, blue: 14 };

    return sets.split(",").flatMap((val) => {
        const [count, color] = val.trim().split(" ");
        const maxCountSelected = maxCount[color as cubeType];

        if (maxCountSelected) {
            return maxCountSelected >= Number.parseInt(count);
        }
    });
}
