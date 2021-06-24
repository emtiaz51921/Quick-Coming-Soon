<?php
/**
 * Plugin setting Page
 */

if (!class_exists('QCS_Settings_API')):
	class QCS_Settings_API

		{
		private $settings_api;
		function __construct()
			{
			$this->settings_api = new WeDevs_Settings_API;
			add_action('admin_init', array(
				$this,
				'admin_init'
			));
			add_action('admin_menu', array(
				$this,
				'admin_menu'
			));
			}

		function admin_init()
			{

			// set the settings

			$this->settings_api->set_sections($this->get_settings_sections());
			$this->settings_api->set_fields($this->get_settings_fields());

			// initialize settings

			$this->settings_api->admin_init();
			}

		function admin_menu()
			{
			add_options_page('Quick Coming Soon', 'Quick Coming Soon', 'delete_posts', 'quick_coming_soon', array(
				$this,
				'plugin_page'
			));
			}

		function get_settings_sections()
			{
			$sections = array(
				array(
					'id' => 'qcs_basic',
					'title' => __('Basic Settings', 'quick-coming-soon')
				) ,
			);
			return $sections;
			}

		/**
		 * Returns all the settings fields
		 *
		 * @return array settings fields
		 */
		function get_settings_fields()
			{
			$settings_fields = array(
				'qcs_basic' => array(
					array(
						'name' => 'textarea',
						'label' => __('Quick Notice', 'quick-coming-soon') ,
						'desc' => __('It will display at the middle of the page. You can use {span} for different color.', 'quick-coming-soon') ,
						'type' => 'textarea'
					) ,
                                    
                                    array(
                                            'name' => 'back_image',
                                            'label' => __( 'Background Image', 'quick-coming-soon' ),
                                            'desc' => __( 'Upload if you don\'t like the default one', 'quick-coming-soon' ),
                                            'type' => 'file',
                                            'default' => ''
                                        ),
                                    array(
                                            'name' => 'qc_facebook',
                                            'label' => __( 'Facebook', 'quick-coming-soon' ),
                                            'desc' => __( 'https://facebook.com/example', 'quick-coming-soon' ),
                                            'type' => 'text',
                                        ),
                                    array(
                                            'name' => 'qc_twitter',
                                            'label' => __( 'Twitter', 'quick-coming-soon' ),
                                            'desc' => __( 'https://twitter.com/example', 'quick-coming-soon' ),
                                            'type' => 'text',
                                        ),
                                    array(
                                            'name' => 'qc_youtube',
                                            'label' => __( 'YouTube', 'quick-coming-soon' ),
                                            'desc' => __( 'https://youtube.com/example', 'quick-coming-soon' ),
                                            'type' => 'text',
                                        ),
                                    
				) ,
			);
			return $settings_fields;
			}

		function plugin_page()
			{
			echo '
<div class="wrap">
';
			$this->settings_api->show_navigation();
			$this->settings_api->show_forms();
			echo '
</div>
';
			}

		/**
		 * Get all the pages
		 *
		 * @return array page names with key value pairs
		 */
		function get_pages()
			{
			$pages = get_pages();
			$pages_options = array();
			if ($pages)
				{
				foreach($pages as $page)
					{
					$pages_options[$page->ID] = $page->post_title;
					}
				}

			return $pages_options;
			}
		}

endif;

function qcs_get_option($option, $section, $default = '')
	{
	$options = get_option($section);
	if (isset($options[$option]))
		{
		return $options[$option];
		}

	return $default;
	}

