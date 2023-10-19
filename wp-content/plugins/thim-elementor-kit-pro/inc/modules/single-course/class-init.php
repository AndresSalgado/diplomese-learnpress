<?php
namespace Thim_EL_Kit_Pro\Modules\SingleCourse;

use Thim_EL_Kit\Modules\Modules;
use Thim_EL_Kit_Pro\SingletonTrait;

class Init extends Modules {
	use SingletonTrait;

	public function __construct() {
		$this->tab      = 'single-course';
		$this->tab_name = esc_html__( 'Single Course', 'thim-elementor-kit-pro' );
		$this->option   = 'thim_ekits_single_course';

		parent::__construct();

		add_action( 'thim-ekit/modules/single-course/before-preview-query', array( $this, 'before_preview_query' ) );
		add_action( 'thim-ekit/modules/single-course/after-preview-query', array( $this, 'after_preview_query' ) );
	}

	public function template_include( $template ) {
		$this->template_include = is_singular( 'lp_course' ) && ! \LP_Global::course_item();

		return parent::template_include( $template );
	}

	public function get_preview_id() {
		global $post;

		$output = false;

		if ( $post ) {
			$document = \Elementor\Plugin::$instance->documents->get( $post->ID );

			if ( $document ) {
				$preview_id = $document->get_settings( 'thim_ekits_preview_id' );

				$output = ! empty( $preview_id ) ? absint( $preview_id ) : false;
			}
		}

		return $output;
	}

	public function before_preview_query() {
		if ( $this->is_editor_preview() || $this->is_modules_view() ) {
			$this->after_preview_query();
			$preview_id = $this->get_preview_id();

			if ( $preview_id ) {
				$query = array(
					'p'         => absint( $preview_id ),
					'post_type' => 'lp_course',
				);
			} else {
				$query_vars = array(
					'post_type'      => 'lp_course',
					'posts_per_page' => 1,
				);

				$posts = get_posts( $query_vars );

				if ( ! empty( $posts ) ) {
					$query = array(
						'p'         => $posts[0]->ID,
						'post_type' => 'lp_course',
					);
				}
			}

			if ( ! empty( $query ) ) {
				\Elementor\Plugin::instance()->db->switch_to_query( $query, true );
			}
		}
	}

	public function after_preview_query() {
		if ( $this->is_editor_preview() || $this->is_modules_view() ) {
			\Elementor\Plugin::instance()->db->restore_current_query();
		}
	}
}

Init::instance();
