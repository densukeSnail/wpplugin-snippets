## ����͂ȂɁH
WordPress�v���O�C���̃\�[�X�X�j�y�b�g�ł��B

�v���O�C���J���̉��~���Ƃ��Ă��g�����������B

## �ύX���ׂ��ӏ�
�ȉ���K�X�ύX���Ă��������B

* snippets.php�`���̃v���O�C���̐���
* �N���X��
* �N���X�ϐ���`�l
* show_menu()����form���i

���ɁA�uprefix_�v�Ɩ��O�����Ă�����̂́A���܂��̃v���O�C���Ɩ��O�����Ȃ��悤�ɓƎ��̃v���t�B�b�N�X��t����̂��ǂ��ł��B

## ����
���̃v���O�C�������̂܂�WordPress�̃v���O�C���t�H���_�Ɋi�[����ƁA
�Ǘ���ʂ̃��j���[�u�v���O�C���v���u�C���X�g�[���ς݃v���O�C���v
�uplugin name�v�Ƃ����v���O�C�����o�����܂��B

�v���O�C����L���������
�Ǘ���ʂ̃��j���[�u�c�[���v�̒��Ɂu�v���O�C�����v�Ƃ������O�̃��j���[���o�����܂��B

�e�L�X�g�{�b�N�X�ɓK���Ȓl�����āu�ύX��ۑ��v�Ƃ���ƁA
���e��DB�ɕۑ�����āA�e�L�X�g�{�b�N�X�Ƀf�t�H���g�\�������悤�ɂȂ�A
�Ƃ��������̓�������܂��B

���j���[�u�v���O�C���v���u�C���X�g�[���ς݃v���O�C���v����v���O�C�����폜����ƁA
DB�ۑ����ꂽ�I�v�V����($option_param�Œ�`��������)���폜�����悤�ɂȂ��Ă��܂��B

## readme.txt
�v���O�C�����J�����āAWordPress�ɓo�^�\��������ꍇ�́A
readme.txt���K�{�ł��B

������readme.txt�̃t�H�[�}�b�g�����̂܂ܓ\����Ă���܂��B

�ڍׂ�WordPress�����T�C�g�����m�F�̂��ƁB
<https://ja.wordpress.org/plugins/developers/>


## What's this?
It is a source snippet of WordPress plugin.


## Where to change
Please change the following as appropriate.

* Description of the plug-in at the beginning of "snippets.php"
* Class name
* Value of class variables
* form parts in "show_menu()"

In particular, it is better to add your own prefix so that the name "prefix_" is not suffered by global plugins and names.

## Behavior
When you store this plug-in as it is in the plug-in folder of WordPress,
a plugin "plugin name" will appear at menu "Plugins" -> "Installed Plugins".

When you activate the plug-in, a menu named "my plugins name" will appear in the menu "Tool".


If you enter appropriate values in the text box and press "save changes",
the contents will be saved in the DB and show that value in the text box as default.


By deleting the plug-in from "Plugins" -> "Installed Plugins", the DB saved option (defined with "$option_param") is deleted from DB.

## readme.txt
When you develop a plugin and apply for registration to WordPress, readme.txt is required.

Now , the official readme.txt format is pasted as it is.

Please check the official website of WordPress for details.
<https://wordpress.org/plugins/developers/>

