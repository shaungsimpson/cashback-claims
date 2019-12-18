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
    add_action( 'save_post', array( 'Inc\CPT\Claim', 'save_meta' ) );
    add_filter( 'manage_claim_posts_columns', array('Inc\CPT\Claim', 'set_columns') );
    add_action( 'manage_claim_posts_custom_column', array('Inc\CPT\Claim', 'get_columns'), 10, 2);
    add_filter( 'manage_edit-claim_sortable_columns', array('Inc\CPT\Claim', 'sortable_columns'), 10, 1 );
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
  static function save_meta( $post_id ) {
    $meta_keys = array( 'first-name', 'last-name', 'company-name', 'mobile', 'email', 'address-1', 'address-2', 'suburb', 'claim-state', 'postcode', 'claim-date', 'terms', 'purchase-date', 'purchase-state', 'purchase-location', 'invoice-number', 'invoice-img' );
    // arrays for sanitization by type
    $text_type = array('first-name', 'last-name', 'company-name', 'address-1', 'address-2', 'suburb', 'claim-state', 'postcode', 'purchase-state', 'purchase-location', 'invoice-number');
    $date_type = array( 'claim-date', 'purchase-date' );

    foreach ($meta_keys as $key) {
      if ( array_key_exists( $key, $_POST ) ) {
        // sanitise email
        if ( $key == 'email' )
          $value = sanitize_email( $_POST[$key] );
        // sanitise text fields
        if ( in_array($key, $text_type) )
          $value = sanitize_text_field( $_POST[$key] );
        // sanitise date fields
        if ( in_array($key, $date_type) )
          $value = date( 'Y-m-d', strtotime($_POST[$key]) );
        // sanitise terms meta, converts to boolean
        if ( $key == 'terms' )
          $value = $_POST[$key] == true;
        // sanitises phone number
        if ( $key == 'mobile' )
          $value = preg_replace('/[^0-9]/', '', $_POST[$key]);

        update_post_meta( $post_id, $key, $value );
      }
    }
  }

  // set visible extra columns in post edit screen
  static function set_columns( $columns ) {
    $columns['first-name'] = __( 'First' );
    $columns['last-name'] = __( 'Last' );
    $columns['email'] = __( 'Email' );
    $columns['invoice-number'] = __( 'Invoice' );
    return $columns;
  }

  // set extra columns values in post edit screen
  static function get_columns( $column, $post_id ) {
    $keys = array('first-name', 'last-name', 'email', 'invoice-number');
    foreach ($keys as $key) {
      if ( $column === $key ) {
        $value = get_post_meta( $post_id, $key, true );
        _e( $value );
      }
    }
  }

  static function sortable_columns( $columns ) {
    $columns['first-name'] = 'first-name';
    $columns['last-name'] = 'last-name';
    $columns['email'] = 'email';
    $columns['invoice-number'] = 'invoice-number';
    return $columns;
  }

}