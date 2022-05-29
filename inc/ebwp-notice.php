<?php
/**
 * Admin notice to download Everest Backup.
 *
 * @package orchid-store
 */

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Everest Backup plugin notice class.
 */
class Orchid_Store_Ebwp_Notice {

	const EBWP_SLUG = 'everest-backup/everest-backup.php';

	const LOGO_URL = '//ps.w.org/everest-backup/assets/icon-128X128.gif';

	const PACKAGE_URL = 'https://downloads.wordpress.org/plugin/everest-backup.zip';

	const META_EXPIRE_AFTER = 'orchid_store_ebwp_notice_expire_after';

	const META_ACTION_TYPE = 'orchid_store_ebwp_notice_expire_after';

	const KEY_SUBMIT = 'orchid_store_ebwp_notice';

	protected $user_id                = 0;
	protected $expire_after_transient = '';
	protected $install_activate       = false;

	/**
	 * Init class.
	 */
	public function __construct() {

		if ( defined( 'EVEREST_THEMES_EBWP_NOTICE_LOADED' ) ) {

			/**
			 * Bail if notice already loaded.
			 */
			return;
		}

		define( 'EVEREST_THEMES_EBWP_NOTICE_LOADED', true );

		add_action( 'admin_init', array( $this, 'on_form_submit' ) );
		add_action( 'admin_head', array( $this, 'notice_styles' ) );
		add_action( 'admin_notices', array( $this, 'admin_notice' ) );
	}

	/**
	 * Return Everest Backup plugin status.
	 *
	 * @return string
	 */
	protected function get_plugin_status() {

		static $plugins = array();

		if ( ! $plugins ) {
			$plugins = get_plugins();
		}

		if ( ! isset( $plugins[ self::EBWP_SLUG ] ) ) {
			return 'not-installed';
		}

		/**
		 * Paused means plugin is installed but not active.
		 */
		return is_plugin_active( self::EBWP_SLUG ) ? 'active' : 'paused';
	}

	/**
	 * Reset notice related metas.
	 * Only use this method if you want to reset the meta for testing.
	 *
	 * @return void
	 */
	protected function reset_val() {
		$user_id = get_current_user_id();
		delete_user_meta( $user_id, self::META_EXPIRE_AFTER );
		delete_user_meta( $user_id, self::META_ACTION_TYPE );
	}

	/**
	 * Generate an activation URL for a plugin like the ones found in WordPress plugin administration screen.
	 *
	 * @return string
	 */
	protected function get_plugin_activation_link() {
		$plugin = self::EBWP_SLUG;

		$url = sprintf( network_admin_url( 'plugins.php?action=activate&plugin=%s&plugin_status=all&paged=1&s' ), $plugin );

		// Change the plugin request to the plugin to pass the nonce check.
		$_REQUEST['plugin'] = $plugin;

		return wp_nonce_url( $url, 'activate-plugin_' . $plugin );
	}

	/**
	 * Install and activate Everest Backup plugin.
	 *
	 * @return void
	 */
	protected function install_and_activate() {

		$plugins_dir = WP_PLUGIN_DIR;

		$plugin        = self::EBWP_SLUG;
		$plugin_folder = dirname( $plugins_dir . DIRECTORY_SEPARATOR . $plugin );
		$plugin_zip    = $plugin_folder . '.zip';

		$package = self::PACKAGE_URL;

		$data = wp_remote_get(
			$package,
			array(
				'sslverify' => false,
			)
		);

		$content = wp_remote_retrieve_body( $data );

		if ( file_exists( $plugin_zip ) ) {
			unlink( $plugin_zip );
		}

		if ( ! function_exists( 'WP_Filesystem' ) ) {
			require_once wp_normalize_path( ABSPATH . 'wp-admin/includes/file.php' );
		}

		WP_Filesystem();

		global $wp_filesystem;

		$wp_filesystem->put_contents( $plugin_zip, $content );

		if ( ! file_exists( $plugin_zip ) ) {
			return;
		}

		unzip_file( $plugin_zip, $plugins_dir );

		unlink( $plugin_zip );

		wp_cache_delete( 'plugins', 'plugins' );

		if ( ! is_wp_error( activate_plugin( $plugin, '', is_multisite() ) ) ) {
			$this->install_activate = true;
		};

	}

	/**
	 * Save user preference after
	 *
	 * @param array $data User submitted $_POST data.
	 * @return void
	 */
	protected function save_user_data( $data ) {

		$user_id = get_current_user_id();

		$remind = isset( $data['remind'] ) ? sanitize_text_field( wp_unslash( $data['remind'] ) ) : false;

		$action_type = 'never';

		$days = 5;

		if ( $remind ) {
			$action_type  = 'remind';
			$expire_after = DAY_IN_SECONDS * $days;

			set_transient( $this->expire_after_transient, 1, $expire_after );

		}

		update_user_meta( $user_id, self::META_ACTION_TYPE, $action_type );
	}

	/**
	 * Handle actions on form submit.
	 *
	 * @return void
	 */
	public function on_form_submit() {

		$this->user_id = get_current_user_id();

		$this->expire_after_transient = self::META_EXPIRE_AFTER . '_' . $this->user_id;

		if ( ! isset( $_POST[ self::KEY_SUBMIT ] ) ) {
			return;
		}

		if ( ! wp_verify_nonce(
			sanitize_text_field(
				wp_unslash( $_POST[ self::KEY_SUBMIT ] )
			),
			self::KEY_SUBMIT
		) ) {
			return;
		}

		if ( isset( $_POST['install'] ) ) {
			$this->install_and_activate();
		} else {
			$this->save_user_data( $_POST );
		}

	}

