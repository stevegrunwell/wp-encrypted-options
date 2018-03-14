<?php
/**
 * Tests for the Encryption class.
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

namespace WPEncryptedOptions\Tests;

use Defuse\Crypto\Key;
use ReflectionProperty;
use WPEncryptedOptions\Encryption as Encryption;
use WPEncryptedOptions\Exceptions\EncryptedOptionException;

/**
 * Encryption tests.
 */
class EncryptionTest extends TestCase {

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
		$encrypted  = $encryption->encrypt( $value );

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
			'A complex array' => [
				[
					'foo' => uniqid(),
					'bar' => [
						'baz' => 'val',
					],
				],
			],
		];
	}

	public function test_decrypt_if_the_key_has_changed() {
		$encryption = Encryption::get_instance();
		$encrypted  = $encryption->encrypt( 'some data' );
		$property   = new ReflectionProperty( $encryption, 'encryption_key' );
		$property->setAccessible( true );
		$property->setValue( $encryption, Key::createNewRandomKey() );

		$this->expectException( EncryptedOptionException::class );

		$encryption->decrypt( $encrypted );
	}
}
