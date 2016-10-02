<?php 
function slit_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// This is an example of how to include a plugin bundled with a theme.
		/*array(
			'name'               => 'TGM Example Plugin', // The plugin name.
			'slug'               => 'tgm-example-plugin', // The plugin slug (typically the folder name).
			'source'             => get_template_directory() . '/tgm/plugins/tgm-example-plugin.zip', // The plugin source.
			'required'           => true, // If false, the plugin is only 'recommended' instead of required.
			'version'            => '', // E.g. 1.0.0. If set, the active plugin must be this version or higher. If the plugin version is higher than the plugin version installed, the user will be notified to update the plugin.
			'force_activation'   => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
			'external_url'       => '', // If set, overrides default API URL and points to an external URL.
			'is_callable'        => '', // If set, this callable will be be checked for availability to determine if a plugin is active.
		),*/

		// This is an example of how to include a plugin from an arbitrary external source in your theme.
		
		array(
			'name'         => 'Events Calendar Pro', // The plugin name.
			'slug'         => 'events-calendar-pro', // The plugin slug (typically the folder name).
			'source'       => 'events-calendar-pro.4.2.3.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Event Tickets Plus', // The plugin name.
			'slug'         => 'event-tickets-plus', // The plugin slug (typically the folder name).
			'source'       => 'event-tickets-plus.4.2.3.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'The Events Calendar Community Events', // The plugin name.
			'slug'         => 'the-events-calendar-community-events', // The plugin slug (typically the folder name).
			'source'       => 'the-events-calendar-community-events.4.2.3.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'The Events Calendar Filterbar', // The plugin name.
			'slug'         => 'the-events-calendar-filterbar', // The plugin slug (typically the folder name).
			'source'       => 'the-events-calendar-filterbar.4.2.2.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Woocommerce', // The plugin name.
			'slug'         => 'woocommerce', // The plugin slug (typically the folder name).
			'source'       => 'woocommerce.2.6.4.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Woocommerce Germanized', // The plugin name.
			'slug'         => 'woocommerce-germanized', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/woocommerce-germanized.1.7.0.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Advanced Custom Fields PRO', // The plugin name.
			'slug'         => 'advanced-custom-fields-pro', // The plugin slug (typically the folder name).
			'source'       => 'advanced-custom-fields-pro.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Advanced Custom Fields Date Time Picker', // The plugin name.
			'slug'         => 'acf-field-date-time-picker', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/acf-field-date-time-picker.2.1.1.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Contact Form 7', // The plugin name.
			'slug'         => 'contact-form-7', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/contact-form-7.4.5.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Contact Form 7 To Database Extension', // The plugin name.
			'slug'         => 'contact-form-7-to-database-extension', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/contact-form-7-to-database-extension.2.10.21.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Dynamic Featured Image', // The plugin name.
			'slug'         => 'dynamic-featured-image', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/dynamic-featured-image.3.5.2.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Event Tickets', // The plugin name.
			'slug'         => 'event-tickets', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/event-tickets.4.2.6.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Mailchimp For Wp', // The plugin name.
			'slug'         => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/mailchimp-for-wp.4.0.3.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'The Events Calendar', // The plugin name.
			'slug'         => 'the-events-calendar', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/the-events-calendar.4.2.6.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Wordpress Importer', // The plugin name.
			'slug'         => 'wordpress-importer', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/wordpress-importer.0.6.3.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		array(
			'name'         => 'Wp Mail Smtp', // The plugin name.
			'slug'         => 'wp-mail-smtp', // The plugin slug (typically the folder name).
			'source'       => 'https://downloads.wordpress.org/plugin/wp-mail-smtp.0.9.6.zip', // The plugin source.
			'required'     => true, // If false, the plugin is only 'recommended' instead of required.
		),
		
		

	);

	$config = array(
		'id'           => 'slit', // your unique TGMPA ID
		'default_path' => get_template_directory() . '/tgm/plugins/', // default absolute path
		'menu'         => 'slit-install-required-plugins', // menu slug
		'has_notices'  => true, // Show admin notices
		'dismissable'  => false, // the notices are NOT dismissable
		'dismiss_msg'  => 'I really, really need you to install these plugins, okay?', // this message will be output at top of nag
		'is_automatic' => true, // automatically activate plugins after installation
		'message'      => '<!--Hey there.-->', // message to output right before the plugins table
		'strings'      => array('The plugins has been installed'), // The array of message strings that TGM Plugin Activation uses
	);

	tgmpa( $plugins, $config );
}
?>
