<div class="wrap">
    <h1>WP JSON Restrictions</h1>
    <form method="POST" action="options.php">
        <?php settings_fields( 'wp-json-restrictions' );
        do_settings_sections( 'wp-json-restrictions' );
        submit_button();
        ?>
    </form>

</div>