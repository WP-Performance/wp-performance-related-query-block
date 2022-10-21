<?php

namespace WPPerfomance\RemoveLazy;

/**
 * Plugin Name:       Related Query Block
 * Description:       Remove current post in query block
 * Update URI:        wp-performance-related-query-block
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Version:           0.0.1
 * Author:            Faramaz Patrick <infos@goodmotion.fr>
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-performance-related-query-block
 *
 * @package           wp-performance
 */
require_once(dirname(__FILE__) . '/inc/parser.php');

// only front
if (!is_admin()) {
    // test with hook send_headers
    add_action('send_headers', 'WPPerfomance\inc\parser\parsing_start');
}
