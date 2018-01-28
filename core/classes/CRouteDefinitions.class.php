<?php

class CRouteDefinitions {

	static function getAllRoutes() {

		return [
			'routes'	=> [
				'admin'		=> [
					'controller'	=> 'CAdminController',
					'action'		=> 'index',
					'subActions'	=> [
						'add'		=> 'add',
						'logout'	=> 'doLogout'
					]
				]
			]
		];

	}

}