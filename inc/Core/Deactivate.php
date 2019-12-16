<?php
/**
 * @package CashbackClaims
 */
namespace Inc\Core;

class Deactivate {

  public static function Deactivate() {
    flush_rewrite_rules();
  }

}
