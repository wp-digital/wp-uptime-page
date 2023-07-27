<?php

namespace WPD\UptimePage;

use WPD\UptimePage\Providers\Provider;

final class Plugin {

	private const OPTION_NAME = 'wpd_uptime_page_path';

	/**
	 * @var Url
	 */
	private Url $url;
	/**
	 * @var Provider
	 */
	private Provider $provider;
	/**
	 * @var Integrations\Integration[]
	 */
	private array $integrations = [];

	/**
	 * @param Url      $url
	 * @param Provider $provider
	 */
	public function __construct(
		Url $url,
		Provider $provider
	) {
		$this->url      = $url;
		$this->provider = $provider;

		$this->integrations[ Integrations\FlushCache::class ] = new Integrations\FlushCache();
	}

	/**
	 * @return Url
	 */
	public function get_url(): Url {
		return $this->url;
	}

	/**
	 * @return Provider
	 */
	public function get_provider() : Provider {
		return $this->provider;
	}

	/**
	 * @return Integrations\Integration[]
	 */
	public function get_integrations(): array {
		return $this->integrations;
	}

	/**
	 * @return void
	 */
	public function run() {
		add_action( 'admin_menu', [ $this, 'add_pages' ] );

		foreach ( $this->get_integrations() as $integration ) {
			$integration->run( $this );
		}
	}

	/**
	 * @return void
	 */
	public function add_pages() {
		add_dashboard_page(
			esc_html__( 'Uptime Page', 'wpd-uptime-page' ),
			esc_html__( 'Uptime Page', 'wpd-uptime-page' ),
			'manage_options',
			'wpd-uptime-page',
			[ $this, 'render_page' ]
		);
	}

	/**
	 * @return void
	 */
	public function render_page() {
		$url  = $this->get_url();
		$path = (string) get_option( self::OPTION_NAME, '' );

		if ( ! $path ) {
			$path = $this->get_provider()->path();

			update_option( self::OPTION_NAME, $path );
		}

		printf(
			'<iframe src="%s" allowfullscreen style="%s"></iframe>',
			esc_url( $url( $path ) ),
			'position: absolute; border: 0; width: 100%; height: calc(100% - 100px); min-height: calc(100vh - 100px);'
		);
	}

	/**
	 * @return void
	 */
	public static function clear_cache(): void {
		delete_option( self::OPTION_NAME );
	}
}
