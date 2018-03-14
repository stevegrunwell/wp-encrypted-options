<?php
/**
 * Encryption API for WP Encrypted Options.
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

namespace WPEncryptedOptions;

use Defuse\Crypto\Crypto;
use Defuse\Crypto\Exception\EnvironmentIsBrokenException;
use Defuse\Crypto\Exception\WrongKeyOrModifiedCiphertextException;
use Defuse\Crypto\Key;
use WPEncryptedOptions\Exceptions\EncryptedOptionException;

class Encryption {

	/**
	 * The encryption key for this site.
	 *
	 * @var Key
	 */
	protected $encryption_key;

	/**
	 * Contains the single instance of this object.
	 *
	 * @var self
	 */
	protected static $instance;

	/**
	 * Prevent the object from being cloned.
	 */
	public function __clone() {}

	/**
	 * Avoid new instances from being created via serialization.
	 */
	public function __wakeup() {}

	/**
	 * Prevent new instances of the class from being constructed.
	 */
	protected function __construct() {}

	/**
	 * Retrieve the Singleton instance or instantiate if it doesn't yet exist.
	 *
	 * @return self
	 */
	public static function get_instance() {
		if ( ! self::$instance ) {
			$class          = __CLASS__;
			self::$instance = new $class();
		}

		return self::$instance;
	}

	/**
	 * Encrypt a value.
	 *
	 * @param string $value The value to be encrypted.
	 *
	 * @return string The encrypted data string.
	 */
	public function encrypt( $value ) {
		try {
			$encrypted = Crypto::encrypt( serialize( $value ), $this->get_encryption_key() );
		} catch ( EnvironmentIsBrokenException $e ) {
			throw $e;
		}

		return $encrypted;
	}

	/**
	 * Decrypt a value.
	 *
	 * @param string $encrypted The encrypted version of the data.
	 *
	 * @return mixed The decrypted version of the data.
	 */
	public function decrypt( $encrypted ) {
		try {
			$decrypted = Crypto::decrypt( $encrypted, $this->get_encryption_key() );
		} catch ( EnvironmentIsBrokenException $e ) {
			throw $e;
		} catch ( WrongKeyOrModifiedCiphertextException $e ) {
			throw new EncryptedOptionException(
				__( 'Unable to decrypt option value.', 'wp-encrypted-options' ),
				$e->getCode(),
				$e
			);
		}

		return unserialize( $decrypted );
	}

	/**
	 * Get the encryption key for this site.
	 *
	 * @return Key The site's encryption key.
	 */
	protected function get_encryption_key() {
		if ( $this->encryption_key instanceof Key ) {
			return $this->encryption_key;
		}

		$this->encryption_key = Key::loadFromAsciiSafeString( WP_ENCRYPTED_OPTIONS_KEY );

		return $this->encryption_key;
	}
}
