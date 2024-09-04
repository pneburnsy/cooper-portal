<?php

/**
 * Class for "Local Fonts"
 * Thanks: https://github.com/WPTT/webfont-loader
 */

if (!defined('ABSPATH')) {
	exit;
} // Exit if accessed directly

if ( ! class_exists('Liquid_LocalFonts') ) {

	//include_once __DIR__ . '/wptt.php';

	class Liquid_LocalFonts extends Liquid_Base {

		public static $font_css;

		public function __construct() {

			$theme_option = get_option('liquid_one_opt');

			if ( isset( $theme_option['enable-hub-local-fonts'] ) && $theme_option['enable-hub-local-fonts'] === 'on' ) {
				$this->check_styles_folder();
				$this->init_hooks();
			}
		}

		private function init_hooks() {

			add_filter( 'style_loader_src', [ $this, 'check_google_fonts' ], 10, 3 );

		}

		function check_google_fonts( $src, $handle ) {

			// Check Google fonts
			if ( preg_match( '/\/\/fonts\.googleapis\.com\/css\?.*/', $src ) ) {

				$user_agent = 'Mozilla/5.0 (X11; Ubuntu; Linux x86_64; rv:73.0) Gecko/20100101 Firefox/73.0'; // Add user agent for get woff2 data
				$response = wp_remote_get( $src, array( 'user-agent' => $user_agent ) ); // Get css from Google

				if ( is_wp_error( $response ) ) {
					return '';
				}

				$contents = wp_remote_retrieve_body( $response ); // CSS output

				$this->put_font_files($contents);

				// Replace Google url insted of site url
				$regex = '~(url\()(https?://fonts.gstatic.com/)([^/]+/)([^/]+)/v\d+(/[^)]*)(\))~';
				$replacement = '${1}' . $this->get_font_url() . '${4}${5}${6}';
				$result = preg_replace($regex, $replacement, $contents);

				file_put_contents($this->set_file($handle . '.css'), $result);

				$src = $this->get_font_url() . $handle . '.css';

			}

			return $src;

		}

		public function get_remote_files_from_css( $font_css ) {

			$font_faces = explode( '@font-face', $font_css );

			$result = array();

			// Loop all our font-face declarations.
			foreach ( $font_faces as $font_face ) {

				// Make sure we only process styles inside this declaration.
				$style = explode( '}', $font_face )[0];

				// Sanity check.
				if ( false === strpos( $style, 'font-family' ) ) {
					continue;
				}

				// Get an array of our font-families.
				preg_match_all( '/font-family.*?\;/', $style, $matched_font_families );

				// Get an array of our font-files.
				preg_match_all( '/url\(.*?\)/i', $style, $matched_font_files );

				// Get the font-family name.
				$font_family = 'unknown';
				if ( isset( $matched_font_families[0] ) && isset( $matched_font_families[0][0] ) ) {
					$font_family = rtrim( ltrim( $matched_font_families[0][0], 'font-family:' ), ';' );
					$font_family = trim( str_replace( array( "'", ';' ), '', $font_family ) );
					$font_family = sanitize_key( strtolower( str_replace( ' ', '', $font_family ) ) );
				}

				// Make sure the font-family is set in our array.
				if ( ! isset( $result[ $font_family ] ) ) {
					$result[ $font_family ] = array();
				}

				// Get files for this font-family and add them to the array.
				foreach ( $matched_font_files as $match ) {

					// Sanity check.
					if ( ! isset( $match[0] ) ) {
						continue;
					}

					// Add the file URL.
					$font_family_url = rtrim( ltrim( $match[0], 'url(' ), ')' );
					$font_family_url = str_replace( '"', '', $font_family_url );

					// Make sure to convert relative URLs to absolute.
					$font_family_url = $this->get_absolute_path( $font_family_url );

					$result[ $font_family ][] = $font_family_url;
				}

				// Make sure we have unique items.
				// We're using array_flip here instead of array_unique for improved performance.
				$result[ $font_family ] = array_flip( array_flip( $result[ $font_family ] ) );
			}

			return $result;
		}

		protected function get_absolute_path( $url ) {

			// If dealing with a root-relative URL.
			if ( 0 === stripos( $url, '/' ) ) {
				$parsed_url = parse_url( $this->remote_url );
				return $parsed_url['scheme'] . '://' . $parsed_url['hostname'] . $url;
			}

			return $url;
		}

		protected function put_font_files( $font_css ) {

			$fontArray = $this->get_remote_files_from_css( $font_css );
			// Loop through the font array
			foreach ($fontArray as $fontName => $fontFiles) {

				wp_mkdir_p( $this->get_font_dir() . $fontName );

				// Loop through each file in the current font
				foreach ($fontFiles as $fileNumber => $fileUrl) {

					preg_match('/[^\/]+\.woff2$/', $fileUrl, $matches);
					$filename = $matches[0];

					// Check if file exists
					if ( ! file_exists( $this->set_file( $fontName . '/' . $filename ) ) ) {
						// Use file_get_contents() to retrieve the file contents from the URL
						$fileContents = file_get_contents($fileUrl);
						// Use file_put_contents() to print from the retrieved contents
						file_put_contents($this->set_file( $fontName . '/' . $filename ), $fileContents);
					}

				}
			}

		}

		function check_styles_folder() {
            $uploads = wp_upload_dir();
            $styles_folder = $uploads['basedir'] . DIRECTORY_SEPARATOR . 'liquid-local-fonts/';
            if ( !file_exists( $styles_folder ) ) {
                wp_mkdir_p( $styles_folder );
            }
        }
		
		function set_file( $filename ) {
            $uploads = wp_upload_dir();
            $styles_folder = $uploads['basedir'] . DIRECTORY_SEPARATOR . 'liquid-local-fonts/' . $filename;
			return $styles_folder;
        }
		
		function get_font_dir() {
            $uploads = wp_upload_dir();
            $styles_folder = $uploads['basedir'] . DIRECTORY_SEPARATOR . 'liquid-local-fonts/';
			return $styles_folder;
        }
		
		function get_font_url() {
            $uploads = wp_upload_dir();
            $styles_folder = $uploads['baseurl'] . DIRECTORY_SEPARATOR . 'liquid-local-fonts/';
			return $styles_folder;
        }

	}

	new Liquid_LocalFonts();

}
