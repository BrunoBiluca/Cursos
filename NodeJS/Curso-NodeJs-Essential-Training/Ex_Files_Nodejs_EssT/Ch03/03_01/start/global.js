// Console log está no namespace global
console.log("Hello World!");

// Cada variável em Javascript é associada ao objeto do módulo atual
var hello = "Hello World from Node JS";

console.log(global.hello); // Não funciona
console.log(hello); // Funciona, variável está no objeto do módulo atual

var justNode = hello.slice(17);
console.log(`Rock on World from ${justNode}`);

// Módulos globais
console.log(__dirname);
console.log(__filename);
var path = require("path");
console.log(`Rock on World from ${path.basename(__filename)}`);