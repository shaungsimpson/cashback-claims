<?php
/**
 * @package    CashbackFAQs
 */
namespace Inc\CPT;

class FAQ {

  private $id;

  function __construct() {
  }

  function register() {
    add_action( 'init', array( 'Inc\CPT\FAQ', 'faq_post_type' ) );
  }

  static function faq_post_type() {
    // set up the FAQ post type variables
    $labels = array(
      'name' => __('FAQs'),
      'singular_name' => __('FAQ'),
      'add_new'            => __( 'Add New FAQ' ),
      'add_new_item'       => __( 'Add New FAQ' ),
      'edit_item'          => __( 'Edit FAQ' ),
      'new_item'           => __( 'Add New FAQ' ),
      'view_item'          => __( 'View FAQ' ),
      'search_items'       => __( 'Search FAQ' ),
      'not_found'          => __( 'No faqs found' ),
      'not_found_in_trash' => __( 'No faqs found in trash' )
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
      'rewrite'              => array("slug" => "faqs"),
      'supports'             => $supports,
      'menu_icon'            => plugins_url( '/cashback-claims/assets/icons/faq-icon.png' )
      // 'register_meta_box_cb' => array( $this, 'swng_add_faq_metaboxes'),
    );
    // register the faqs post type
    register_post_type( 'faq', $args );
  }

}