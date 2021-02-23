<h3>WP Woocommerce Related product custom query for same category</h3>

//file location 
//related.php

 <?php
// Setup your custom query
$categories = get_the_terms( get_the_ID(), 'category' );
 $category = array_shift( $categories );
 /*
 $loop = new WP_Query( array(
   'posts_per_page'  => 5,
   'category_name'   => $category->slug,
   'post__not_in'    => array( get_the_ID() )
 ) );
 
 */
$args = array('post_type' => 'product','posts_per_page' => '12','orderby' => 'rand', 'order'    => 'DESC', 'category_name'   => $category->slug, 'post__not_in' => array(get_the_ID()) );

$loop = new WP_Query( $args );
