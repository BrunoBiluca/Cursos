module.exports = function(grunt) {

	grunt.initConfig({
		jshint: {
			files: ["*.js", "lib/*.js", "test/*.js"],
			options: {
				esnext: true,
				globals: {
					jQuery: true
				}
			}
		}
	});

	grunt.loadNpmTasks("grunt-contrib-jshint");

	grunt.registerTask("default", ["jshint"]);
};