<?php
namespace GooseStudio\WPJSONRestrictions;

/**
 * Class AdminPage
 * @package GooseStudio\WPJSONRestrictions
 */
class AdminPage
{
    public function init() {
        add_action( 'admin_menu', array( $this, 'admin_menu' ) );
    }

    public function admin_menu() {
        add_options_page(
            'WP JSON Restrictions',
            'JSON Restrictions',
            'manage_options',
            'wpjson_restrictions',
            array(
                $this,
                'settings_page'
            )
        );
    }

    public function settings_page() {
        include WP_JSON_RESTRICTIONS_DIR . '/assets/views/settings-page.php';
    }
}
