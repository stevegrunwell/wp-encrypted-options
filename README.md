# WP Encrypted Options

[![Build Status](https://travis-ci.org/stevegrunwell/wp-encrypted-options.svg?branch=develop)](https://travis-ci.org/stevegrunwell/wp-encrypted-options)
[![Coverage Status](https://coveralls.io/repos/github/stevegrunwell/wp-encrypted-options/badge.svg?branch=develop)](https://coveralls.io/github/stevegrunwell/wp-encrypted-options?branch=develop)
[![GitHub release](https://img.shields.io/github/release/stevegrunwell/wp-encrypted-options.svg)](https://github.com/stevegrunwell/wp-encrypted-options/releases)

WP Encrypted Options exposes a simple API for storing encrypted data in the `wp_options` table.

Under the hood, options are being encrypted and decrypted via [the `defuse/php-encryption` Composer package](https://github.com/defuse/php-encryption), written by [Taylor Hornby](https://defuse.ca/) and [Scott Arciszewski](https://paragonie.com/blog/author/scott-arcizewski).

## Installation

The best way to install this package is [via Composer](https://getcomposer.org/):

```sh
$ composer require stevegrunwell/wp-encrypted-options
```

If you're already using Composer's autoloader, the functions defined by WP Encrypted Options ([see "Usage"](#usage)) will be available immediately. If not, it will be necessary to manually include the files from the package (or install it as a WordPress plugin).

> **Note:** Before this package gets a 1.0.0 release, it will be refactored to be easily included _without conflict_ in any number of packages as [a WordPress "micro-library"](https://stevegrunwell.com/blog/micro-libraries-wordpress/) ([#2](https://github.com/stevegrunwell/wp-encrypted-options/issues/2)).

Next, you'll need to generate a random, 136-byte hexadecimal string, which will serve as your encryption key, which will be saved to your site's `wp-config.php` file:

```php
/**
 * WP Encrypted Options.
 */
define( 'WP_ENCRYPTED_OPTIONS_KEY', '...' );
```

## Usage

WP Encrypted Options define the following functions, each of which have been designed to operate like their corresponding WordPress core functions:

WP Encrypted Options function    | Corresponding WordPress function
-------------------------------- | --------------------------------
`add_encrypted_option()`         | [`add_option()`](https://developer.wordpress.org/reference/functions/add_option/)
`get_encrypted_option()`         | [`get_option()`](https://developer.wordpress.org/reference/functions/get_option/)
`update_encrypted_option()`      | [`update_option()`](https://developer.wordpress.org/reference/functions/update_option/)
`delete_encrypted_option()`      | [`delete_option()`](https://developer.wordpress.org/reference/functions/delete_option/)
`add_encrypted_site_option()`    | [`add_site_option()`](https://developer.wordpress.org/reference/functions/add_site_option/)
`get_encrypted_site_option()`    | [`get_site_option()`](https://developer.wordpress.org/reference/functions/get_site_option/)
`update_encrypted_site_option()` | [`update_site_option()`](https://developer.wordpress.org/reference/functions/update_site_option/)
`delete_encrypted_site_option()` | [`delete_site_option()`](https://developer.wordpress.org/reference/functions/delete_site_option/)

The arguments and usage for these functions is exactly the same as their core counterparts, with the added bonus of encrypting (or decrypting, as the case might be) as the value is written to or retrieved from WordPress.

### Example

A good example usage would be a plugin holding API keys: when storing the API key, use `add_encrypted_option()` instead of `add_option()` to store the data securely in the database:

```php
add_encrypted_option( 'myplugin-api-key', $some_api_key );
```

To retrieve encrypted options, use `get_encrypted_option()` (instead of `get_option()`) to automatically decrypt the retrieved data:

```php
get_encrypted_option( 'myplugin-api-key', $default );
```

## License

Copyright 2018 Steve Grunwell

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
