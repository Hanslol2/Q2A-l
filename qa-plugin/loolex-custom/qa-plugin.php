<?php
/*
	Question2Answer by Gideon Greenspan and contributors
	http://www.question2answer.org/

	File: qa-plugin/example-page/qa-plugin.php
	Description: Initiates example page plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

/*
	Plugin Name: Loolex Custom
	Plugin URI:
	Plugin Description: Loolex Custom
	Plugin Version: 0.1
	Plugin Date: 2018-07-12
	Plugin Author: Philipp
	Plugin Author URI: http://www.loolex.de/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


//qa_register_plugin_module('layer', 'loolex-layer.php', 'q2a test loolex', 'q2a test loolex');
qa_register_plugin_layer('loolex-layer.php', 'loolex-layer');
qa_register_plugin_overrides('loolex-override.php', 'loolex-override');

