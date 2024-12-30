<?php
/**
 * Class for displaying welcome notice and CTA button for installing and activating theme's toolkit.
 *
 * @since 1.0.0
 *
 * @package Theme_Notice
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Orchid_Store_Theme_Welcome_Notice' ) ) {
	/**
	 * Class - Theme Notice.
	 *
	 * Displays welcome notice and CTA button for installing and activating theme's toolkit.
	 *
	 * @since 1.0.0
	 */
	class Orchid_Store_Theme_Welcome_Notice {

		/**
		 * Theme name.
		 *
		 * @var string $theme_name Theme name.
		 */
		private $theme_name;

		/**
		 * Theme's dashboard page slug.
		 *
		 * @var string $dashboard_page_slug Theme's dashboard page slug.
		 */
		private $dashboard_page_slug;

		/**
		 * Required plugins.
		 *
		 * @var array $required_plugins Required plugins.
		 */
		private $required_plugins;

		/**
		 * Option id to set notice dismissed event.
		 *
		 * @var string $notice_dismissed_option_id Option id to set notice dismissed event.
		 */
		private $notice_dismissed_option_id;

		/**
		 * Initializes class properties and hook functions to actions.
		 *
		 * @since 1.0.0
		 *
		 * @param string $theme_name Theme name.
		 * @param string $dashboard_page_slug Theme's dashboard page slug.
		 * @param array  $required_plugins Required plugins.
		 */
		public function __construct( $theme_name, $dashboard_page_slug = '', $required_plugins = array() ) {

			global $pagenow;

			$this->theme_name          = $theme_name;
			$this->dashboard_page_slug = $dashboard_page_slug;
			$this->required_plugins    = $required_plugins;

			if ( 'themes.php' === $pagenow || 'admin-ajax.php' === $pagenow ) {

				$this->notice_dismissed_option_id = strtolower( str_replace( ' ', '_', $this->theme_name ) ) . '_welcome_notice_dismissed';

				if ( get_option( $this->notice_dismissed_option_id, false ) ) {
					return;
				}

				add_action( 'admin_notices', array( $this, 'display_theme_notice' ) );
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_assets' ) );
				add_action( 'wp_ajax_themebeez_install_required_plugins', array( $this, 'ajax_install_required_plugins' ) );
				add_action( 'wp_ajax_themebeez_dismiss_theme_notice', array( $this, 'ajax_dismiss_notice' ) );
			}
		}

		/**
		 * Enqueues CSS styles and JS scripts for the notice.
		 *
		 * @since 1.0.0
		 */
		public function enqueue_admin_assets() {

			wp_enqueue_script(
				'theme-notice-script',
				get_template_directory_uri() . '/admin/welcome-notice/theme-notice.js',
				array( 'jquery' ),
				ORCHID_STORE_VERSION, // Update version here.
				true
			);

			wp_localize_script(
				'theme-notice-script',
				'themeNotice',
				array(
					'ajaxUrl'       => admin_url( 'admin-ajax.php' ),
					'nonce'         => wp_create_nonce( 'install_required_plugins_nonce' ),
					'dismissNonce'  => wp_create_nonce( 'dismiss_notice_nonce' ),
					'redirectUrl'   => $this->dashboard_page_slug,
					'pluginsStatus' => $this->check_plugins_status(),
				)
			);

			wp_enqueue_style(
				'theme-notice-style',
				get_template_directory_uri() . '/admin/welcome-notice/theme-notice.css',
				array(),
				ORCHID_STORE_VERSION, // Update version here.
				'all'
			);
		}

		/**
		 * Renders theme notice.
		 *
		 * @since 1.0.0
		 */
		public function display_theme_notice() {

			$current_user = wp_get_current_user();
			?>
			<div class="themebeez-theme-welcome-notice notice notice-info is-dismissible">
				<div class="theme-notice__content">
					<div class="theme-notice__text">
						<div class="theme-notice__head">
							<p class="theme-notice__subheading">
								<?php
								printf(
									/* translators: %s: current user's display name */
									esc_html__( 'Hello, %s', 'orchid-store' ),
									esc_html( $current_user->get( 'display_name' ) )
								);
								?>
							</p>
							<h2 class="theme-notice__heading">
								<?php
								printf(
									/* translators: %s: theme name */
									esc_html__( 'Welcome to %s', 'orchid-store' ),
									esc_html( $this->theme_name )
								);
								?>
							</h2>
							<p class="theme-notice__description">
								<?php
								printf(
									/* translators: 1: theme name */
									esc_html__( 'Thank you for choosing %1$s! To get started with %1$s, install WooCommerce and Themebeez Toolkit plugins by clicking on the button below! We hope you enjoy using %1$s.', 'orchid-store' ),
									esc_html( $this->theme_name )
								);
								?>
							</p>
						</div>
						<div class="theme-notice__cta">
							<p>
								<button id="get-started-btn" class="theme-notice__button button button-primary">
									<span class="button-text">
										<?php echo esc_html__( 'Get Started', 'orchid-store' ); ?>
									</span>
									<span class="dashicons dashicons-update get-started-btn-icon" style="display: none;"></span>
								</button>
							</p>
						</div>
					</div>
					<div class="theme-notice__image">
						<img
							src="<?php echo esc_url( get_template_directory_uri() . '/screenshot.png' ); ?>"
							alt="<?php echo esc_attr__( 'Notice Image', 'orchid-store' ); ?>"
						>
					</div>
				</div>
			</div>
			<?php
		}

		/**
		 * AJAX request callback handler to install required plugins.
		 *
		 * @since 1.0.0
		 */
		public function ajax_install_required_plugins() {

			check_ajax_referer( 'install_required_plugins_nonce', 'nonce' );

			include_once ABSPATH . 'wp-admin/includes/plugin-install.php';
			include_once ABSPATH . 'wp-admin/includes/class-wp-upgrader.php';

			$upgrader = new Plugin_Upgrader( new Automatic_Upgrader_Skin() );
			foreach ( $this->required_plugins as $plugin_slug => $plugin_source ) {
				if ( ! is_plugin_active( $plugin_slug ) ) {
					$upgrader->install( $plugin_source );
					activate_plugin( $plugin_slug );
				}
			}

			wp_send_json_success( array( 'redirectUrl' => $this->dashboard_page_slug ) );
		}

		/**
		 * AJAX request callback handler to set dismiss notice to true.
		 *
		 * @since 1.0.0
		 */
		public function ajax_dismiss_notice() {

			check_ajax_referer( 'dismiss_notice_nonce', 'nonce' );
			update_option( $this->notice_dismissed_option_id, true );
			wp_send_json_success();
		}

		/**
		 * Checks if required plugins are installed.
		 *
		 * @since 1.0.0
		 */
		private function are_plugins_installed() {

			foreach ( $this->required_plugins as $plugin_slug => $plugin_source ) {
				if ( ! is_plugin_active( $plugin_slug ) ) {
					return false;
				}
			}

			return true;
		}

		/**
		 * Check the status of required plugins.
		 *
		 * @since 1.0.0
		 */
		private function check_plugins_status() {

			$status = array();

			foreach ( $this->required_plugins as $plugin_slug => $plugin_source ) {
				$status[ $plugin_slug ] = is_plugin_active( $plugin_slug );
			}

			return $status;
		}
	}
}
