<?php

/*
*	Q2A Market Royal Minimal Theme Options
*
*	Theme functions
*	File: qa-plugin.php
*	
*	@author			Q2A Market
*	@category		theme
*	@Version: 		1.2
*   @author URL:    http://www.q2amarket.com
*	
*	@Q2A Version    1.7
*
*/

/*
	Plugin Name: Q2AM Royal Minimal Settings
	Plugin URI: http://store.q2amarket.com/q2a-premium-themes/royal-minimal
	Plugin Update Check URI: http://q2amarket.com/meta/update/plugins/royal-minimal-theme-options/qa-plugin.php
	Plugin Description: This pluign is package includes with Q2A Market Royalm Minimal theme. Which provides control over the theme settings
	Plugin Version: 1.2.1
	Plugin Date: 2016-02-27
	Plugin Author: Q2A Market
	Plugin Author URI: http://www.q2amarket.com
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.7
*/


	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}

	qa_register_plugin_module('module', 'q2am-royal-minimal-options.php', 'q2am_royal_minimal_options', 'Q2A Market Royal Minimal Theme Settings');
	

/*
	Omit PHP closing tag to help avoid accidental output
*/