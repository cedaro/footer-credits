/*jshint node:true */

module.exports = function( grunt ) {
	'use strict';

	grunt.loadNpmTasks( 'grunt-wp-i18n' );

	grunt.initConfig({

		makepot: {
			plugin: {
				options: {
					mainFile: 'footer-credits.php',
					potHeaders: {
						poedit: true
					},
					type: 'wp-plugin',
					updatePoFiles: true,
					updateTimestamp: false
				}
			}
		}

	});

};
