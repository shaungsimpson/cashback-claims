<?php
/**
 * @package CashbackClaims
 */
namespace Inc\Core;

use Inc\CPT\Claim;

class Activate {

  public static function activate() {
    flush_rewrite_rules();
  }

}
