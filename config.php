<?php

/*true = debugMode, false = realMode*/
define('DEBUG_MODE'	,true);
define('USE_DATABASE'	,false);

/*404エラーメッセージ : DEBUG_MODE != true の際に表示されます*/
define('ERROR_MESSAGE', 'ページが見つかりませんでした。');

/*サイト名など*/
define('SITE_TITLE','tackphp demo site');

/*デフォルトのcontrollerとaction*/
define('DEFAULT_CONTROLLER','default');
define('DEFAULT_ACTION','index');

/*viewテンプレート拡張子*/
define('EXTENSION', '.tpl');

/*デフォルトのレイアウト*/
define('DEFAULT_LAYOUT', '../view/layout/default' . EXTENSION);

/*エラーページ*/
define('ERROR_CONTROLLER', 'default');
define('ERROR_ACTION','error');

/*このファイルに定義した定数はどこからでもtackphp内でどこからでも参照できます。
**必要に応じて定数を定義してください。
*/
define('WEBMASTER','YOUR NAME!');
define('BEST_PHP_FRAMEWORK','tackphp!');
