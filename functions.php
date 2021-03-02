<?php
//require_once get_template_directory() . '/inc/demo_debug.php'; // demo debug

// Init
require_once get_template_directory() . '/inc/init/theme.php'; // theme init
require_once get_template_directory() . '/inc/init/customizer.php'; // customizer
require_once get_template_directory() . '/inc/init/custom-header.php'; // custom header feature
require_once get_template_directory() . '/inc/init/extras.php'; // extras

// Norebro helper framework
require_once get_template_directory() . '/inc/framework/bootstrap.php'; // Norebro framework

// Include TGMPA and set up plugins
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require_once get_template_directory() . '/inc/tgmpa/register_plugins.php';
require_once get_template_directory() . '/inc/tgmpa/vc_setup.php';
require_once get_template_directory() . '/inc/tgmpa/acf_setup.php';
require_once get_template_directory() . '/inc/tgmpa/woocommerce_setup.php';
require_once get_template_directory() . '/inc/tgmpa/ocdi_setup.php';

// Parts
require_once get_template_directory() . '/inc/template-tags.php'; // custom tags template
require_once get_template_directory() . '/inc/sidebars.php'; // sidebars register
require_once get_template_directory() . '/inc/menu.php'; // mega menu
require_once get_template_directory() . '/inc/wp_overrides.php'; // WP features overrides (posts, comments, auth, ...)

// CSS and JS includes
require_once get_template_directory() . '/inc/enqueue.php';


add_filter( 'body_class','my_body_classes' );
function my_body_classes( $classes ) {
 	global $post;
 	$post_slug = $post->post_name;
 	
    $classes[] = $post_slug;
     
    return $classes;
     
}


add_filter( 'edit_profile_url', 'modify_profile_url_wpse_94075', 10, 3 );

/**
 * http://core.trac.wordpress.org/browser/tags/3.5.1/wp-includes/link-template.php#L2284
 *
 * @param string $scheme The scheme to use. 
 * Default is 'admin'. 'http' or 'https' can be passed to force those schemes.
*/
function modify_profile_url_wpse_94075( $url, $user_id, $scheme )
{
    // Makes the link to http://example.com/custom-profile
    $url = site_url( '/profile' );
    return $url;
}


register_sidebar(array(
        'id' => 'paynow-widget',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',        
        'name'=>__( 'PayNow', 'amp' ),  
    ));


   
    function my_custom_gateway_labels( $gateways ) { 
 
    $gateways['paynow'] = array(
        'admin_label'    => esc_attr__( 'PayNow', 'give' ),
        'checkout_label' => esc_attr__( 'PayNow', 'give' )
    );
   
    
return $gateways;
}
add_filter( 'give_payment_gateways', 'my_custom_gateway_labels', 10 );
 
 

add_action('wp_logout','ps_redirect_after_logout');
function ps_redirect_after_logout(){
         wp_redirect( 'login' );
         exit();
}



 
     
register_sidebar(array(
        'id' => 'sitemap-widget',
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3 class="widgettitle">',
        'after_title' => '</h3>',        
        'name'=>__( 'Sitemap', 'amp' ),  
    ));
    
    

 
function give_mamafrica_donations_save_custom_fields( $payment_id ) {
   
    require_once get_template_directory() . '/omise/lib/Omise.php'; // WP features
 
   if($_POST['payment-mode']=='paynow' && !empty($_POST['omiseToken'])){  

        define('OMISE_PUBLIC_KEY', 'pkey_test_5n1jg2hw0vfl1qiw7u4');
        define('OMISE_SECRET_KEY', 'skey_test_5molwp5n6mdr6c2xmet');
        define('OMISE_API_VERSION', '2017-11-02');
        $amount = $_POST['give-amount'];

        $charge = OmiseCharge::create(array(
        'amount'=>$amount*100,
        'currency'=>'SGD',
        'card'=>$_POST['omiseToken']
        ));
        global $wpdb;
         $table_name = $wpdb->prefix .'posts';

        $ereminders = $wpdb->query($wpdb->prepare("UPDATE $table_name SET status='publish' WHERE ID=$payment_id"));


    }
     
}

add_action( 'give_insert_payment', 'give_mamafrica_donations_save_custom_fields' );



 