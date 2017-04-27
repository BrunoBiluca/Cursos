var fs = require("fs");


fs.renameSync("./lib/project-config.js", "./lib/config.json");

console.log("Config json file renamed");

fs.rename("./lib/notes.md", "./notes.md", function(err) {

	if (err) {
		console.log(err);
	} else {
		console.log("Notes.md moved successfully");
	}

});