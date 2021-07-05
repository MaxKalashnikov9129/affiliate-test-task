<?php
/**
 * Helper functions
 *
 * @package Beetroot
 */

if ( ! function_exists( 'studly_case' ) ) {
	/**
	 * Convert a value to studly caps case.
	 *
	 * @param  string $value string
	 *
	 * @return string
	 */
	function studly_case( $value ) {
		$value = ucwords( str_replace( [ '-', '_' ], ' ', $value ) );

		return str_replace( ' ', '', $value );
	}
}

if ( ! function_exists( 'camel_case' ) ) {
	/**
	 * Convert a value to camel case.
	 *
	 * @param string $value value
	 *
	 * @return string
	 */
	function camel_case( $value ) {
		return lcfirst( studly_case( $value ) );
	}
}

if ( ! function_exists( 'snake_case' ) ) {
	/**
	 * Convert a string to snake case.
	 *
	 * @param  string $value string
	 * @param  string $delimiter delimiter
	 * @return string
	 */
	function snake_case( $value, $delimiter = '_' ) {
		static $snake_cache = [];
		$key                = $value . $delimiter;

		if ( isset( $snake_cache[ $key ] ) ) {
			return $snake_cache[ $key ];
		}

		if ( ! ctype_lower( $value ) ) {
			$value = strtolower( preg_replace( '/(.)(?=[A-Z])/', '$1' . $delimiter, $value ) );
		}

		// phpcs:ignore
		return $snake_cache[ $key ] = $value;
	}
}

if ( ! function_exists( 'metakey_case' ) ) {
	/**
	 * Convert a string to format which acceptable for meta key name.
	 *
	 * @param string $value string
	 *
	 * @return string
	 */
	function metakey_case( $value ) {
		return strtolower( str_replace( ' ', '_', trim( $value ) ) );
	}
}

if ( ! function_exists( 'kebab_case' ) ) {
	/**
	 * Convert a string to kebab case.
	 *
	 * @param string $value string
	 *
	 * @return string
	 */
	function kebab_case( $value ) {
		return strtolower( str_replace( ' ', '-', trim( $value ) ) );
	}
}

if ( ! function_exists( 'is_closure' ) ) {
	/**
	 * Determine whether the callback is a closure.
	 *
	 * @param mixed $callback callback
	 *
	 * @return bool
	 */
	function is_closure( $callback ) {
		return is_object( $callback ) && ( $callback instanceof Closure );
	}
}

if ( ! function_exists( 'array_get' ) ) {
	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param  array  $array array to get
	 * @param  string $key key
	 * @param  mixed  $default default
	 * @return mixed
	 */
	function array_get( $array, $key, $default = null ) {
		if ( is_null( $key ) ) { return $array;
		}

		if ( isset( $array[ $key ] ) ) { return $array[ $key ];
		}

		foreach ( explode( '.', $key ) as $segment ) {
			if ( ! is_array( $array ) || ! array_key_exists( $segment, $array ) ) {
				return value( $default );
			}

			$array = $array[ $segment ];
		}

		return $array;
	}
}

if ( ! function_exists( 'array_only' ) ) {
	/**
	 * Get a subset of the items from the given array.
	 *
	 * @param  array        $array array
	 * @param  array|string $keys keys
	 * @return array
	 */
	function array_only( $array, $keys ) {
		return array_intersect_key( $array, array_flip( (array) $keys ) );
	}
}

if ( ! function_exists( 'array_except' ) ) {
	/**
	 * Get all of the given array except for a specified array of items.
	 *
	 * @param  array        $array array
	 * @param  array|string $keys keys
	 * @return array
	 */
	function array_except( $array, $keys ) {
		return array_diff_key( $array, array_flip( (array) $keys ) );
	}
}

if ( ! function_exists( 'array_pull' ) ) {
	/**
	 * Get a value from the array, and remove it.
	 *
	 * @param  array  $array array
	 * @param  string $key key
	 * @param  mixed  $default default
	 * @return mixed
	 */
	function array_pull( &$array, $key, $default = null ) {
		$value = get( $array, $key, $default );
		forget( $array, $key );
		return $value;
	}
}

if ( ! function_exists( 'get' ) ) {
	/**
	 * Get an item from an array using "dot" notation.
	 *
	 * @param  array  $array array
	 * @param  string $key key
	 * @param  mixed  $default default
	 * @return mixed
	 */
	function get( $array, $key, $default = null ) {
		if ( is_null( $key ) ) { return $array;
		}
		if ( isset( $array[ $key ] ) ) { return $array[ $key ];
		}
		foreach ( explode( '.', $key ) as $segment ) {
			if ( ! is_array( $array ) || ! array_key_exists( $segment, $array ) ) {
				return value( $default );
			}
			$array = $array[ $segment ];
		}
		return $array;
	}
}

if ( ! function_exists( 'forget' ) ) {
	/**
	 * Remove one or many array items from a given array using "dot" notation.
	 *
	 * @param  array        $array array
	 * @param  array|string $keys keys
	 * @return void
	 */
	function forget( &$array, $keys ) {
		$original =& $array;
		foreach ( (array) $keys as $key ) {
			$parts       = explode( '.', $key );
			$count_parts = count( $parts );
			while ( $count_parts > 1 ) {
				$part = array_shift( $parts );
				if ( isset( $array[ $part ] ) && is_array( $array[ $part ] ) ) {
					$array =& $array[ $part ];
				}
			}
			unset( $array[ array_shift( $parts ) ] );
			// clean up after each pass
			$array =& $original;
		}
	}
}

if ( ! function_exists( 'value' ) ) {
	/**
	 * Return the default value of the given value.
	 *
	 * @param  mixed $value variable
	 * @return mixed
	 */
	function value( $value ) {
		return $value instanceof Closure ? $value() : $value;
	}
}

if ( ! function_exists( 'd' ) ) {
	/**
	 * Dump the passed variables.
	 *
	 * @param  mixed ...$args variables
	 * @return void
	 */
	function d( ...$args ) {
		var_dump( ...$args ); // phpcs:ignore
	}
}

if ( ! function_exists( 'dd' ) ) {
	/**
	 * Dump the passed variables and end the script.
	 *
	 * @param  mixed ...$args variables
	 * @return void
	 */
	function dd( ...$args ) {
		d( ...$args );
		exit();
	}
}

if ( ! function_exists( 'asset_path' ) ) {
	/**
	 * Locate asset_path with hash
	 *
	 * @param string $asset path to asset
	 * @return string output path
	 */
	function asset_path( $asset ) {
		if ( file_exists( ( get_template_directory() . '/dist/assets.json' ) ) ) {
			$json = json_decode( file_get_contents( get_template_directory() . '/dist/assets.json' ), true );
			return get_template_directory_uri() . '/dist/' . array_get( $json, $asset );
		} else {
			return get_template_directory_uri() . '/dist/' . $asset;
		}

	}
}
