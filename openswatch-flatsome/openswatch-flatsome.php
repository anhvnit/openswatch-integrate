<?php
/*
Plugin Name: Open Swatch - Flatsome theme integrate
Plugin URI: http://openswatch.com/
Description: Swatch color for woocommerce .
Author: anhvnit@gmail.com
Author URI: http://openswatch.com/
Version: 3.6
Text Domain: open-swatch-flatsome
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/
define('OPENSWATCH_FLATSOME_URI',plugins_url('openswatch-flatsome'));
define('OPENSWATCH_FLATSOME_PATH',plugin_dir_path(__FILE__));
wp_register_script( 'openswatch_custom', OPENSWATCH_FLATSOME_URI.'/openswatch_custom.js',array('jquery','openswatch') );

if(!function_exists('op_test_woocommerce_before_template_part'))
{

    function op_test_woocommerce_before_template_part($template_name, $template_path, $located, $args){
        echo $template_name.'-'.$template_path.'-'.$located; 
        echo ' | ';
    }
}

function opw_wc_get_template($located, $template_name, $args, $template_path, $default_path){
    if($template_name == 'single-product/product-image.php')
    {
        $located = OPENSWATCH_FLATSOME_PATH.'/view/product-image.php';
    }
    if($template_name == 'woocommerce/single-product/product-gallery-thumbnails.php')
    {
        $located = OPENSWATCH_FLATSOME_PATH.'/view/product-gallery-thumbnails.php';
    }
    return $located;
}
add_filter('wc_get_template','opw_wc_get_template',10,5);
//add_action('woocommerce_before_template_part','op_test_woocommerce_before_template_part',10,4);

if(!function_exists('opwf_openswatch_get_product_image_gallery'))
{
    function opwf_openswatch_get_product_image_gallery($openswatch_attachement_ids,$first_thumb){
        if($first_thumb)
        {
            array_unshift($openswatch_attachement_ids,$first_thumb);
        }
        
        return $openswatch_attachement_ids;
        
    }
}
add_filter('openswatch_get_product_image_gallery','opwf_openswatch_get_product_image_gallery',10,2);
if(!function_exists('opwf_openswatch_get_gallery_image_ids'))
{
    function opwf_openswatch_get_gallery_image_ids($openswatch_attachement_ids,$thumb_id){
        if($thumb_id)
        {
            array_unshift($openswatch_attachement_ids,$thumb_id);
        }
        
        return $openswatch_attachement_ids;
    }
}
add_filter('openswatch_get_gallery_image_ids','opwf_openswatch_get_gallery_image_ids',10,2);

