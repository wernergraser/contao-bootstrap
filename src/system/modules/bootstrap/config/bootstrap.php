<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   netzmacht-columnset
 * @author    David Molineus <http://www.netzmacht.de>
 * @license   GNU/LGPL
 * @copyright Copyright 2012 David Molineus netzmacht creative
 *
 **/


/**
 * bootstrap configuration
 */
$GLOBALS['BOOTSTRAP'] = array
(
	'form' => array
	(
		// form widgets get automatically added the form-control class. elements listed here will be skipped
		'noFormControl'     => array('button', 'submit', 'checkbox', 'radio'),

		// form widgets can be an input group
		'allowInputGroup'   => array('text', 'textarea', 'password'),

		// define which widgets should be generated by a template and not by the default routine
		'generateTemplates' => array
		(
			'checkbox'      => 'form_checkbox_generate',
			'radio'         => 'form_radio_generate',
		),

		// which columns shall be used for the form in table mode
		'tableFormat' => array
		(
			'label'         => 'col-lg-3',
			'control'       => 'col-lg-9',
			'offset'        => 'col-lg-offset-3',
		),

		// which controls are generated without a label. This is used to set offset in the table layout
		'noLabel'           => array('checkbox', 'radio'),

		// how to display forms like comments form by default
		'defaultTableless'  => true,
	),

	// The bootstrap module supports different icons sets
	'icons' => array
	(
		// registered icons sets
		'sets' => array
		(
			'font-awesome'  => array
			(
				'path'      => 'system/modules/bootstrap/config/icons/font-awesome.php',
				'template'  => '<i class="icon-%s"></i>',
			),
			'glyphicons'    => array
			(
				'path'      => 'system/modules/bootstrap/config/icons/glyphicons.php',
				'template'  => '<span class="glyphicon glyphicon-%s"></span>',
			),
		),

		// the array where all icons are defined
		''                  => array(),

		// which tag shall be used for icons
		'template'          => array(),
	),

	'dropdown' => array
	(
		// element which is used as download toggler
		'toggle' => '<b class="caret"></b>',
	),


	'templates' => array
	(
		// Define paths for autoloading templates. This is used so that only if bootstrap is activated in the layout
		// the default templates are overridden
		// You can add differnt template directories here.
		'dynamicLoad' => array
		(
			'system/modules/bootstrap/templates/theme' => array
			(
				'ce_accordion',
				'ce_accordion_start',
				'form',
				'form_captcha',
				'form_checkbox',
				'form_explanation',
				'form_headline',
				'form_message',
				'form_password',
				'form_radio',
				'form_submit',
				'form_widget',
				'mod_breadcrumb',
				'mod_comment_form',
				'mod_search_advanced',
				'nav_default',
				'pagination',
			),
		),

		// Configuration of template modifer. They changes templates when being parsed. There are 2 types supported:
		// placeholder or callback. A placeholder try to replace a string of an template variable. A Callback just
		// runs before template is rendered. It's pretty the same like the parseTemplate hook but, you can specify
		// which templates are affected and use anonymous functions
		'modifiers' => array
		(
			// #navClass# placeholder is used for injecting defined nav classes to the rendered items
			array
			(
				'type' => 'placeholder',

				'placeholder' => '#navClass#',

				// template key which shall be modified
				'key' => 'items',

				// define which templates are affected
				'templates' => array
				(
					'mod_navigation',
					'mod_customnav',
				),

				// replace value, can be plain value or anything what is_callable. Template object is passed as argument
				'value' => function($template)
				{
					return $template->bootstrap_navClass;
				}
			),

			// add active class to trail class
			array
			(
				'type' => 'callback',

				'templates' => array
				(
					'nav_default',
					'nav_bootstrap_dropdown'
				),

				'callback' => array('Bootstrap\\TemplateModifier', 'addActiveClassToTrailItem'),
			),

			array
			(
				'type'        => 'placeholder',
				'key'         => 'items',
				'placeholder' => '<li><span class="current">',
				'value'       => '<li class="active"><span>',
				'templates'   => array('pagination'),
			),

			array
			(
				'type' => 'callback',

				'templates' => array
				(
					'ce_accordion',
					'ce_accordion_start',
				),

				'callback' => array('Bootstrap\\TemplateModifier', 'setPanelDefaultClass'),
			)
		),
	),

	// Wrappers are content elements containing a start, separators and stop elements
	// If they are created a generic callback checks how to create or delete the containing elements
	// Only change this config if you know what you are doing!
	'wrappers' => array
	(
		// Bootstrap tab component
		'tabs' => array
		(
			'start' => array
			(
				'name'          => 'bootstrap_tabStart',
				'triggerCreate' => true, // auto create separators and stop element
				'triggerDelete' => true, // auto deleete separators and stop element
			),

			'separator' => array
			(
				'name'          => 'bootstrap_tabPart',
				'autoCreate'    => true, // can be auto created
				'autoDelete'    => true, // can be auto deleted

				// callback to detect how many separators exists
				'countExisting' => array('Bootstrap\\DataContainer\\Content', 'countExistingTabSeparators'),

				// callback to detect how many separators are required
				'countRequired' => array('Bootstrap\\DataContainer\\Content', 'countRequiredTabSeparators'),
			),

			'stop' => array
			(
				'name'       => 'bootstrap_tabEnd',
				'autoCreate' => true,
				'autoDelete' => true,
			),
		),

		// Bootstrap carousel component
		'carousel' => array
		(
			'start' => array
			(
				'name'          => 'bootstrap_carouselStart',
				'autoCreate'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),

			'separator' => array
			(
				'name'          => 'bootstrap_carouselPart',
				'triggerCreate' => false,
				'autoDelete'    => true,

			),

			'stop' => array
			(
				'name'          => 'bootstrap_carouselEnd',
				'autoCreate'    => true,
				'autoDelete'    => true,
			),
		),

		'accordion' => array
		(
			'start' => array
			(
				'name'          => 'bootstrap_accordionGroupStart',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),

			'stop' => array
			(
				'name'          => 'bootstrap_accordionGroupEnd',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),
		),

		'buttonToolbar' => array
		(
			'start' => array
			(
				'name'          => 'bootstrap_buttonToolbarStart',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),

			'stop' => array
			(
				'name'          => 'bootstrap_buttonToolbarEnd',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),
		),

		'buttonGroup' => array
		(
			'start' => array
			(
				'name'          => 'bootstrap_buttonGroupStart',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),

			'stop' => array
			(
				'name'          => 'bootstrap_buttonGroupEnd',
				'autoCreate'    => true,
				'autoDelete'    => true,
				'triggerCreate' => true,
				'triggerDelete' => true,
			),
		),
	),
);