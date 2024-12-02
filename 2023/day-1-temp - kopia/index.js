const fs = require("node:fs");

function GetData(path) {
    return fs.readFileSync(path, {encoding: "utf-8"} ).split("\r\n")
}

const fileDatas = GetData("input2.txt")

const sertch = ["one","two","three","four","five","six","seven","eight","nine"]

const reg = /(one|two|three|four|five|six|seven|eight|nine|ten|\d+)/g

const numbers = fileDatas.map(data => data.match(reg))


// const numbers = fileDatas.map(data => data.split('')).map(num => num.filter(number => Number(number)))

let results = []
for (let j = 0; j < numbers.length; j++) {
    const row = []
    for (let i = 0; i < numbers[j].length; i++) {
        const number = numbers[j][i];
        
        if(Number(number)) {
            let numbers = number.split('')
            row.push(Number(numbers.at(-1)))
        } else {
            const index = sertch.findIndex((num) => num == number)

            row.push(index + 1)
        }
    }
    results.push(row)
}

let finish = []
results.forEach(number => {
    const firstNumber = number.at(0)
    let lastNumber = number.at(number.length - 1)
    
    if (!lastNumber) {
        lastNumber = firstNumber
    }
    
    finish.push(`${firstNumber}${lastNumber}`)
})
finish = finish.map(val => Number(val))
finish = finish.reduce((previousValue, currentValue) => previousValue + currentValue, 0)
console.log(finish);

// results = results.map(val => Number(val))

// const result = results.reduce((previousValue, currentValue) => {
//     return previousValue + currentValue
// }, 0)

// console.log(fileDatas);