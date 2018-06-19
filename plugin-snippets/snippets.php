<?php
/*
Plugin Name: plugin name
Plugin URI: yourwebsite
Description: description
Version: 1.0
Author: author name
Author URI: yourwebsite
License: GPL2

Copyright 作成年 プラグイ	ン作者名 (email : プラグイン作者のメールアドレス)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if( !class_exists('prefix_my_class') ){
    class prefix_my_class{
        // 翻訳ファイルの文字列データ用の変数
        // variable for translation data (via *.mo file)
        private $lang;
        
        const SETTINGSTYLE_SLUG = 'prefix_my_setting_style';
        const SETTINGSTYLE_PATH = 'styles/prefix_my_setting_style.css';
        const MENU_SLUG = 'prefix_my_menu';
        
        // 翻訳ファイル名は「LANG_SLUG-国名.mo」となるように注意する( 例：prefix_my_lang-ja.mo )
        // Make sure the translation file name is "LANG_SLUG-country code.mo"( 例：prefix_my_lang-en.mo )
        const LANG_SLUG = 'prefix_my_lang';
        const LANG_PATH = '/languages';

        private static $option_grp = 'prefix_my_option_grp';
        private static $option_param = [
            //お好みのキー => DBに保存されるオプション名
            //any key name => Option name stored in DB
            'hoge' => 'prefix_my_option_name_hoge',
            'moge' => 'prefix_my_option_name_moge'
        ];

        /*****
        コンストラクタ。読み込み時にフックしたい処理をここに書いておく
        Constructor. Write the process you want to hook on loading here.
        *****/
        function __construct() {
            add_action( 'plugins_loaded', array( $this , 'plugin_init' ) );
            add_action( 'admin_menu', array( $this , 'add_menu' ) );
            add_action( 'admin_init', array( $this , 'setting_init' ) );

            if(function_exists('register_uninstall_hook')) {
                register_uninstall_hook (__FILE__, array(get_class($this),'do_uninstall') );
            }
        }

        /*****
        plugins_loadedにフックした処理。翻訳ファイルを読むのはここがよさそう。
        Process that hooked to "plugins_loaded". It looks good here to read the translation file.
        *****/
        function plugin_init(){
            $this->load_lang_strings();
        }

        /*****
        翻訳ファイルの読み込み
        read the translation file.
        *****/
        private function load_lang_strings(){
            load_plugin_textdomain( self::LANG_SLUG, false, basename( dirname( __FILE__ ) ) . self::LANG_PATH );

            $this->lang['plugin_name'] = __('my plugins name', self::LANG_SLUG);
            $this->lang['setting_page'] = __('setting page', self::LANG_SLUG);
        }

        /*****
        admin_menuにフックした処理。設定画面へのリンクをメニューに追加する
        Process that hooked to "admin_menu". Add a link to the setting view to the menu.
        *****/
        function add_menu(){
            $page = add_management_page( $this->lang['plugin_name'], $this->lang['plugin_name'], 'manage_options', self::MENU_SLUG, array($this,'show_menu') );

            // 設定画面でのみ読み込むCSSファイル
            // css file that read only at setting view.
            add_action( 'admin_print_styles-' . $page, array( $this , 'enque_setting_style' ) );
        }

        /*****
        設定画面のみ有効にするCSSファイルを読み込み
        css file that read only at setting view.
        *****/
        function enque_setting_style(){
            wp_enqueue_style( self::SETTINGSTYLE_SLUG , plugins_url(self::SETTINGSTYLE_PATH , __FILE__));
        }

        /*****
        admin_initにフックする処理
        Process that hooked to "admin_init".
        *****/
        function setting_init(){
            foreach( self::$option_param as $key => $val ){
                register_setting( self::$option_grp, $val );
            }
        }


        /*****
        設定画面のHTMLを作成、表示する関数
        *****/
        function show_menu(){
            ?>
                <h2><?php echo $this->lang['plugin_name'] . " " . $this->lang['setting_page']; ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( self::$option_grp ); ?>
                    <?php do_settings_sections( self::$option_grp ); ?>
                    <hr>

                    <!-- ここに好きなform部品を追加する -->
                    <!-- Please add any form parts here -->
                    <input type="text" name="<?php echo self::$option_param['hoge']; ?>" value="<?php echo esc_attr(get_option( self::$option_param['hoge'] , "" )); ?>">

                    <?php submit_button(); ?>
                </form>
            <?php
        }

        /*****
        アンインストール時にoption値をDBから削除する関数
        *****/
        static function do_uninstall(){
            foreach( self::$option_param as $key => $val ){
                unregister_setting( self::$option_grp, $val );
                delete_option($val);
            }
        }

    }
    new prefix_my_class();
}

?>
