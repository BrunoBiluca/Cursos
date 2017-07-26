const fs = require('fs');

// Método síncrono
// let content;
// try {  
//   content = fs.readFileSync('file.md', 'utf-8');
// } catch (ex) {
//   console.log(ex);
// }
// console.log(content);

// Método assíncrono
console.log('start reading a file...')
fs.readFile('file.md', 'utf-8', function(err, content){
    if(err){
        console.log('error happened during reading the file')
        return console.log(err);
    }

    console.log(content);
});
console.log('end of the file')  