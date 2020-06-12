<?php
/**
* Plugin Name: Check-it-Off Travel Blog Injector
* Plugin URI: https://github.com/FreshyMichael/checkitofftravel-blog-injector
* Description: Inject content into Divi Blog Module output
* Version: 1.0.0
* Author: FreshySites
* Author URI: https://freshysites.com/
* License: GNU v3.0
*/

if ( ! defined( 'ABSPATH' ) ) {
	die();
}

/* FreshySites Blog Injector Start */
//______________________________________________________________________________


//// Enqueue Stylesheet
function cit_blog_grid_style() {
    wp_enqueue_style( 'cit-blog-grid-style', plugins_url( 'blog-grid-styles.css', __FILE__ ) );
}
add_action( 'wp_enqueue_scripts', 'cit_blog_grid_style' );
// End Style Sheet

// The Loop
add_action( 'loop_start', 'fs_890531_loop_start' );

function fs_890531_loop_start( $query )
{
   if( $query->is_main_query() )
   {
       add_action( 'the_post', 'fs_890531_the_post' );
       add_action( 'loop_end', 'fs_890531_loop_end' );
   }
}

function fs_890531_the_post()
{
 global $loop_counter;
 $loop_counter++;

 if( (!is_paged() && !is_singular()) && ($loop_counter == 8 )) {
   echo '<div class="insta-blog"><center>';
   echo do_shortcode('[ds_layout_sc id="16393"]');
   echo '</center></div>';
   $loop_counter = $loop_counter + 1;
 }

 if( (!is_paged() && !is_singular()) && ($loop_counter == 14 )) {
   echo '<div class="blog-img-injection"><center>';
   echo do_shortcode('[et_pb_section global_module="14963"][/et_pb_section]');
   echo '</center></div>';
   $loop_counter = $loop_counter + 1;
 }
global $loop_counter_paged;
 $loop_counter_paged++;
 if( (is_paged() ) && ($loop_counter == 8) ) {
   echo '<div class="insta-blog"><center>';
   echo do_shortcode('[ds_layout_sc id="16393"]');
   echo '</div>';
   $loop_counter_paged = $loop_counter_paged + 1;
 }
 if( (is_paged() ) && ($loop_counter == 14) ) {
   echo '<div class="blog-img-injection">';
   echo do_shortcode('[et_pb_section global_module="14963"][/et_pb_section]');
   echo '</div>';
   $loop_counter_paged = $loop_counter_paged + 1;
 }
   
}
function fs_890531_loop_end()
{
   remove_action( 'the_post', 'fs_890531_the_post' );
}

//______________________________________________________________________________
// All About Updates

//  Begin Version Control | Auto Update Checker
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
// ***IMPORTANT*** Update this path to New Github Repository Master Branch Path
	'https://github.com/FreshyMichael/checkitofftravel-blog-injector',
	__FILE__,
// ***IMPORTANT*** Update this to New Repository Master Branch Path
	'checkitofftravel-blog-injector'
);
//Enable Releases
$myUpdateChecker->getVcsApi()->enableReleaseAssets();
//Optional: If you're using a private repository, specify the access token like this:
//
//
//Future Update Note: Comment in these sections and add token and branch information once private git established
//
//
//$myUpdateChecker->setAuthentication('your-token-here');
//Optional: Set the branch that contains the stable release.
//$myUpdateChecker->setBranch('stable-branch-name');

//______________________________________________________________________________
/* Blog Injector End */
?>
