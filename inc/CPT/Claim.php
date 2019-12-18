<?php
/**
 * @package    CashbackClaims
 */
namespace Inc\CPT;

class Claim {

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
      // 'editor',
      'thumbnail'
    );
    $args = array(
      'labels'               => $labels,
      'public'               => true,
      'has_archive'          => true,
      'rewrite'              => array("slug" => "claims"),
      'supports'             => $supports,
      'menu_icon'            => plugins_url( '/cashback-claims/assets/icons/cashback-icon.png' ),
      'register_meta_box_cb' => array( self::class, 'add_claim_metaboxes'),
    );
    // register the claims post type
    register_post_type( 'claim', $args );
  }

  // add the metabox/es via callback
  static function add_claim_metaboxes() {
    add_meta_box(
      'claim_metabox',
      "Claim Details",
      array( self::class, 'claim_box' ),
      'claim',
      'normal',
      'high'
    );
  }

  // metabox html
  static function claim_box() {
    global $post_id;
    wp_nonce_field( 'claim', 'claim_fields' );

    $claim = array(
      'first-name',
      'last-name',
      'company-name',
      'mobile',
      'email',
      'address-1',
      'address-2',
      'suburb',
      'claim-state',
      'postcode',
      'claim-date',
      'terms'
    );

    $purchase = array(
      "purchase-date",
      "purchase-state",
      "purchase-location",
      "invoice-number",
      "invoice-img"
    );

    ob_start();
    require PLUGIN_PATH . "templates/metabox/claim-meta.php";
    $box = ob_get_clean();
    echo $box;
  }

  // set up saving post meta
  static function save_meta($post_id) {
    if ( array_key_exists( 'claim', $_POST ) ) {
      update_post_meta( $post_id, 'claim', $_POST['claim'] );
    }
  }

  // set visible extra columns in post edit screen
  static function set_columns( $columns ) {
    $columns['position'] = __( 'Position' );
    return $columns;
  }

  // set extra columns values in post edit screen
  static function get_columns( $column, $post_id ) {
    if ( $column === 'position' ) {
      $position = get_post_meta( $post_id, 'claim', true );
      _e( $position );
    }
  }

}