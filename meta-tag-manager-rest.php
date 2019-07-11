<?php
/*
Plugin Name: Meta Tag Manager Rest
Plugin URI: https://github.com/wp-meta-tag-manager-rest
Description: Rest extension for wordpress meta tag manager plugin
Author: Henk Rehorst
Version: 1.0
Author URI: https://github.com/henkrehorst
Text Domain: meta-tag-manager-rest
*/

//check if meta tag manager class exists
if(!class_exists('Meta_Tag_Manager')) exit();

class MetaTagManagerRest{
    public static function init()
    {
        //register metatags field in rest api for page object
        add_action('rest_api_init', function (){
            register_rest_field('page', 'metatags', [
                'get_callback' => 'MetaTagManagerRest::getMetaTagsFromPage',
                'schema' => null
            ]);
        });
    }

    public static function getMetaTagsFromPage($object){
        //return meta tags from post
        return Meta_Tag_Manager::get_post_data($object['id']);
    }

}

//load plug after meta tag manager plugin
add_action( 'plugins_loaded', array('MetaTagManagerRest', 'init'), 101 );