<?php
/*
Plugin Name: Career
Description: This Plugin is used to create a Career Page
Version: 1.1
*/
add_action('init','career_css_initialization');

function career_css_initialization() {
 	wp_enqueue_style( 'career_css', plugins_url( 'assets/css/career.css', __FILE__ )); 
}



define('ROOTDIRCAR', plugin_dir_path(__FILE__));
require_once(ROOTDIRCAR . 'career-list.php');    //include career-list.php
require_once(ROOTDIRCAR . 'career-create.php');  //include career-create.php
require_once(ROOTDIRCAR . 'career-update.php');  //include career-update.php
require_once(ROOTDIRCAR . 'apply-list.php');    //include career-list.php


add_action('admin_menu', 'career_cat');  

function career_cat(){

	//main item for menu
	add_menu_page(
		'Careers', 		 //page_title
		'Careers', 		 //menu_title
		'manage_options',        //capability
		'career-list',  //menu_slug 
		'career_list'   //function
	);
	//this is submenu
	add_submenu_page(
		'career-list',   //product slug
		'View Apply',    //page_title
		'Applied List',                //menu_title
		'manage_options',        //capability
		'apply-list',  //menu_slug 
		'apply_list'   //function
	);

	//this is a submenu
	add_submenu_page(
		'career-list',   //product slug
		'Add Career',    //page_title
		'Add New',                //menu_title
		'manage_options',         //capability
		'career-create', //menu_slug
		'career_create'  //function
	); 
	
	//this submenu is HIDDEN, however, we need to add it anyways
	add_submenu_page(
		'career-list', 	//product slug
		'Update Career',   //page_title
		'', 					//menu_title
		'manage_options',			//capability
		'career-update',   //menu_slug
		'career_update'    //function
	); //function

	
	
}


?>
