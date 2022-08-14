<?php // phpcs:disable WordPress.Files.FileName.InvalidClassFileName
/**
* Add new panels and buttons to a gutenberg default block
*
* @package COB_ADDPANELS
* @author @cobianzo
* @license gplv2-or-later
* @version 1.0.0
*
* @wordpress-plugin
* Plugin Name: Cobi Add Panels
* Plugin URI: https://cobianzo.com
* Description: Just add new options to a gutenberg default block
* Version: 1.0.0
* Author: @cobianzo
* Author URI: https://cobianzo.com
* Text Domain: cob
* Domain Path: /languages
* License: GPLv2 or later
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
*
* You should have received a copy of the GNU General Public License
* along with Hot Recipes. If not, see <https://www.gnu.org/licenses/gpl-2.0.html/>.
*/

class Cob_Add_Panels_To_Gutenberg {


	public function __construct() {

		// Enqueue hooks
		add_action( 'init', array( $this, 'cob_init' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'cob_block_editor_assets' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'cob_frontend_assets' ) );
	}

	public function cob_init() {
		$asset_file = include plugin_dir_path( __FILE__ ) . 'js/build/index.asset.php';
		wp_register_style( 'cob-block-style-front-and-backend', plugin_dir_url( __FILE__ ) . 'js/build/index.css', null, $asset_file['version'] );
	}
	public function cob_block_editor_assets() {

		// The JS that will add the functionality.
		$asset_file = include plugin_dir_path( __FILE__ ) . 'js/build/index.asset.php';
		wp_enqueue_script(
			'cob-boilerplate-script',
			plugins_url( 'js/build/index.js', __FILE__ ),
			$asset_file['dependencies'],
			$asset_file['version'],
			true
		);

		// Style CSS backend only:
		wp_enqueue_style( 'cob-block-style-front-and-backend' );
		// Maybe this is a better solution? Read docs!
		// register_block_style(
		// 	'core/cover',
		// 	array(
		// 		'name'  => 'my-cover',
		// 		'label' => __( 'My custom cover', 'mydomain' ),
		// 	)
		// );
	}

	public function cob_frontend_assets() {
		// Style CSS frontend only:
		wp_enqueue_style( 'cob-block-style-front-and-backend' );
	}

}

new Cob_Add_Panels_To_Gutenberg();
