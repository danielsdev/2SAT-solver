console.log(process.argv);

const myArgs = process.argv.slice(2);
console.log('myArgs: ', myArgs);

process.stdin.on('data', data => {
    console.log(data.toString());
    process.exit();
});