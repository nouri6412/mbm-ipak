<?php

/**
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://mbmti.ir
 * @since             1.0.0
 * @package           MBM_IPAK
 *
 * @wordpress-plugin
 * Plugin Name:       MBM Ipak
 * Plugin URI:        https://mbmti.ir
 * Description:       سیستم حسابداری ایپک
 * Version:           1.0.0
 * Author:            ایپک
 * Author URI:        https://mbmti.ir
 * Text Domain:       mbm-ipak
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) die;

/* General Definition
******************************/
define('MBM_IPAK_VERSION', '1.0.0');

define('MBM_IPAK_BASE', plugin_dir_path(__FILE__));
define('MBM_IPAK_URI', plugin_dir_url(__FILE__));
define('MBM_IPAK_FILE', __FILE__);
define('MBM_IPAK_Include', MBM_IPAK_BASE . 'include/');
define('MBM_IPAK_View', MBM_IPAK_BASE . 'view/');
$ViewData = [];

require MBM_IPAK_Include . 'sql_scripts.php';
require MBM_IPAK_Include . 'model.php';
require MBM_IPAK_Include . 'models.php';
require MBM_IPAK_Include . 'base_class.php';
require MBM_IPAK_Include . 'entity.php';
require MBM_IPAK_Include . 'shared.php';
require MBM_IPAK_Include . 'ajax.php';
require MBM_IPAK_Include . 'core.php';


$MBM_Ipak_Core = new MBM_Ipak_Core();
