<?php
/**
 * Tests for the Encryption class.
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

use WPEncryptedOptions\Encryption as Encryption;

/**
 * Encryption tests.
 */
class EncryptionTest extends WP_UnitTestCase {

	/**
	 * @dataProvider value_provider()
	 */
	public function test_encrypt( $value ) {
		$encrypted = Encryption::get_instance()->encrypt( $value );

		$this->assertInternalType( 'string', $encrypted );
		$this->assertNotEquals( $value, $encrypted );
	}

	/**
	 * @dataProvider value_provider()
	 */
	public function test_decrypt( $value ) {
		$encryption = Encryption::get_instance();
		$encrypted = $encryption->encrypt( $value );

		$this->assertSame(
			$value,
			$encryption->decrypt( $encrypted ),
			'Expected the decrypted value to match the originally-encrypted value.'
		);
	}

	/**
	 * Provide values of different types to be encrypted and decrypted.
	 *
	 * @return array
	 */
	public function value_provider() {
		return [
			'A simple string' => [ 'WP Encrypted Options' ],
			'An integer'      => [ 123 ],
			'A float value'   => [ 123.456 ],
			'An simple array' => [ [ 'foo', 'bar', 'baz' ] ],
			'A complex array' => [ [ 'foo' => uniqid(), 'bar' => [ 'baz' => 'val' ] ] ],
		];
	}
}
