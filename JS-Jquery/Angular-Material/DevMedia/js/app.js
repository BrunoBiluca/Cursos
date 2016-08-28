angular.module("myApp", ['ngMaterial'])
		.config(function($mdThemingProvider){
			$mdThemingProvider.theme('default')
			.primaryPalette('blue', {
				'default': '400',
				'hue-1' : '100',
				'hue-2' : '600',
				'hue-3' : 'A100',
			})
			.accentPalette('orange')
			.warnPalette('yellow')
			.backgroundPaltette('grey')
		})