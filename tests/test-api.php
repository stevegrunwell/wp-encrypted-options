<?php
/**
 * Tests for the public API.
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

/**
 * Public API tests.
 */
class ApiTest extends WP_UnitTestCase {

	public function test_add_encrypted_option() {
		$value = uniqid();

		$this->assertTrue( add_encrypted_option( 'option-name', $value ) );
		$this->assertNotEquals(
			$value,
			get_option( 'option-name' ),
			'The encrypted and unencrypted values should not match.'
		);
	}

	public function test_add_encrypted_site_option() {
		$value = uniqid();

		$this->assertTrue( add_encrypted_site_option( 'option-name', $value ) );
		$this->assertNotEquals(
			$value,
			get_site_option( 'option-name' ),
			'The encrypted and unencrypted values should not match.'
		);
	}

	public function test_get_encrypted_option() {
		$value = uniqid();
		add_encrypted_option( 'option-name', $value );

		$this->assertEquals( $value, get_encrypted_option( 'option-name' ) );
	}

	public function test_get_encrypted_option_handles_defaults() {
		$value = uniqid();
		delete_encrypted_option( 'option-name' );

		$this->assertEquals( $value, get_encrypted_option( 'option-name', $value ) );
	}

	public function test_get_encrypted_site_option() {
		$value = uniqid();
		add_encrypted_site_option( 'option-name', $value );

		$this->assertEquals( $value, get_encrypted_site_option( 'option-name' ) );
	}

	public function test_get_encrypted_site_option_handles_defaults() {
		$value = uniqid();
		delete_encrypted_site_option( 'option-name' );

		$this->assertEquals( $value, get_encrypted_site_option( 'option-name', $value ) );
	}

	public function test_update_encrypted_option() {
		$value = uniqid();
		add_encrypted_site_option( 'option-name', $value );
		$original = get_option( 'option-name' );

		$this->assertTrue( update_encrypted_option( 'option-name', $value . '-updated' ) );
		$this->assertNotEquals(
			$original,
			get_option( 'option-name' ),
			'The encrypted and unencrypted values should not match.'
		);
	}

	public function test_update_encrypted_site_option() {
		$value = uniqid();
		add_encrypted_site_option( 'option-name', $value );
		$original = get_option( 'option-name' );

		$this->assertTrue( update_encrypted_site_option( 'option-name', $value . '-updated' ) );
		$this->assertNotEquals(
			$original,
			get_site_option( 'option-name' ),
			'The encrypted and unencrypted values should not match.'
		);
	}

	public function test_delete_encrypted_option() {
		add_encrypted_option( 'option-name', uniqid() );

		$this->assertTrue( delete_encrypted_option( 'option-name' ) );
		$this->assertFalse( get_encrypted_option( 'option-name', false ) );
	}

	public function test_delete_encrypted_site_option() {
		add_encrypted_site_option( 'option-name', uniqid() );

		$this->assertTrue( delete_encrypted_site_option( 'option-name' ) );
		$this->assertFalse( get_encrypted_site_option( 'option-name', false ) );
	}
}
