## これはなに？
WordPressプラグインのソーススニペットです。

プラグイン開発の下敷きとしてお使いください。

## 変更すべき箇所
以下を適宜変更してください。

* snippets.php冒頭のプラグインの説明
* クラス名
* クラス変数定義値
* show_menu()内のform部品

特に、「prefix_」と名前がついているものは、ちまたのプラグインと名前が被らないように独自のプレフィックスを付けるのが良いです。

## 動作
このプラグインをそのままWordPressのプラグインフォルダに格納すると、
管理画面のメニュー「プラグイン」→「インストール済みプラグイン」
「plugin name」というプラグインが出現します。

プラグインを有効化すると
管理画面のメニュー「ツール」の中に「プラグイン名」という名前のメニューが出現します。

テキストボックスに適当な値を入れて「変更を保存」とすると、
内容がDBに保存されて、テキストボックスにデフォルト表示されるようになる、
というだけの動作をします。

メニュー「プラグイン」→「インストール済みプラグイン」からプラグインを削除すると、
DB保存されたオプション($option_paramで定義したもの)が削除されるようになっています。

## readme.txt
プラグインを開発して、WordPressに登録申請をする場合は、
readme.txtが必須です。

公式のreadme.txtのフォーマットをそのまま貼りつけてあります。

詳細はWordPress公式サイトをご確認のこと。
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

