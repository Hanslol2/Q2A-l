<?php

/*
*	Q2A Market Royal Minimal Theme Options
*
*	Control opitons
*	File: q2am-royal-minimal-options.php
*	
*	@author			Q2A Market
*	@category		Plugin
*	@Version: 		1.2
*   @author URL:    http://www.q2amarket.com
*	
*	@Q2A Version    1.7
*
*	This file containing complex program structure to provide
*	control to the Royal Minimal theme and should not modify
*	if you do than your own risk and Q2A Market is not responsible
*	for any your lossess or support.
*/

class q2am_royal_minimal_options
{
	private $plugin_name = 'Royal Minimal Settings';
	private $plugin_prefix = 'rm_';

	function allow_template($template)
	{
		return ($template!='admin');
	}

	/*------------------------------------------------------
		defining all default option value for
		q2am star ratings plugin
	 ------------------------------------------------------*/		

	function option_default($option) {

		switch($option) {

			case $this->plugin_prefix.'heading_fonts':
				return 'Open Sans';

			case $this->plugin_prefix.'body_fonts':
				return 'Open Sans';

			case $this->plugin_prefix.'color_scheme':
				return 'Default';

			default:
				return null;
		}	

	}

	/*------------------------------------------------------
		add form element to plugin options
		this will allows usre to customize plugin
		by defined fields
	 ------------------------------------------------------*/	

	function admin_form(&$qa_content)
	{
		$saved=false;

		/*-- select options array --*/	

		// color scheme	
		$color_scheme = array(
			'Default',
			'DarkBlue',
			'Orange',
			'Red',			
			'Brown',
			'Green',
			'SeaGreen',
			'Purple',
			'Pink',			
			'Black'
		);

		$heading_fonts = array(
			'Open Sans',
			'Wellfleet',			
			'Rambla',
			'Dosis',
			'Noto Sans',
			'Domine',
			'Signika Negative',
			'Arvo',
			'Neuton',
			'Rufina',
			'Tinos',
			'Podkova',
			'Magra',
			'Bitter',
			'Anton',
			'Libre Baskerville',
			'Tienne',
			'Roboto',
			'Ruda',
			'Merriweather',
			'Amaranth',
			'Playfair Display SC',
			'Cinzel Decorative',
			'Nobile',
			'Volkhov',
			'Nunito',
			'Merriweather Sans',
			'Stardos Stencil',
			'Bree Serif',
			'Source Sans Pro',
			'Dosis',
			'Lato',
			'Exo',
			'Roboto Slab',
			'Advent Pro',
			'Raleway',
			'Gruppo',
			'Merriweather Sans',
			'Inika',	
			'Varela Round'	
		);

		$body_fonts = array(
			'Open Sans',
			'Arial',
			'Orienta',
			'Droid Sans',
			'Average Sans',
			'Andika',
			'Montserrat',
			'Alef',
			'Carme',
			'Tahoma',
			'PT Sans',
			'Verdana',
			'Source Sans Pro',
			'Source Code Pro',
			'Roboto',
			'Roboto Slab',
			'Raleway',
			'Merriweather Sans',
			'Varela Round'
		);

		sort($heading_fonts);
		sort($body_fonts);

		// combine options array
		$color_scheme = array_combine($color_scheme, $color_scheme);		
		$heading_fonts = array_combine($heading_fonts, $heading_fonts);
		$body_fonts = array_combine($body_fonts, $body_fonts);
		    
		
		// saving options
		if (qa_clicked('utility_save')) {

			qa_opt($this->plugin_prefix.'heading_fonts',qa_post_text($this->plugin_prefix.'heading_fonts'));
			qa_opt($this->plugin_prefix.'body_fonts',qa_post_text($this->plugin_prefix.'body_fonts'));

			qa_opt($this->plugin_prefix.'color_scheme',qa_post_text($this->plugin_prefix.'color_scheme'));
			qa_opt($this->plugin_prefix.'writing_direction',qa_post_text($this->plugin_prefix.'writing_direction'));

			$saved=true;
		}
		else if (qa_clicked('utility_reset')) {
			foreach($_POST as $i => $v) {
				$def = $this->option_default($i);
				if($def !== null) qa_opt($i,$def);
			}
			$saved=true;
		}


		
		return array(
			'ok' => $saved ? $this->plugin_name.' Saved' : null,
			
			'fields' => array(

				/*-------------------[language options starts ]-----------------------------*/

				array( // heading_fonts
					'label' => 'Heading Fonts',
					'tags' => 'NAME="'.$this->plugin_prefix.'heading_fonts"',
					'id' => $this->plugin_prefix.'heading_fonts',
					'type' => 'select',
					'options' => $heading_fonts,
					'value' => qa_opt($this->plugin_prefix.'heading_fonts'),
				),

				array( // body_fonts
					'label' => 'Body Fonts',
					'tags' => 'NAME="'.$this->plugin_prefix.'body_fonts"',
					'id' => $this->plugin_prefix.'body_fonts',
					'type' => 'select',
					'options' => $body_fonts,
					'value' => qa_opt($this->plugin_prefix.'body_fonts'),
				),

				array( // color_scheme
					'label' => 'Color Scheme',
					'tags' => 'NAME="'.$this->plugin_prefix.'color_scheme"',
					'id' => $this->plugin_prefix.'color_scheme',
					'type' => 'select',
					'options' => $color_scheme,
					'value' => qa_opt($this->plugin_prefix.'color_scheme'),
				),

				array(
					'type' => 'blank'					
				),

			),
			
			'buttons' => array(
				array(
				'label' => 'Save Options',
				'tags' => 'NAME="utility_save"',
				),
				array(
				'label' => 'Restore to default',
				'tags' => 'NAME="utility_reset"',
				),
			),
		);
	}

}


/*
	Omit PHP closing tag to help avoid accidental output
*/	