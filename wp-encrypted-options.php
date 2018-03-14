<?php
/**
 * Plugin Name: WP Encrypted Options
 * Plugin URI:  https://github.com/stevegrunwell/wp-cache-remember
 * Description: API for saving encrypted data into the wp_options table.
 * Author:      Steve Grunwell
 * Author URI:  https://stevegrunwell.com
 * Version:     1.0.0
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

if ( ! function_exists( 'add_encrypted_option' ) ) :
	/**
	 * Add a new encrypted option.
	 *
	 * @see add_option()
	 *
	 * @param string      $option     Name of option to add. Expected to not be SQL-escaped.
	 * @param mixed       $value      Optional. Option value. Must be serializable if non-scalar.
	 *                                Expected to not be SQL-escaped.
	 * @param string      $deprecated Optional. Not used, but maintained to provide compatibility
	 *                                with the standard WordPress options API.
	 * @param string|bool $autoload   Optional. Whether to load the option when WordPress starts up.
	 *                                Default is enabled. Accepts 'no' to disable for legacy reasons.
	 *
	 * @return bool False if option was not added and true if option was added.
	 */
	function add_encrypted_option( $option, $value = '', $deprecated = '', $autoload = 'yes' ) {
		return add_option( $option, $value, $deprecated, $autoload );
	}
endif;

if ( ! function_exists( 'add_encrypted_site_option' ) ) :
	/**
	 * Add a new encrypted site option.
	 *
	 * @see add_site_option()
	 *
	 * @param string $option Name of option to add. Expected to not be SQL-escaped.
	 * @param mixed  $value  Option value, can be anything. Expected to not be SQL-escaped.
	 *
	 * @return bool False if the option was not added. True if the option was added.
	 */
	function add_encrypted_site_option( $option, $value ) {
		return add_site_option( $option, $value );
	}
endif;

if ( ! function_exists( 'get_encrypted_option' ) ) :
	/**
	 * Retrieves an encrypted option value based on an option name.
	 *
	 * @see get_option()
	 *
	 * @param string $option  Name of option to retrieve. Expected to not be SQL-escaped.
	 * @param mixed  $default Optional. Default value to return if the option does not exist.
	 *                        Default is false.
	 *
	 * @return mixed Value set for the option.
	 */
	function get_encrypted_option( $option, $default = '' ) {
		return get_option( $option, $default );
	}
endif;

if ( ! function_exists( 'get_encrypted_site_option' ) ) :
	/**
	 * Retrieve an encrypted option value for the current network based on name of option.
	 *
	 * @see get_site_option()
	 *
	 * @param string $option  Name of option to retrieve. Expected to not be SQL-escaped.
	 * @param mixed  $default Optional. Default value to return if the option does not exist.
	 *                        Default is false.
	 *
	 * @return mixed Value set for the option.
	 */
	function get_encrypted_site_option( $option, $default = '' ) {
		return get_site_option( $option, $default );
	}
endif;

if ( ! function_exists( 'update_encrypted_option' ) ) :
	/**
	 * Update the value of an encrypted option that was already added.
	 *
	 * @see update_option()
	 *
	 * @param string      $option   Name of option to add. Expected to not be SQL-escaped.
	 * @param mixed       $value    Optional. Option value. Must be serializable if non-scalar.
	 *                              Expected to not be SQL-escaped.
	 * @param string|bool $autoload Whether to load the option when WordPress starts up. For
	 *                              existing options, $autoload can only be updated using
	 *                              update_encrypted_option() if $value is also changed. Accepts
	 *                              'yes'|true to enable or 'no'|false to disable. For
	 *                              non-existent options, the default value is 'yes'.
	 *
	 * @return bool False if value was not updated and true if value was updated.
	 */
	function update_encrypted_option( $option, $value = '', $autoload = 'yes' ) {
		return update_option( $option, $value, $autoload );
	}
endif;

if ( ! function_exists( 'update_encrypted_site_option' ) ) :
	/**
	 * Update the value of an encrypted option that was already added for the current network.
	 *
	 * @see update_site_option()
	 *
	 * @param string $option Name of option to add. Expected to not be SQL-escaped.
	 * @param mixed  $value  Optional. Option value. Must be serializable if non-scalar.
	 *                       Expected to not be SQL-escaped.
	 *
	 * @return bool False if value was not updated. True if value was updated.
	 */
	function update_encrypted_site_option( $option, $value = '' ) {
		return update_site_option( $option, $value );
	}
endif;

if ( ! function_exists( 'delete_encrypted_option' ) ) :
	/**
	 * Removes option by name. Prevents removal of protected WordPress options.
	 *
	 * @see delete_option()
	 *
	 * @param string $option Name of option to remove. Expected to not be SQL-escaped.
	 *
	 * @return bool True, if option is successfully deleted. False on failure.
	 */
	function delete_encrypted_option( $option ) {
		return delete_option( $option );
	}
endif;

if ( ! function_exists( 'delete_encrypted_site_option' ) ) :
	/**
	 * Removes a option by name for the current network.
	 *
	 * @see delete_site_option()
	 *
	 * @param string $option Name of option to remove. Expected to not be SQL-escaped.
	 *
	 * @return bool True, if option is successfully deleted. False on failure.
	 */
	function delete_encrypted_site_option( $option ) {
		return delete_site_option( $option );
	}
endif;
