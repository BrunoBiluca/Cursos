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
		},
		less: {
			production: {
				files: {
					"public/css/style.css": ["less/*.less"]
				}
			}
		},
		autoprefixer: {
			single_file: {
				src: "public/css/style.css",
				dest: "public/css/style.css"
			}
		},
		browserify: {
			client: {
				src: ["app-client.js"],
				dest: "public/js/bundle.js"
			}
		}, 
		watch: {
			css: {
				files: ["less/*.less"],
				tasks: ["css"]
			},
			scripts: {
				files: ["app-client.js", "lib/*.js"],
				tasks: ["jshint", "browserify"]
			}
		}
	});

	grunt.loadNpmTasks("grunt-contrib-jshint");
	grunt.loadNpmTasks("grunt-contrib-less");
	grunt.loadNpmTasks("grunt-autoprefixer");
	grunt.loadNpmTasks("grunt-browserify");
	grunt.loadNpmTasks("grunt-contrib-watch");

	grunt.registerTask("css", ["less", "autoprefixer"]);
	grunt.registerTask("js", ["browserify"]);

	grunt.registerTask("default", ["jshint", "css", "js"]);
};