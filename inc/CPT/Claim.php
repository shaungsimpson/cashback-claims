<?php
/**
 * @package    CashbackClaims
 */
namespace Inc\CPT;

class Claim {

  private $id;

  function __construct() {
  }

  function register() {
    add_action( 'init', array( 'Inc\CPT\Claim', 'claim_post_type' ) );
  }

  static function claim_post_type() {
    // set up the Claim post type variables
    $labels = array(
      'name' => __('Claims'),
      'singular_name' => __('Claim'),
      'add_new'            => __( 'Add New Claim' ),
      'add_new_item'       => __( 'Add New Claim' ),
      'edit_item'          => __( 'Edit Claim' ),
      'new_item'           => __( 'Add New Claim' ),
      'view_item'          => __( 'View Claim' ),
      'search_items'       => __( 'Search Claim' ),
      'not_found'          => __( 'No claims found' ),
      'not_found_in_trash' => __( 'No claims found in trash' )
    );
    $supports = array(
      'title',
      'editor',
      'thumbnail'
    );
    $args = array(
      'labels'               => $labels,
      'public'               => true,
      'has_archive'          => true,
      'rewrite'              => array("slug" => "claims"),
      'supports'             => $supports,
      'menu_icon'            => plugins_url( '/cashback-claims/assets/icons/cashback-icon.png' )
      // 'register_meta_box_cb' => array( $this, 'swng_add_claim_metaboxes'),
    );
    // register the claims post type
    register_post_type( 'claim', $args );
  }

}