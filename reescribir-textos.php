<?php
/*
* Plugin Name:  Reescribir Textos
* Description:  Un plugin de WordPress para reescribir texto.
* Author:       Enzipe
* Author URI:   https://www.enzipe.com/
* Version:      1.0.0
* License:      GPL v2 or later
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain:  reescribirtextos
*/
if (!defined('ABSPATH')) {
    echo ('Activate plugin first');
    exit;
}

class RECT_Reescribirtextos
{

    public function __construct()
    {

        add_action('wp_enqueue_scripts', array($this, 'rect_load_assets'));

        add_action('wp_enqueue_style', array($this, 'rect_load_assets'));

        add_action('add_meta_boxes', array($this, 'rect_addTooltip'));

        add_action('wp_localize_script', array($this, 'rect_add_custom_box'));

        add_action('add_meta_boxes', array($this, 'rect_add_custom_box'));

        add_shortcode('reescribirtextos', array($this, 'rect_load_shortcode'));
    }


    public function rect_load_assets()
    {

        wp_enqueue_style(
            'slope-calculator',
            plugin_dir_url(__FILE__) . 'lib/css/reescribirtextos-css.css',
            array(),
            1,
            'all'
        );

        wp_enqueue_script(
            'slope-calculator',
            plugin_dir_url(__FILE__) . 'lib/js/reescribirtextos-script.js',
            array('jquery'),
            //version
            1,
            'all'
        );
    }

    public function rect_addTooltip()
    {
        echo '<div id="button-bar">
              <input type="hidden" id="zaChangeIndex" value="0" />
              <span id="tooltip" class="tooltip__main"> </span>
              </div>';
    }

    public function rect_add_custom_box()
    {

        wp_enqueue_style(
            'reescribirtextos',
            plugin_dir_url(__FILE__) . 'lib/css/reescribirtextos-css.css',
            array(),
            1,
            'all'
        );
        wp_enqueue_script(
            'reescribirtextos',
            plugin_dir_url(__FILE__) . 'lib/js/reescribirtextos-script.js',
            array('jquery'),
            //version
            1,
            'all'
        );


        $scriptData = array(
            'pin' => get_option('rect_pin_option'),
        );


        wp_localize_script('reescribirtextos', 'auth', $scriptData);

        $screens = ['post', 'page'];
        foreach ($screens as $screen) {
            add_meta_box(
                'rect_box_id',                 // Unique ID
                'Reescribir Textos',      // Box title
                'rect_custom_box_html',  // Content callback, must be of type callable
                $screen,                            // Post type
                'side'
            );
        }
    }

    public function rect_load_shortcode()
    {
        require plugin_dir_path(__FILE__) . 'inc/main-form.php';
    }
}

new RECT_Reescribirtextos;
require plugin_dir_path(__FILE__) . 'inc/admin-setting.php';
