<?php
namespace Thim_EL_Kit_Pro\Modules\ArchiveCourse;

use Thim_EL_Kit\Modules\Modules;
use Thim_EL_Kit_Pro\SingletonTrait;

class Init extends Modules {
	use SingletonTrait;

	public function __construct() {
		$this->tab      = 'archive-course';
		$this->tab_name = esc_html__( 'Archive Course', 'thim-elementor-kit-pro' );
		$this->option   = 'thim_ekits_archive_course';

		parent::__construct();

		add_action( 'pre_get_posts', array( $this, 'pre_get_posts' ), 11 ); // after LearnPress
	}

	public function template_include( $template ) {
		$this->template_include = LP_PAGE_COURSES === \LP_Page_Controller::page_current();

		return parent::template_include( $template );
	}

	/**
	 * Override query args ( in LearnPress use ajax in archive course page ).
	 *
	 * @param $query \WP_Query
	 */
	public function pre_get_posts( \WP_Query $q ) : \WP_Query {
		$post_id           = get_option( $this->option, false );
		$is_archive_course = learn_press_is_courses() || learn_press_is_course_tag() || learn_press_is_course_category() || learn_press_is_search() || learn_press_is_course_tax();

		if ( $is_archive_course && ! empty( $post_id ) && ! $this->is_editor_preview() && ! is_admin() ) {
			$limit = \LP_Settings::get_option( 'archive_course_limit', 6 );
			$q->set( 'posts_per_page', $limit );
		}

		return $q;
	}
}

Init::instance();
