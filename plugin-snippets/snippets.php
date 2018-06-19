<?php
/*
Plugin Name: plugin name
Plugin URI: yourwebsite
Description: description
Version: 1.0
Author: author name
Author URI: yourwebsite
License: GPL2

Copyright �쐬�N �v���O�C	����Җ� (email : �v���O�C����҂̃��[���A�h���X)

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
        // �|��t�@�C���̕�����f�[�^�p�̕ϐ�
        // variable for translation data (via *.mo file)
        private $lang;
        
        const SETTINGSTYLE_SLUG = 'prefix_my_setting_style';
        const SETTINGSTYLE_PATH = 'styles/prefix_my_setting_style.css';
        const MENU_SLUG = 'prefix_my_menu';
        
        // �|��t�@�C�����́uLANG_SLUG-����.mo�v�ƂȂ�悤�ɒ��ӂ���( ��Fprefix_my_lang-ja.mo )
        // Make sure the translation file name is "LANG_SLUG-country code.mo"( ��Fprefix_my_lang-en.mo )
        const LANG_SLUG = 'prefix_my_lang';
        const LANG_PATH = '/languages';

        private static $option_grp = 'prefix_my_option_grp';
        private static $option_param = [
            //���D�݂̃L�[ => DB�ɕۑ������I�v�V������
            //any key name => Option name stored in DB
            'hoge' => 'prefix_my_option_name_hoge',
            'moge' => 'prefix_my_option_name_moge'
        ];

        /*****
        �R���X�g���N�^�B�ǂݍ��ݎ��Ƀt�b�N�����������������ɏ����Ă���
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
        plugins_loaded�Ƀt�b�N���������B�|��t�@�C����ǂނ̂͂������悳�����B
        Process that hooked to "plugins_loaded". It looks good here to read the translation file.
        *****/
        function plugin_init(){
            $this->load_lang_strings();
        }

        /*****
        �|��t�@�C���̓ǂݍ���
        read the translation file.
        *****/
        private function load_lang_strings(){
            load_plugin_textdomain( self::LANG_SLUG, false, basename( dirname( __FILE__ ) ) . self::LANG_PATH );

            $this->lang['plugin_name'] = __('my plugins name', self::LANG_SLUG);
            $this->lang['setting_page'] = __('setting page', self::LANG_SLUG);
        }

        /*****
        admin_menu�Ƀt�b�N���������B�ݒ��ʂւ̃����N�����j���[�ɒǉ�����
        Process that hooked to "admin_menu". Add a link to the setting view to the menu.
        *****/
        function add_menu(){
            $page = add_management_page( $this->lang['plugin_name'], $this->lang['plugin_name'], 'manage_options', self::MENU_SLUG, array($this,'show_menu') );

            // �ݒ��ʂł̂ݓǂݍ���CSS�t�@�C��
            // css file that read only at setting view.
            add_action( 'admin_print_styles-' . $page, array( $this , 'enque_setting_style' ) );
        }

        /*****
        �ݒ��ʂ̂ݗL���ɂ���CSS�t�@�C����ǂݍ���
        css file that read only at setting view.
        *****/
        function enque_setting_style(){
            wp_enqueue_style( self::SETTINGSTYLE_SLUG , plugins_url(self::SETTINGSTYLE_PATH , __FILE__));
        }

        /*****
        admin_init�Ƀt�b�N���鏈��
        Process that hooked to "admin_init".
        *****/
        function setting_init(){
            foreach( self::$option_param as $key => $val ){
                register_setting( self::$option_grp, $val );
            }
        }


        /*****
        �ݒ��ʂ�HTML���쐬�A�\������֐�
        *****/
        function show_menu(){
            ?>
                <h2><?php echo $this->lang['plugin_name'] . " " . $this->lang['setting_page']; ?></h2>
                <form method="post" action="options.php">
                    <?php settings_fields( self::$option_grp ); ?>
                    <?php do_settings_sections( self::$option_grp ); ?>
                    <hr>

                    <!-- �����ɍD����form���i��ǉ����� -->
                    <!-- Please add any form parts here -->
                    <input type="text" name="<?php echo self::$option_param['hoge']; ?>" value="<?php echo esc_attr(get_option( self::$option_param['hoge'] , "" )); ?>">

                    <?php submit_button(); ?>
                </form>
            <?php
        }

        /*****
        �A���C���X�g�[������option�l��DB����폜����֐�
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
