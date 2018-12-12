<?php
/*
	Plugin Name: Custom Askbox Widget
	Plugin URI: https://www.github.com/echteinfachtv/q2a-custom-ask-box-widget/
	Plugin Description: Customized Ask Box
	Plugin Version: 1.0
	Plugin Date: 2012-06-13
	Plugin Author: echteinfachtv
	Plugin Author URI: http://www.echteinfach.tv/
	Plugin License: GPLv3
	Plugin Minimum Question2Answer Version: 1.4
	Plugin Update Check URI: https://raw.github.com/echteinfachtv/q2a-custom-ask-box-widget/master/qa-plugin.php

	This program is free software: you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation, either version 3 of the License, or
	(at your option) any later version.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.gnu.org/licenses/gpl.html
	
*/

if ( !defined('QA_VERSION') )
{
	header('Location: ../../');
	exit;
}

qa_register_plugin_module('widget', 'qa-custom-ask-box-widget.php', 'qa_custom_ask_box_widget', 'Custom Askbox Widget');
	

/* CSS to add to your theme's css file: 
	#askboxtable { width:95%; *margin-top:20px; }
	.ask-box-button { margin-left:10px;cursor:pointer; *float:right; } 
	#askboxin { width:75%; *float:left; *margin-top:5px; }
	input#askboxin,input#title {  
	padding: 5px;
	outline: none;
	background: #FFFFFF;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	border: 1px solid #717171;
	box-shadow: 1px 1px 0px #efefef;
	-moz-box-shadow: 1px 1px 0px #efefef;
	-webkit-box-shadow: 1px 1px 0px #efefef;
	}
	input#askboxin:focus {  
	box-shadow: 0 0 5px #9BBF3B;
	-moz-box-shadow: 0 0 5px #9BBF3B;  
	-webkit-box-shadow: 0 0 5px #9BBF3B;  
	}
	input#title:focus {  
	box-shadow: 0 0 2px #007eff;
	-moz-box-shadow: 0 0 2px #007eff;  
	-webkit-box-shadow: 0 0 2px #007eff;  
	}
	#askboxtable>tbody>tr>td {
	background-color: #AFCF4C;
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#DFFF9C), to(#AFCF4C));
	background-image: -moz-linear-gradient(#DFFF9C, #AFCF4C);
	background-image: -o-linear-gradient(#DFFF9C, #AFCF4C);
	background-image: linear-gradient(#DFFF9C, #AFCF4C);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#DFFF9C', endColorstr='#AFCF4C',GradientType=0 );
	}
*/



/*
	Omit PHP closing tag to help avoid accidental output
*/