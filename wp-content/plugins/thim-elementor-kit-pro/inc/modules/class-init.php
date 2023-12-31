<?php
namespace Thim_EL_Kit_Pro\Modules;

use Thim_EL_Kit_Pro\SingletonTrait;

class Init {
	use SingletonTrait;

	public function __construct() {
		$this->includes();
	}

	public function includes() {
		include_once ABSPATH . 'wp-admin/includes/plugin.php';

		if ( is_plugin_active( 'learnpress/learnpress.php' ) ) {
			require_once THIM_EKIT_PRO_PLUGIN_PATH . 'inc/modules/archive-course/class-init.php';
			require_once THIM_EKIT_PRO_PLUGIN_PATH . 'inc/modules/archive-course/class-rest-api.php';
			require_once THIM_EKIT_PRO_PLUGIN_PATH . 'inc/modules/single-course/class-init.php';
		}
	}
}

Init::instance();
