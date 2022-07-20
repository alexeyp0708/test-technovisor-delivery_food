<?php
	return [
		'Development' => [
			'food/runtime',
+           'food/web/assets',	
		],
		'setCookieValidationKey' => [
			'food/config/main-local.php',
		],
		'Production'=>[
			'setWritable' => [
				'food/runtime',
+           	'food/web/assets',
			]
		]
		'setCookieValidationKey' => [
			'food/config/main-local.php'
		]
	];