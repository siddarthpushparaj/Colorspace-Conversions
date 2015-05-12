<?php

/**
 * Index Controller (index.php) (c) by Jack Szwergold
 *
 * Index Controller is licensed under a
 * Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.
 *
 * You should have received a copy of the license along with this
 * work. If not, see <http://creativecommons.org/licenses/by-nc-sa/4.0/>.
 *
 * w: http://www.preworn.com
 * e: me@preworn.com
 *
 * Created: 2015-04-29, js
 * Version: 2015-04-29, js: creation
 *          2015-04-29, js: development & cleanup
 *          2015-04-30, js: development & cleanup
 *          2015-05-03, js: setting more configuration and structure stuff
 *          2015-05-10, js: adding DIV wrapper class & id
 *          2015-05-11, js: setting dynamic DIV wrapper creation
 *
 */

//**************************************************************************************//
// Require the basic classes & functions.

require_once 'conf/conf.inc.php';
require_once 'common/functions.inc.php';
require_once 'lib/frontendDisplay.class.php';
require_once 'lib/colorspace_conversions.class.php';
require_once 'lib/colorspace_helpers.class.php';
require_once 'lib/colorspace_display.class.php';

//**************************************************************************************//
// Set config options.

$DEBUG_OUTPUT_JSON = false;

//**************************************************************************************//
// Set the mode.

$mode = 'large';

//**************************************************************************************//
// Get the URL param & set the markdown file as well as the page title.

// Init the arrays.
$url_parts = array();
$markdown_parts = array();
$title_parts = array('Colorspace Conversions');

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

// Set the page base.
$page_base = BASE_URL;

//**************************************************************************************//
// Set the page DIVs array.

$page_divs_array = array();
$page_divs_array[] = 'Wrapper';
$page_divs_array[] = 'Padding';
$page_divs_array[] = 'Content';
$page_divs_array[] = 'Padding';
$page_divs_array[] = 'Section';
$page_divs_array[] = 'Padding';
$page_divs_array[] = 'Middle';
$page_divs_array[] = 'Core';
$page_divs_array[] = 'Padding';

//**************************************************************************************//
// Init the display class and get the values.

$DisplayClass = new Display();
$DisplayClass->show_rgb_grid = true;
// $DisplayClass->show_cmyk_grid = true;
$DisplayClass->show_pms_grid = true;
$body = $DisplayClass->init($colorspace, $value);

//**************************************************************************************//
// Init the "frontendDisplay()" class.

$frontendDisplayClass = new frontendDisplay('text/html', 'utf-8', FALSE, FALSE);
$frontendDisplayClass->setViewMode($mode);
$frontendDisplayClass->setPageTitle($page_title);
$frontendDisplayClass->setPageURL('http://www.preworn.com/colorspace/' . implode($url_parts, '/'));
$frontendDisplayClass->setPageCopyright('(c) Copyright ' . date('Y') . ' Jack Szwergold. Creative Commons Attribution-NonCommercial-ShareAlike 4.0 International License.');
$frontendDisplayClass->setPageDescription('Some PHP classes to handle colorspace conversions.');
$frontendDisplayClass->setPageContent($body);
$frontendDisplayClass->setPageDivs($page_divs_array);
$frontendDisplayClass->setPageDivWrapper('PixelBoxWrapper');
$frontendDisplayClass->setPageRobots('noindex, nofollow');
$frontendDisplayClass->setPageBase($page_base);
$frontendDisplayClass->initContent();

?>