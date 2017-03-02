<?php
namespace GooseStudio\WPJSONRestrictions;

/**
 * Class Restrict
 * @package GooseStudio\WPJSONRestrictions
 */
class Restrictions
{
    public function init()
    {
        add_filter('rest_authentication_errors', [$this, 'restrict_access']);
    }

    public function restrict_access($access)
    {
        if (Settings::disableGlobalJSON()) {
            return new \WP_Error('rest_cannot_access', __('No one can access the REST API.', 'wp-json-restrictions'), array('status' => rest_authorization_required_code()));
        }
        if (Settings::disableForNonLoggedIn() && !is_user_logged_in()) {
            return new \WP_Error('rest_cannot_access', __('Only authenticated users can access the REST API.', 'disable-json-api'), array('status' => rest_authorization_required_code()));
        }

        return $access;

    }
}