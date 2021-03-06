<?php
namespace WordPress\Plugins;

// Include this file if on a local, testing build
if ( file_exists( __DIR__ . '/vendor/autoload.php' )) {
    require_once( __DIR__ . '/vendor/autoload.php' );
}

/**
 * Loads and sets up WordPress plugin extensions
 */
final class Extensions
{
    
    /**
     * Whether plugin extensions are already initialized
     *
     * @var bool
     */
    private static $isInitialized = false;
    
    
    /**
     * Load and set up WordPress plugin extensions
     */
    public static function Initialize()
    {
        // Exit. WordPress is not yet initialized.
        if ( !defined( 'ABSPATH' )) {
            return;
        }
        
        // Exit. WordPress actions and filters are missing.
        if ( !file_exists( ABSPATH . '/wp-includes/plugin.php' )) {
            return;
        }
        
        // Exit. Already initialized.
        if ( self::$isInitialized ) {
            return;
        }
        
        // Include WordPress actions and filters
        require_once( ABSPATH . '/wp-includes/plugin.php' );
        
        // Before any plugins load, include the plugin extensions
        Extensions\Dependencies::Initialize();
        
        // Mark as initialized
        self::$isInitialized = true;
    }
}

// Try to auto-start extensions
Extensions::Initialize();
