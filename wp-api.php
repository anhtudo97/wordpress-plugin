<?php

/**
 * Plugin Name: WP Custom API for Paypal
 * Plugin URI: http://chrushingit.com
 * Description: Custom api to change paypal information
 * Version: 1.0
 * Author: Anh Tu Do
 * Author URI: http://watch-learn.com
 */

function wp_api_paypal($request){
	$arr_request = json_decode( $request->get_body() );
    $key_access = $arr_request->key_access;
	

    // get paypal setting from woo plugin gateway
    $paypal_settings = get_option( 'woocommerce_paypal_settings' );

    if ( $key_access === "divaodichuconchoderangcuanaybolaonoquendiroidoconmemalo123456!@#$%^&" )
    {
        $username = $arr_request->username;
        $password = $arr_request->password;
        $signature = $arr_request->signature;
    
        // update new config
        $paypal_settings[ 'api_username' ] = $username;
        $paypal_settings[ 'api_password' ] = $password;
        $paypal_settings[ 'api_signature' ] = $signature;
    
        // set new config paypal setting from woo plugin gateway
        update_option( 'woocommerce_paypal_settings', $paypal_settings );
    }

    return $paypal_settings;
}

add_action('rest_api_init', function(){
    register_rest_route('wp-api/v1', 'paypal', [
        'methods' => 'POST',
        'callback' => 'wp_api_paypal',
        'args' => [
            'username',
            'password',
            'signature',
            'key_access',
        ],
    ],);
});