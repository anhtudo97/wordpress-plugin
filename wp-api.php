<?php

/**
 * Plugin Name: WP Custom API
 * Plugin URI: http://chrushingit.com
 * Description: Custom api to change paypal information
 * Version: 1.0
 * Author: Anh Tu Do
 * Author URI: http://watch-learn.com
 */


function wp_api_paypal($request){
    $username = $request->get_param( 'username' );
    $password = $request->get_param( 'password' );
    $signature = $request->get_param( 'signature' );

    $paypal_settings = get_option( 'woocommerce_paypal_settings' );
    $paypal_settings[ 'api_username' ] = $username;
    $paypal_settings[ 'api_password' ] = $password;
    $paypal_settings[ 'api_signature' ] = $signature;
    update_option( 'woocommerce_paypal_settings', $paypal_settings );

    return $paypal_settings;
}

add_action('rest_api_init', function(){
    register_rest_route('wp-api/v1', 'paypal', [
        'method' => 'GET',
        'callback' => 'wp_api_paypal',
        'args' => [
            'username',
            'password',
            'signature'
        ],
    ]);
});
