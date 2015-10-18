<?

/** Автозагрузка классов
 * @param $className - имя искомого класса
 */
function __autoload($className)
{
    /** @var string $className - приведение символов в нижний регистр */
    $className = strtolower($className);

    /** @var string $className[0] - свитч по первой букве имени класса */
    switch($className[0]){
        case 'c':
            include_once('c/' . $className . '.php'); break;
        case 'm':
            include_once('m/' . $className . '.php'); break;
    }
}

/** Конфигурация базы данных */

define('DB_NAME_PREF', 'dk1y15_');
define('TBL_PREF', 'dkhk_');
define('DB_HOST', 'localhost');
define('DB_LOGIN', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'happykids');

/** Конфигурация медиа */

define('JS_DIR', '/media/js/');
define('CSS_DIR', '/media/css/');
define('IMAGE_DIR', '/media/images');
define('CK_IMG_UPLOAD_DIR', '/media/images/ck/');
define('DOCS_DIR', '/media/docs/');
define('DOCS_TYPES', "/\.(?:pdf|xls|xlsx|doc|docx)$/i");

/** Конфигурация путей */

define('BASE_URL', '/');
define('MAIN_TEMPLATE', '/v_main.php');