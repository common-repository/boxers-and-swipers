<?php
/**
 * Plugin Name: Boxers and Swipers
 * Plugin URI:  https://wordpress.org/plugins/boxers-and-swipers/
 * Description: Integrates Colorbox, Slimbox, Nivo Lightbox, Image Lightbox, Photoswipe and Swipebox into WordPress.
 * Version:     4.02
 * Author:      Katsushi Kawamori
 * Author URI:  https://riverforest-wp.info/
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: boxers-and-swipers
 *
 * @package Boxers and Swipers
 */

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

if ( ! class_exists( 'BoxersAndSwipersRegist' ) ) {
	require_once __DIR__ . '/lib/class-boxersandswipersregist.php';
}
if ( ! class_exists( 'BoxersAndSwipersAdmin' ) ) {
	require_once __DIR__ . '/lib/class-boxersandswipersadmin.php';
}
if ( ! class_exists( 'BoxersAndSwipers' ) ) {
	require_once __DIR__ . '/lib/class-boxersandswipers.php';
}
