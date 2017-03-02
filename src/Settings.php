<?php
/**
 * Created by PhpStorm.
 * User: andreas
 * Date: 3/2/17
 * Time: 10:51 AM
 */

namespace GooseStudio\WPJSONRestrictions;


class Settings
{
    public function init()
    {
        add_action( 'admin_init', [$this, 'register'] );
    }

    public function register()
    {
        // Add the section to reading settings so we can add our
        // fields to it
        add_settings_section(
            'global_section',
            'Glogal settings',
            [$this, 'render_section'],
            'wp-json-restrictions'
        );

        // Add the field with the names and function to use for our new
        // settings, put it in our new section
        add_settings_field(
            'wp_json_restricted_global',
            'Disable completely',
            [$this, 'setting'],
            'wp-json-restrictions',
            'global_section',
            ['settings'=>'wp_json_restricted_global']

        );
        add_settings_field(
            'wp_json_restricted_non_logged_in',
            'Disable for non-logged-in users',
            [$this, 'setting_radio'],
            'wp-json-restrictions',
            'global_section',
            ['settings'=>'wp_json_restricted_non_logged_in']
        );

        // Register our setting so that $_POST handling is done for us and
        // our callback function just has to echo the <input>
        register_setting( 'wp-json-restrictions', 'wp_json_restricted_global', 'boolval' );
        register_setting( 'wp-json-restrictions', 'wp_json_restricted_non_logged_in', 'boolval' );
    }

    public function render_section()
    {
        echo '<p>',__('These settings handle JSON for whole site', 'wp-json-restrictions'),'</p>';
    }

    public function setting() {
        echo '<input name="wp_json_restricted_global" id="wp_json_restricted_global" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'wp_json_restricted_global' ), false ) . ' /> This disables the WP JSON completely. Be careful.';
    }
    public function setting_radio() {
        echo '<input name="wp_json_restricted_non_logged_in" id="wp_json_restricted_non_logged_in" type="checkbox" value="1" class="code" ' . checked( 1, get_option( 'wp_json_restricted_non_logged_in' ), false ) . ' /> This disables WP JSON for non-logged in users.';
    }

    /**
     * If JSON should be completely disabled.
     * @return bool
     */
    public static function disableGlobalJSON() {
        return (bool)get_option('wp_json_restricted_global', false);
    }
    /**
     * If JSON should be disabled only for non-logged in users.
     * @return bool
     */
    public static function disableForNonLoggedIn() {
        return (bool)get_option('wp_json_restricted_non_logged_in', false);
    }
}