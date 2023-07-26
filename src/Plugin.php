<?php

namespace WPD\UptimePage;

final class Plugin {

	/**
	 * @var string
	 */
	private string $status_page_url;

	/**
	 * @param string $status_page_url
	 */
	public function __construct( string $status_page_url ) {
		$this->status_page_url = $status_page_url;
	}

	/**
	 * @return string
	 */
	public function get_status_page_url() : string {
		return $this->status_page_url;
	}

	/**
	 * @return void
	 */
	public function run() {
		add_action( 'admin_menu', [ $this, 'add_pages' ] );
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
		echo '<iframe src="' . esc_url( $this->get_status_page_url() ) . '" allowfullscreen style="position: absolute; border: 0; width: 100%; height: calc(100% - 100px); min-height: calc(100vh - 100px);"></iframe>';
	}
}
