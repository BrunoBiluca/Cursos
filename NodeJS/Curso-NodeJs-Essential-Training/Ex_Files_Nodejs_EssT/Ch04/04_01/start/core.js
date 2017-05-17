// Path e util modules são módulos que já vem instalados com o Node JS
var path = require('path');

// Module util
var util = require('util');

// O módulo V8 podemos pegar informação sobre a plataforma de execução
// Node roda em cima da máquina virtual V8 do Google
var v8 = require('v8');

util.log(path.basename(__filename));

var dirUploads = path.join(__dirname, 'www', 'files', 'uploads');

util.log(dirUploads);

// Informações de memória
util.log(v8.getHeapStatistics());