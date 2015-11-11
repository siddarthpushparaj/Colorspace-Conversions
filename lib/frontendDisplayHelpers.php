<?php

/**
 * Frontend Display Helpers (frontendDisplayHelpers.php) (c) by Jack Szwergold
 *
 * Frontend Display Helpers is licensed under a
 * Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 *
 * You should have received a copy of the license along with this
 * work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>.
 *
 * w: http://www.preworn.com
 * e: me@preworn.com
 *
 * Created: 2015-11-10, js
 * Version: 2015-11-10, js: creation
 *          2015-11-10, js: development
 *
 */

//**************************************************************************************//
// Require the basic configuration settings & functions.

require_once BASE_FILEPATH . '/lib/colorspace_conversions.class.php';
require_once BASE_FILEPATH . '/lib/colorspace_helpers.class.php';
require_once BASE_FILEPATH . '/lib/colorspace_display.class.php';

//**************************************************************************************//
// Set the mode.

$mode = 'large';

//**************************************************************************************//
// Get the URL param & set the markdown file as well as the page title.

// Init the arrays.
$url_parts = array();
$markdown_parts = array();
$title_parts = array($SITE_TITLE);

// Parse the '$_GET' parameters.
foreach($VALID_GET_PARAMETERS as $get_parameter) {
  $$get_parameter = '';
  if (array_key_exists($get_parameter, $_GET) && !empty($_GET[$get_parameter])) {
    if (in_array($get_parameter, $VALID_GET_PARAMETERS)) {
      $$get_parameter = $_GET[$get_parameter];
    }
  }
}

// Set the controller.
if (!empty($colorspace)) {
  $url_parts[] = $colorspace;
  $title_parts[] = strtoupper($colorspace);
}

// Set the page.
if (!empty($colorspace) && !empty($value)) {
  $url_parts[] = $value;
  $title_parts[] = $value;
}

// Set the page title.
$page_title = join(' / ', $title_parts);
$page_title = ucwords(preg_replace('/_/', ' ', $page_title));

//**************************************************************************************//
// Init the display class and get the values.

$DisplayClass = new Display();
$DisplayClass->show_rgb_grid = true;
// $DisplayClass->show_cmyk_grid = true;
$DisplayClass->show_pms_grid = true;
$body = $DisplayClass->init($colorspace, $value);

?>