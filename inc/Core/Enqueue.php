<?php
/**
 * @package    CashbackFAQs
 */
namespace Inc\Core;

define( 'CSS_PATH', '/cashback-claims/assets/css/' );
define( 'JS_PATH', '/cashback-claims/assets/js/' );

class Enqueue {


  public function register() {
    add_action( 'admin_enqueue_scripts', array( $this, 'admin_enqueue' ) );
    // add_action( 'wp_enqueue_scripts', array( $this, 'public_enqueue' ) );
  }

  // enqueue admin side scripts and styles.
  function admin_enqueue() {
    wp_enqueue_style( 'cbc_admin_styles', plugins_url( CSS_PATH . 'admin-styles.css') );
  }

  // enqueue front end scripts and styles.
  function public_enqueue() {
    // wp_enqueue_style( 'cbc_admin_styles', plugins_url( '/cashback-claims/assets/css/admin-styles.css') );
  }

}