<?php
/**
 * Boxers and Swipers
 *
 * @package    Boxers and Swipers
 * @subpackage BoxersAndSwipersRegist registered in the database
/*
	Copyright (c) 2014- Katsushi Kawamori (email : dodesyoswift312@gmail.com)
	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License as published by
	the Free Software Foundation; version 2 of the License.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

$boxersandswipersregist = new BoxersAndSwipersRegist();

/** ==================================================
 * registered in the database
 */
class BoxersAndSwipersRegist {

	/** ==================================================
	 * Construct
	 *
	 * @since 3.05
	 */
	public function __construct() {

		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/** ==================================================
	 * Settings register
	 *
	 * @since 1.00
	 */
	public function register_settings() {

		/* Version 3.13 or later */
		global $wpdb;
		$exclude_meta_ids = $wpdb->get_results(
			"
			SELECT	post_id, meta_key
			FROM	{$wpdb->prefix}postmeta
			WHERE	meta_key = 'boxersandswipers_exclude'
			"
		);
		if ( ! empty( $exclude_meta_ids ) ) {
			foreach ( $exclude_meta_ids as $meta_obj ) {
				delete_post_meta( $meta_obj->post_id, $meta_obj->meta_key );
			}
		}

		$applytypes = $this->apply_type();
		$apply_tbl = array();
		if ( ! get_option( 'boxersandswipers_apply' ) ) {
			foreach ( $applytypes as $key => $value ) {
				$apply_tbl[ $key ]['pc'] = false;
				$apply_tbl[ $key ]['tb'] = false;
				$apply_tbl[ $key ]['sp'] = false;
			}
			unset( $applytypes[ $key ] );
			update_option( 'boxersandswipers_apply', $apply_tbl );
		}

		if ( ! get_option( 'boxersandswipers_effect' ) ) {
			$effect_tbl = array(
				'pc' => 'colorbox',
				'tb' => 'nivolightbox',
				'sp' => 'photoswipe',
			);
			update_option( 'boxersandswipers_effect', $effect_tbl );
		}

		if ( ! get_option( 'boxersandswipers_useragent' ) ) {
			$useragent_tbl = array(
				'tb' => 'iPad|^.*Android.*Nexus(((?:(?!Mobile))|(?:(\s(7|10).+))).)*$|Kindle|Silk.*Accelerated|Sony.*Tablet|Xperia Tablet|Sony Tablet S|SAMSUNG.*Tablet|Galaxy.*Tab|SC-01C|SC-01D|SC-01E|SC-02D',
				'sp' => 'iPhone|iPod|Android.*Mobile|BlackBerry|IEMobile',
			);
			update_option( 'boxersandswipers_useragent', $useragent_tbl );
		}

		if ( ! get_option( 'boxersandswipers_colorbox' ) ) {
			$colorbox_tbl = array(
				'rel' => 'boxersandswipers',
				'transition' => 'elastic',
				'speed' => 350,
				'title' => null,
				'scalePhotos' => 'true',
				'scrolling' => 'true',
				'opacity' => 0.85,
				'open' => null,
				'returnFocus' => 'true',
				'trapFocus' => 'true',
				'fastIframe' => 'true',
				'preloading' => 'true',
				'overlayClose' => 'true',
				'escKey' => 'true',
				'arrowKey' => 'true',
				'loop' => 'true',
				'fadeOut' => 300,
				'closeButton' => 'true',
				'current' => 'image {current} of {total}',
				'previous' => 'previous',
				'next' => 'next',
				'close' => 'close',
				'width' => null,
				'height' => null,
				'innerWidth' => null,
				'innerHeight' => null,
				'initialWidth' => 300,
				'initialHeight' => 100,
				'maxWidth' => null,
				'maxHeight' => null,
				'slideshow' => 'true',
				'slideshowSpeed' => 2500,
				'slideshowAuto' => null,
				'slideshowStart' => 'start slideshow',
				'slideshowStop' => 'stop slideshow',
				'fixed' => null,
				'top' => null,
				'bottom' => null,
				'left' => null,
				'right' => null,
				'reposition' => 'true',
				'retinaImage' => null,
			);
			update_option( 'boxersandswipers_colorbox', $colorbox_tbl );
		}

		if ( ! get_option( 'boxersandswipers_slimbox' ) ) {
			$slimbox_tbl = array(
				'loop' => null,
				'overlayOpacity' => 0.8,
				'overlayFadeDuration' => 400,
				'resizeDuration' => 400,
				'resizeEasing' => 'swing',
				'initialWidth' => 250,
				'initialHeight' => 250,
				'imageFadeDuration' => 400,
				'captionAnimationDuration' => 400,
				'counterText' => 'Image {x} of {y}',
				'closeKeys' => '[27, 88, 67]',
				'previousKeys' => '[37, 80]',
				'nextKeys' => '[39, 78]',
			);
			update_option( 'boxersandswipers_slimbox', $slimbox_tbl );
		}

		if ( ! get_option( 'boxersandswipers_nivolightbox' ) ) {
			$nivolightbox_tbl = array(
				'effect' => 'fade',
				'keyboardNav' => 'true',
				'clickOverlayToClose' => 'true',
			);
			update_option( 'boxersandswipers_nivolightbox', $nivolightbox_tbl );
		}

		if ( ! get_option( 'boxersandswipers_photoswipe' ) ) {
			$photoswipe_tbl = array(
				'bgOpacity' => 1,
				'captionArea' => 'true',
				'shareButton' => 'true',
				'fullScreenButton' => 'true',
				'zoomButton' => 'true',
				'preloaderButton' => 'true',
				'tapToClose' => null,
				'tapToToggleControls' => 'true',
				'animationDuration' => 333,
				'maxSpreadZoom' => 2,
				'history' => 'true',
			);
			update_option( 'boxersandswipers_photoswipe', $photoswipe_tbl );
		}
	}

	/** ==================================================
	 * Apply type.
	 *
	 * @since 3.00
	 */
	private function apply_type() {

		$plugin_name1 = 'YITH Infinite Scrolling';
		$plugin_name2 = 'Infinite All Images';
		$install_url1 = 'plugin-install.php?tab=plugin-information&plugin=yith-infinite-scrolling';
		$install_url2 = 'plugin-install.php?tab=plugin-information&plugin=infinite-all-images';

		if ( is_multisite() ) {
			$infinitescroll_install_url1 = esc_url( network_admin_url( $install_url1 ) );
			$infinitescroll_install_url2 = esc_url( network_admin_url( $install_url2 ) );
		} else {
			$infinitescroll_install_url1 = esc_url( admin_url( $install_url1 ) );
			$infinitescroll_install_url2 = esc_url( admin_url( $install_url2 ) );
		}
		$infinitescroll_install_html = '<a href="' . $infinitescroll_install_url1 . '" style="text-decoration: none; word-break: break-all;" title="' . __( 'Works with Infinite Scroll.', 'boxers-and-swipers' ) . '">' . $plugin_name1 . '</a>,<a href="' . $infinitescroll_install_url2 . '" style="text-decoration: none; word-break: break-all;" title="' . __( 'Works with Infinite Scroll.', 'boxers-and-swipers' ) . '">' . $plugin_name2 . '</a>';

		$applytypes['postthumbnails'] = __( 'Featured Images' );
		$applytypes['infinitescroll'] = $infinitescroll_install_html;

		return $applytypes;
	}
}
