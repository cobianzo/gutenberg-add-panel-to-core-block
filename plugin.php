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
		wp_die();
		add_action( 'enqueue_block_editor_assets', array( $this, 'cob_block_editor_assets' ) );
	}

	public function cob_block_editor_assets() {

		$asset_file = include plugin_dir_path( __FILE__ ) . 'build/index.asset.php';
		wp_enqueue_script(
			'blocks-course-plugin-boilerplate-script',
			plugins_url( 'build/index.js', __FILE__ ),
			$asset_file['dependencies'],
			$asset_file['version']
		);
	}

}

new Cob_Add_Panels_To_Gutenberg();
