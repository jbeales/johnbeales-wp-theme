module.exports = function(grunt) {

	var projectName = grunt.option('project-name'),
		hostSafeProjectName,
		funcSafeProjectName;

	if( projectName && projectName.length > 0 ) {
		hostSafeProjectName = projectName.replace( /\s/g, '-' ),
		funcSafeProjectName = hostSafeProjectName.replace( '-', '_' );
	}


	// Project configuration.
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				banner: '/*! <%= pkg.name %> <%= grunt.template.today("yyyy-mm-dd") %> */\n',
				sourceMap: true,
				preserveComments: 'some'
			},
			dist: {
				files: [{
					expand: true,
					cwd: 'js/src',
					src: '*.js',
					dest: 'js',
					ext: '.js',
					extDot: 'last'
				}]
			}
		},

		sass: {
			
			options: {
				style: 'expanded',	// use compressed for production, expanded for debug /// for ruby sass
				precision: 8
			},

			dist: {	
				src: 'sass/style.scss',
				dest: 'style.css'		
			}
		},

		postcss: {
            options: {
                map: {
		            inline: false, // save all sourcemaps as separate files...
		            annotation: 'maps/css' // ...to the specified directory
		        },
                processors: [
                    require('autoprefixer')({
			          browsers: ['last 2 versions']
			        }),
			        require('cssnano')() // minify the result
                ]
            },
            dist: {
                src: 'style.css'
            }
        },

        replace: {
		    setupMain: {
			    options: {
				    patterns: [
				    	{
				    		match: '\'_jb\'',
				    		replacement: '\'' + hostSafeProjectName + '\''
				    	},
				    	{
				    		match: '_jb_',
				    		replacement: funcSafeProjectName + '_'
				    	},

				    	{
				    		match: 'Text Domain: _jb',
				    		replacement: 'Text Domain: ' + hostSafeProjectName + ''
				    	},

				    	{
				    		match: ' _jb',
				    		replacement: ' ' + funcSafeProjectName + ''
				    	},

				    	{
				    		match: '_jb-',
				    		replacement: hostSafeProjectName + '-'
				    	},


				    ],
				    usePrefix: false
			    },
			    files: [
			    	{
			    		expand: true, 
			    		// './**/*.sass', './**/*.css', './**/*.php', './**/*.txt', './**/*.md', './**/*.pot',
			    		//src: ['**/*.js', '**/*.css', '**/*.scss', '**/*.php', '**/*.txt', '**/*.md', '**/*.pot', '**/*.map', '!node_modules/**' ], 
			    		src: ['**/*', '!node_modules/**', '!Gruntfile.js', '!**/*.png', '!**/*.jpg', '!**/*.gif' ],
			    		dest: '.'
			    	}
			    ]
		    },

		    // Replace the hostname in the Browsersync config in gruntfile.
		    setupGruntFile: {
		    	options: {
				    patterns: [
				    	{
				    		match: /"_jb\.dev"/,
				    		replacement: '"' + hostSafeProjectName + '.dev"'
				    	},
				    ],
				    usePrefix: false
				},

				 files: [
			    	{
			    		src: 'Gruntfile.js',
			    		dest: 'Gruntfile.js'
			    	}
			    ]
		    }
	    },

	    rename: {
	        setupPotfile: {
	            src: 'languages/_jb.pot',
	            dest: 'languages/' + hostSafeProjectName + '.pot'
	        },
	    },

		watch: {
			scripts: {
				files: ['js/src/*.js'],
				tasks: [
					'newer:uglify'
				],
				options: {
					spawn: false,
				},
			},
			css: {
				files: ['sass/**/*.scss'],
				tasks: [
					'sass',
					'postcss'
				],
				options: {
					spawn: false,
				},
			}  
		},


		newer: {
			options: {
				override: function(details, include) {
	                if (details.task.indexOf('sass') == 0) {
	                  checkForNewerImports(details.path, details.time, include);
	                } else {
	                  include(false);
	                }
	            }
			}
		},

		browserSync: {
            dev: {
                bsFiles: {
                    src : [
                    	'style.css',
                    	'**/*.php',
                    	'img/*',
                    	'js/*.js'
                    ]
                },
                options: {
                    watchTask: true,
 					proxy: "_jb.dev" // e.g., localhost.dev, wordpress.dev
                }
            }
        }
	});

	// Load plugins
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-sass');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-newer');
	grunt.loadNpmTasks('grunt-browser-sync');
	grunt.loadNpmTasks('grunt-postcss');
	grunt.loadNpmTasks('grunt-replace');
	grunt.loadNpmTasks('grunt-rename');

	// Default task(s).
	grunt.registerTask('default', [ 'browserSync', 'watch'] );
	grunt.registerTask('css', [ 'sass', 'postcss'] );
	grunt.registerTask('setup-project', ['replace', 'rename:setupPotfile' ] );



	var fs = require('fs');
	var path = require('path');
	 
	function checkForNewerImports(lessFile, mTime, include) {
	    fs.readFile(lessFile, "utf8", function(err, data) {
	        var lessDir = path.dirname(lessFile),
	            regex = /@import ["'](.+?)(\.scss)?["'];/g,
	            shouldInclude = false,                
	            match;

	           console.log('lessfile: ' + lessFile);
	 
	        while ((match = regex.exec(data)) !== null) {
	        	// All of my less files are in the same directory,
	            // other paths may need to be traversed for different setups...
	            var importFile = lessDir + '/' + match[1] + '.scss';
	            if (fs.existsSync(importFile)) {
	                var stat = fs.statSync(importFile);
	                if (stat.mtime > mTime) {
	                    shouldInclude = true;
	                    break;
	                }
	            }
	        }
	        include(shouldInclude);
	    });
	}
};

