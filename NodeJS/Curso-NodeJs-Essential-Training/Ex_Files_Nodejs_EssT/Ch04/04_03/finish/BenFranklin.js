var EventEmitter = require('events').EventEmitter;
var util = require('util');

var Person = function(name) {
	this.name = name;
};

util.inherits(Person, EventEmitter);

var ben = new Person("Ben Franklin");

ben.on('speak', function(said) {

	console.log(`${this.name}: ${said}`);

});


ben.emit('speak', "You may delay, but time will not.");
