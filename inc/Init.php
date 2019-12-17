<?php
/**
 * @package    CashbackClaims
 */
namespace Inc;

final class Init {

  /**
   * Gets the services. Stores all the classes in an array for easy initialisation
   *
   * @return     array  Full list of classes for the plugin.
   */
  public static function get_services() {
    return array(
      // eg. Pages\Admin::class,
      // eg. Base\Enqueue::class,
      // eg. Base\SettingsLinks::class
      CPT\Claim::class,
      CPT\FAQ::class,
    );
  }

  /**
   * Loop through all the classes, instantiate them and call register() if it exists.
   */
  public static function register_services() {
    foreach ( self::get_services() as $class ) {
      $service = self::instantiate( $class );
      if (method_exists( $service, 'register' ) ) {
        $service->register();
      }
    }
  }

  /**
   * Initialize the class
   * @param  class $class    class from the services array
   * @return class instance  new instance of the class
   */
  private static function instantiate( $class ) {
    $service = new $class();
    return $service;
  }

}