<?php

function kommi_enqueue_scripts()
{

    // Only use this method is we"re not in wp-admin
    if (!is_admin()) {

        /**
         * jQuery
         * We want to use the modern CDN version of jQuery, not the version shipped with WordPress
         */
        wp_deregister_script("jquery");
        wp_register_script("jquery", "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js", false, "3.2.1", true);
        wp_enqueue_script("jquery");

        /**
         * Development styles and scripts
         */
        // wp_enqueue_script( "theme-bundle-js", get_template_directory_uri() . "/assets/app.bundle.js", array( "jquery" ), "", true );
        // wp_enqueue_style( "theme-bundle-css", get_template_directory_uri() . "/assets/app.bundle.css", array(), "", "all" );

        /**
         * Production styles and scripts
         * Comment out when in development mode
         */
        wp_enqueue_script("theme-bundle-js", get_template_directory_uri() . "/assets/app.bundle.min.js", array("jquery"), "", true);
        wp_enqueue_style("theme-bundle-css", get_template_directory_uri() . "/assets/app.bundle.css", array(), "", "all");
    }
}
add_action("wp_enqueue_scripts", "kommi_enqueue_scripts", 999);
