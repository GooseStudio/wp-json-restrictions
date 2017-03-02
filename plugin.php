<?php
/*
Plugin Name: WP JSON Restrictions
Plugin URI: https://goose.studio
Description: Adds granular ability to disable/enable endpoints per role. Or disable all together Edit
Version: 0.1
Author: Goose Studio, andreasnrb
Author URI: https://goose.studio
License: GPLv2
*/
define ('WP_JSON_RESTRICTIONS_DIR', __DIR__);
include WP_JSON_RESTRICTIONS_DIR . '/src/Settings.php';
include WP_JSON_RESTRICTIONS_DIR . '/src/Restrictions.php';

if ( is_admin() ) {
    include WP_JSON_RESTRICTIONS_DIR . '/src/AdminPage.php';
    (new \GooseStudio\WPJSONRestrictions\Settings())->init();
    (new \GooseStudio\WPJSONRestrictions\AdminPage())->init();
}
    (new \GooseStudio\WPJSONRestrictions\Restrictions())->init();
