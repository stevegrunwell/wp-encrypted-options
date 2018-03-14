<?php
/**
 * Base test case for the core test suite.
 *
 * @package SteveGrunwell\WPEncryptedOptions
 */

namespace WPEncryptedOptions\Tests;

use ReflectionProperty;
use WP_UnitTestCase;
use WPEncryptedOptions\Encryption;

/**
 * Base test case for all package tests.
 */
class TestCase extends WP_UnitTestCase {

	/**
	 * Since the Encryption class is a Singleton, explicitly tear it down after each test.
	 *
	 * @after
	 */
	public function reset_encryption_instance() {
		$property = new ReflectionProperty( Encryption::class, 'instance' );
		$property->setAccessible( true );
		$property->setValue( null );
	}
}
