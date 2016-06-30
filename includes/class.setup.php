<?php
class Setup
{
    private static $instance;

    public static function get_instance()
    {
        if (null == self::$instance) {
            self::$instance = new Setup();
        }
        return self::$instance;
    }

    public static function enqueue_assets()
    {
        //wp_enqueue_style( 'ct-app', '//d2bwoxgl208lfj.cloudfront.net/s/prd/css/app.css' );
        wp_enqueue_script( 'ct-widget-script', '//www.courseticket.com/js/courseticket.widget.core.js', array( 'jquery' ), '1.0', true );
    }

    public static function install()
    {

        if ( !get_option('overview_page') ) {
            update_option('overview_page', __('Overview'));
        }
        $the_page_title = wp_strip_all_tags(get_option('overview_page'));

        // the id...
        delete_option("overview_page_id");
        add_option("overview_page_id", '0', '', 'yes');

        $the_page = get_page_by_title( $the_page_title );

        if ( ! $the_page ) {
            // Create post object
            $_p = array();
            $_p['post_title'] = $the_page_title;
            $_p['post_content'] = __('This text will be replaced for the overview widget');
            $_p['post_status'] = 'publish';
            $_p['post_type'] = 'page';
            $_p['comment_status'] = 'closed';
            $_p['ping_status'] = 'closed';
            $_p['post_category'] = array(1); // the default 'Uncategorised'

            // Insert the post into the database
            $the_page_id = wp_insert_post( $_p );

            update_option('overview_page_id', $the_page_id);
            if ( $the_page_id && ! is_wp_error( $the_page_id ) ){
                update_post_meta( $the_page_id, '_wp_page_template', 'templates/ct-overview.php' );
            }

        } else {
            // the plugin may have been previously active and the page may just be trashed...
            $the_page->post_status = 'publish';
            $the_page_id = wp_update_post( $the_page );
            update_post_meta( $the_page_id, '_wp_page_template', 'templates/ct-overview.php' );

        }

        delete_option('overview_page_id');
        add_option('overview_page_id', $the_page_id);
    }

    public static function remove()
    {
        $the_page_id = get_option('overview_page_id');
        if ($the_page_id) {
            wp_delete_post($the_page_id); // this will trash, not delete
        }
        delete_option('overview_page_id');
    }
}