	/**
	 * Styles for notice.
	 *
	 * @return void
	 */
	public function notice_styles() {
		?>
		<style>
			#everest-themes-framework-ebwp-notice {
				background: rgb(255,255,255);
				background: linear-gradient(90deg, rgb(245 245 245) 0%, rgb(255 255 255) 100%);
				display: flex;
				align-items: start;
				flex-direction: column;
				overflow: hidden;
				border: 3px solid #ffffff;
				margin: 15px 0 !important;
				padding: 0 !important;
				box-shadow: 0 1px 4px rgb(0 0 0 / 15%);
			}

			#everest-themes-framework-ebwp-notice .message.et-notice-message {
				width: 100%;
				padding: 10px;
			}

			#everest-themes-framework-ebwp-notice .message.et-notice-message img {
				width: 53px;
				float: left;
				margin-right: 10px;
			}

			#everest-themes-framework-ebwp-notice .et-notice-message h1{
				margin: 0; padding: 0;
				font-size: 24px;
				font-weight: 400;
			}
			#everest-themes-framework-ebwp-notice .et-notice-message p {
				font-size: 14px;
				margin: 0;
			}
			#everest-themes-framework-ebwp-notice .et-notice-message p strong {
				color: #2271B1;
			}
			.et-notice-actions {
				width: 100%;
				padding: 10px 10px 15px;
				background: linear-gradient(90deg, rgb(234 234 235) 0%, rgb(255 255 255) 100%);
			}
			#everest-themes-framework-ebwp-notice .et-notice-actions button, #everest-themes-framework-ebwp-notice .et-notice-actions a.button-primary{
				margin: 8px 8px 0 0 !important;
			}
		</style>
		<?php
	}

	/**
	 * Admin notice to download Everest Backup.
	 */
	public function admin_notice() {

		if ( $this->install_activate ) {
			?>
			<div id="everest-themes-framework-ebwp-notice" class="notice is-dismissible">
				<div class="message et-notice-message">

					<img class="logo-icon" src="<?php echo esc_url( self::LOGO_URL ); ?>">

					<h1><?php esc_html_e( 'Thank You !!!', 'orchid-store' ); ?></h1>

					<?php

					$plugin_link = '<strong><a href="//wordpress.org/plugins/everest-backup/" target="_blank">Everest Backup</a></strong>';

					/* translators: %s is the Everest Backup plugin name wrapped with html. */
					$string = sprintf( __( '%s has been installed and activated successfully.', 'orchid-store' ), $plugin_link );

					echo wp_kses_post( wpautop( $string ) );
					?>

				</div>
			</div>
			<?php
		}

		$status = $this->get_plugin_status();

		if ( 'active' === $status ) {

			/**
			 * Bail early if plugin is active.
			 */
			return;
		}

		/**
		 * ===========================
		 * If we are here,
		 * then Everest Backup plugin
		 * is either not active
		 * or not installed at all.
		 * ===========================
		 */

		$user_id = $this->user_id;

		$action_type = get_user_meta( $user_id, self::META_ACTION_TYPE, true );

		if ( 'never' === $action_type ) {

			/**
			 * Bail if user don't want to keep their data safe and secure :P .
			 */
			return;
		}

		/**
		 * If user selects remind.
		 */
		$remind_again = ( 'remind' === $action_type ) ? get_transient( $this->expire_after_transient ) : 0;

		if ( $remind_again ) {
			return;
		}

		/**
		 * If we are here, then lets disturb our user :D.
		 */
		?>
		<div id="everest-themes-framework-ebwp-notice" class="notice">
			<div class="message et-notice-message">

				<img class="logo-icon" src="<?php echo esc_url( self::LOGO_URL ); ?>">

				<h1><?php esc_html_e( 'Your website is super precious !', 'orchid-store' ); ?></h1>
				<?php

				$plugin_link = '<strong><a href="//wordpress.org/plugins/everest-backup/" target="_blank">Everest Backup</a></strong>';

				if ( 'not-installed' === $status ) {
					/* translators: %s is the Everest Backup plugin name wrapped with html. */
					$string = sprintf( __( 'The best way to protect your website is by using %s plugin to keep your data safe and secure to remote storage..', 'orchid-store' ), $plugin_link );
				} else {
					/* translators: %s is the Everest Backup plugin name wrapped with html. */
					$string = sprintf( __( 'You are just one step away. Please activate %s plugin and backup your website to keep your data safe and secure.', 'orchid-store' ), $plugin_link );
				}

				echo wp_kses_post( wpautop( $string ) );
				?>
			</div>

			<div class="et-notice-actions">
			<form method="post">
				<?php
				wp_nonce_field( self::KEY_SUBMIT, self::KEY_SUBMIT );

				if ( 'not-installed' === $status ) {
					?>
					<button name="install" value="1" class="button-primary"><?php esc_html_e( 'Install & Activate', 'orchid-store' ); ?></button>
					<button name="remind" value="1" class="button"><?php esc_html_e( 'Remind me later', 'orchid-store' ); ?></button>
					<button name="never" value="1" class="button-link"><?php esc_html_e( "Don't show this again", 'orchid-store' ); ?></button>
					<?php
				} else {
					$activation_link = $this->get_plugin_activation_link();

					?>
					<a href="<?php echo esc_url( $activation_link ); ?>" class="button-primary"><?php esc_html_e( 'Activate Plugin', 'orchid-store' ); ?></a>
					<?php
				}
				?>
			</form>
			</div>
		</div>
		<?php
	}
}

new Orchid_Store_Ebwp_Notice();