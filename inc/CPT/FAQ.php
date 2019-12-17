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
    add_action( 'save_post', array( 'Inc\CPT\FAQ', 'save_meta' ) );
    add_filter( 'manage_faq_posts_columns', array('Inc\CPT\FAQ', 'set_columns') );
    add_action( 'manage_faq_posts_custom_column', array('Inc\CPT\FAQ', 'get_columns'), 10, 2);
    add_filter( 'manage_edit-faq_sortable_columns', array('Inc\CPT\FAQ', 'sortable_columns'), 10, 1 );
  }

  // set up the FAQ custom post type
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
      'menu_icon'            => plugins_url( '/cashback-claims/assets/icons/faq-icon.png' ),
      'register_meta_box_cb' => array( self::class, 'add_faq_metaboxes'),
    );
    // register the faqs post type
    register_post_type( 'faq', $args );
  }

  // add the metabox/es via callback
  static function add_faq_metaboxes() {
    add_meta_box(
      'faq_position_metabox',
      "FAQ Position",
      array( self::class, 'faq_position_box' ),
      'faq',
      'side',
      'high'
    );
  }

  // metabox html
  static function faq_position_box() {
    global $post_id;
    wp_nonce_field( 'faq', 'faq_position' );

    $faq_position = get_post_meta( $post_id, 'faq_position', true ) ?? '';

    ob_start();
    ?>
    <label><strong>FAQ Position</strong></label>
    <input class="widefat" type="number" name="faq_position" value="<?= $faq_position; ?>">
    <?php
    $box = ob_get_clean();
    echo $box;
  }

  // set up saving post meta
  static function save_meta($post_id) {
    if ( array_key_exists( 'faq_position', $_POST ) ) {
      update_post_meta( $post_id, 'faq_position', $_POST['faq_position'] );
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
      $position = get_post_meta( $post_id, 'faq_position', true );
      _e( $position );
    }
  }

  static function sortable_columns( $columns ) {
    $columns['position'] = 'faq_position';
    return $columns;
  }

  // static function posts_orderby( $query ) {
  //   if( ! is_admin() || ! $query->is_main_query() ) {
  //     return;
  //   }
  //   if ( 'faq_position' === $query->get( 'orderby') ) {
  //     $query->set( 'orderby', 'meta_value' );
  //     $query->set( 'meta_key', 'faq_position' );
  //     $query->set( 'meta_type', 'numeric' );
  //   }
  // }

}