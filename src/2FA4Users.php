<?php

/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 13/02/2018
 * Time: 14:38
 * PHP version 7.1
 *
 * @category Test
 * @package  Test
 * @author   Pierre Amaury Plaud <pierreamaury@outlook.fr>
 * @author   Travail réalisé au sein de la SARL CYM DEVELOPPEMENT
 * @author   dans le cadre d'un stage de deuxiéme année de BTS SIO
 * @license  http://www.php.net/license/7_10.txt PHP License 7.1
 * @link     http://pear.php.net/package/PackageName
 */

//namespace Library2FA;
//use u2flib_server\U2F as U2F;
include 'error_debug.php';

////////////////////////////////////////////////////////////////////////////////////
//***********************  IMPORTANT CONST ARE ON THE TOP OF LIB  ************************//
////////////////////////////////////////////////////////////////////////////////////

/**
 * Array of sentences
 */
const TEXT_LANG = array(
    'fr-FR'=>array(
        'Mon application',
        'Connectez-vous',
        'Identifiants',
        'Mot de passe',
        'Valider',
        'Mot de passe oublié',
        'Inserez clef U2F pour enregistrement',
        'Délai expiré, cliquez pour enregistrer',
        'Enregistrer nouvelle clef',
        'Inserer clef U2F pour authentification',
        'Délai expiré, cliquez pour re-authentifier',
        'Authentifier clef'
    ),
    'en-US'=>array(
        'My app',
        'Connection',
        'ID\'s',
        'Password',
        'OK',
        'Forgot your password',
        'Plug U2F key for register',
        'Delay expired, click for try again',
        'Register a new key',
        'Plug U2F key for authenticate',
        'Delay expired, click for try again',
        'Authenticate key'
    ),
    'it-IT'=>array(),
    'pl-PL'=>array(),
    'de-DE'=>array(),
    '...'=>array()
);


/**
 * Allow to change lang with const
 * lang and country codes are available here :
 * https://docs.oracle.com/cd/E13214_01/wli/docs92/xref/xqisocodes.html
 * or here :
 * https://msdn.microsoft.com/en-us/library/ee825488(v=cs.20).aspx
 */
const DEFAULT_LANG = 'en-US';
;

////////////////////////////////////////////////////////////////////////////////////
//****************************  DOUBLE AF CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Double authenticate way:
 * 0 (none)
 * 1 (SMS)
 * 2 (U2F)
 */
const DOUBLEFA = 2;

/**
 * Short message text for SMS authenticate
 * Change as you want
 */
const DOUBLEFA_SMS_TEXT = "this is your code";



////////////////////////////////////////////////////////////////////////////////////
//*********************************  ID CONSTANTS  *******************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * The kind of ID for user connect
 * 0 no check
 * 1 email
 * 2 array of pattern
 */
const ID_TYPE = 2;

/**
 * Pattern as an array for ID
 * In this way you can add some more patterns
 * On first cell, you have an example for username pattern
 * but on the second cell, it's for number phone.
 * Actually it's for french numbers, so it checks for ten numbers
 * You can change it as you want.
 */
const ID_PATTERN = array(
    //'`^[[:alnum:]]{4,8}$`',
    '/^[a-zA-Z0-9_]+$/',
    '#^.{10,}$#',
);



////////////////////////////////////////////////////////////////////////////////////
//*****************************  PASSWORD CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Password lenght
 * 8(8 letters)
 * 9(9 letters)
 * ...
 */
const PASSWORD_LENGHT = 8;

/**
 * Password strength
 * 1(numbers)
 * 2(numbers + uppercase)
 * 3(numbers + uppercase + special caracters)
 */
const PASSWORD_STRENGTH = 1;

/**
 * Pattern as an array for Password
 * In this way you can add some more patterns
 * [1] Only the lenght will be tested
 * [2] the lenght + numbers
 * [3] the lenght + numbers + uppercase
 * [4] the lenght + numbers + uppercase + special caracters
 */
const PASSWORD_PATTERN =  array(
    '#^.{'.PASSWORD_LENGHT.',}$#',
    '#^(?=.*[a-z])(?=.*[0-9]).{'.PASSWORD_LENGHT.',}$#',
    '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{'.PASSWORD_LENGHT.',}$#',
    '#^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{'.PASSWORD_LENGHT.',}$#'
    );

/**
 * Define how long the user could connect with the same password
 * 1(1 day)
 * 2(2 days)
 * ...
 */
const PASSWORD_LIFE = 10;

/**
 * Desactivate/activate if user could change his password with an old password
 * already registered by this user
 */
const PASSWORD_REGISTER = 1;

/**
 * If PASSWORD_REGISTER is ON
 * this constant define how many old passwords
 * could be stored in database before purge the first one
 * who is the older stored
 */
const PASSWORD_MAX_REGISTER = 5;

/**
 * Number of attempt failed
 * 0(0)
 * 1(1)
 * 2(2)
 * ...
 */
const PASSWORD_ATTEMPT_ERROR = 5;

/**
 * Time on min when number of attempt have reach limit
 * 0 (if admin have to reactivate itself on database desactivated users)
 * 1 (one minute)
 * 2 (two minutes)
 * ...
 */
const PASSWORD_DELAY_BEFORE_RETRY = 1;

////////////////////////////////////////////////////////////////////////////////////
//*******************************  LOGS CONSTANTS  *******************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Logs management
 * 0(none)
 * 1(2 logs)
 * 2(4 logs)
 * 3(9 logs)
 *
 * NIVEAU 0      NIVEAU 1      NIVEAU 2      NIVEAU 3
 * desactivé     connection    connection    connection
 *               deconnection  deconnection  deconnection
 *                             changingPass  changingPass
 *                             deleteUserAccount deleteUserAccount
 *                                           autoDisconnect
 *                                           changingUserAccount
 *                                           passwordError
 *                                           2FA
 *                                           disableUserAccount
 */
const LOG = 3;

/**
 * Determine the log path
 */
const LOG_PATH = "log/";



////////////////////////////////////////////////////////////////////////////////////
//*****************************  DATABASE CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Define the type of database you have to user for the project
 * 1 MySQL
 * 2 Postgres
 * 3 SQLite
 */
const DATABASE_TYPE = 1;

/**
 * Determine the host of the database
 * by default: localhost
 */
const DATABASE_HOST = "localhost";

/**
 * Default port of database postgres
 */
const DATABASE_PORT = "5432";

/**
 * The name of your database
 * If you are using sqlite, please write the name of the file, followed by .sqlite.db
 * users.sqlite.db
 */
const DATABASE_NAME = "test";

/**
 * ID's you're using to connect on database
 */
const DATABASE_USER = "root";

/**
 * Password you're using to connect on database
 */
const DATABASE_PASSWORD = "1234";

/**
 * Prefix for table name
 */
const DATABASE_PREFIX = "prefix_";



////////////////////////////////////////////////////////////////////////////////////
//*******************************  ERRORS CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
const ERROR_OK = 0;
const ERROR_PASSWORD_TOO_SHORT = 1;
const ERROR_PASSWORD_STRENGTH = 2;
const ERROR_ID_PATTERN_ERROR = 3;
const ERROR_ID_ALREADY_EXISTS = 4;
const ERROR_UPDATE_FAILED = 5;
const ERROR_ACTIVE = 6;
const ERROR_ID_DOESNT_EXIST = 7;
const ERROR_ID_NEW_USERID_EQUAL_OLD_USER_ID = 8;
const ERROR_PASSWORD_ALREADY_EXISTS = 9;
const ERROR_CONNECTION = 10;
const ERROR_USER_NOT_ACTIVE = 11;
const ERROR_ACCOUNT_TEMPORARILY_DISABLED = 12;
const ERROR_COUNTDOWN_PASSWORDS = 13;
const ERROR_AUTHENTIFICATION_FAILED = 14;

const ERROR_TEXT = array(
    "OK",
    "Mot de passe trop court",
    "Mot de passe trop faible",
    "L'identifiant ne correspond pas au pattern",
    "Cet utilisateur existe déjà",
    "La mise a jour de l'élément a échouée",
    "L'élément actif ne prend que 0 ou 1",
    "Cet utilisateur n'existe pas",
    "Le nouvel identifiant est identique à l'ancien",
    "Le mot de passe est un ancien mot de passe déjà enregistré",
    "Identifiant et/ou mot de passe incorrect",
    "Utilisateur désactivé",
    "Compte désactivé pour ".PASSWORD_DELAY_BEFORE_RETRY." min",
    "Tentative(s) de connexion restante(s): ",
    "Authentification échouée. Vous avez été déconnecté."
);



////////////////////////////////////////////////////////////////////////////////////
//******************************  SESSION CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Define time for session active before deconnection
 */
const SESSION_TIME_BEFORE_DECO = 60;

/**
 * Name of array used to $_SESSION
 */
const SESSION_ARRAY_USER_INFO = "user";


////////////////////////////////////////////////////////////////////////////////////
//******************************  OTHERS CONSTANTS  ******************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Activate/Desactivate forcing browsers to connect with HTTPS protocol
 */
const FORCE_SSL = 1;

/**
 * Login page
 * /Librairie/login.php
 */
const LOGIN_PAGE = "AUTO";

/**
 * Your default index app page
 */
const BASEPAGE = "Index.php";

/**
 * Admin rights default number
 */
const ADMIN = 10000;

/**
 * It's able to desactivate init_table
 * when they are already created
 * 1 (when tables are not created yet)
 * 0 (when tables are already created)
 */
const CREATE_TABLE = 1;

if (DOUBLEFA >= 1){
    require "U2F/U2F.php";
}
/**
 * Class Library php
 *
 * @category  CategoryName
 * @package   PackageName
 * @author    Original Author <author@example.com>
 * @author    Another Author <another@example.com>
 * @copyright 1997-2005 The PHP Group
 * @license   http://www.php.net/license/3_01.txt  PHP License 3.01
 * @version   Release: @package_version@
 * @link      http://pear.php.net/package/PackageName
 */
class userLibrary //a changer
{
    private static $lastErrorCode = ERROR_OK;
    private static $lastErrorText = ERROR_TEXT[ERROR_OK]; //Erreur generee par l'IDE
    private static $lastErrorExtra;
    private $userConnected = false;
    private $user2FAConnected = false;
    private static $currentUser = array();
    const DEBUG = 0;



    /**
     * Library constructor.
     */
    public function __construct()
    {
        self::_check();
        //self::_createUser("jamy", "qwertyuioP0?", $rights = 1, $phone = null);
        self::_sessionStart();
        self::_checkForm();
        $this->userConnected = self::_isUserConnected();
        if ($this->userConnected)
            $this->user2FAConnected = self::_isUser2FAConnected();
        //self::_log"Connexion", 1, 1);

        self::_loginForm($this->userConnected, $this->user2FAConnected);
    }


    /**
     * Used to check some function for dev
     */
    private static function _check(){
        self::_checkSSL();
        self::_getAvailablePDODriver();
        self::_getHTMLLang();
    }

    /**
     * Set error on var and
     * Return last error
     *
     * @param int $errorCode error number
     *
     * @return void
     */
    private static function _error($errorCode, $extraInfo = "")
    {
        self::$lastErrorCode = $errorCode;
        self::$lastErrorText = ERROR_TEXT[$errorCode];
        self::$lastErrorExtra = $extraInfo;
        $_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'] = self::$lastErrorCode;
        $_SESSION[SESSION_ARRAY_USER_INFO]['errorText'] = self::$lastErrorText . self::$lastErrorExtra;
    }


    /**
     * Get last error
     *
     * @return array
     */
    public static function getLastError()
    {
        return (array(self::$lastErrorCode, self::$lastErrorText));
    }


    /**
     * Initiate a table in order of the database type
     *
     * @param object $pdo is the pdo from the _initPDO() function
     *
     * @return void
     */
    private static function _createTable($pdo)
    {
        if (DATABASE_TYPE == 1) {
            $pdo->exec(
                "CREATE TABLE if not exists `" . DATABASE_PREFIX . "registrations`( 
            `id` SERIAL NOT NULL AUTO_INCREMENT ,
            `user_id` VARCHAR(50) NOT NULL ,  
            `password` VARCHAR(60) NOT NULL ,
            `u2f_key_handle` VARCHAR(255) NULL ,
            `u2f_public_key` VARCHAR(255) NULL ,
            `u2f_certificate` TEXT NULL ,
            `u2f_counter` INT NULL ,
            `rights` INT NOT NULL ,
            `old_password` LONGTEXT NULL ,
            `active` INTEGER NOT NULL ,
            `phone_number` VARCHAR(10) NULL ,
            `version_lib` VARCHAR(50) NULL ,
            `ipv4` VARCHAR(15) NULL ,
            `ipv6` VARCHAR(36) NULL ,
            `password_birth` INTEGER NOT NULL ,
            `delay_password` INTEGER NULL ,
            `connection_date` INTEGER NULL ,
            `password_error` INTEGER NULL , 
            `token` VARCHAR(60) NULL ,
            `tokenU2F` VARCHAR(60) NULL)
            ENGINE = InnoDB "
            );
        } elseif (DATABASE_TYPE == 2) {
            $pdo->exec(
                'CREATE TABLE if not exists ' . DATABASE_PREFIX . 'registrations (
            "id" SERIAL,
            "user_id" character varying(50) COLLATE pg_catalog."default" NOT NULL,
            "password" character varying(60) COLLATE pg_catalog."default" NOT NULL,
            "u2f_key_handle" character varying(255) COLLATE pg_catalog."default" NULL,
            "u2f_public_key" character varying(255) COLLATE pg_catalog."default" NULL,
            "u2f_certificate" text COLLATE pg_catalog."default" NULL,
            "u2f_counter" integer NULL,
            "rights" integer NOT NULL,
            "old_password" text COLLATE pg_catalog."default" NULL,
            "active" integer NOT NULL,
            "phone_number" character varying(10) COLLATE pg_catalog."default" NULL,
            "version_lib" character varying(50) COLLATE pg_catalog."default" NULL,
            "ipv4" character varying(15) COLLATE pg_catalog."default" NULL,
            "ipv6" character varying(36) COLLATE pg_catalog."default" NULL,
            "password_birth" integer NOT NULL,
            "delay_password" integer NULL,
            "connection_date" integer NULL,
            "password_error" integer NULL, 
            "token" character varying(60) COLLATE pg_catalog."default" NULL,
            "tokenU2F" character varying(60) COLLATE pg_catalog."default" NULL,
            CONSTRAINT ' . DATABASE_PREFIX . 'Registrations_pkey PRIMARY KEY ("id"))
            WITH (OIDS = FALSE)
            TABLESPACE pg_default;'
            );
        } elseif (DATABASE_TYPE == 3) {
            $pdo->exec(
                'CREATE TABLE if not exists ' . DATABASE_PREFIX . 'registrations (
            "id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
            "user_id"	TEXT NOT NULL,
            "password"	TEXT NOT NULL,
            "u2f_key_handle"	TEXT NULL,
            "u2f_public_key"	TEXT NULL,
            "u2f_certificate"    TEXT NULL,
            "u2f_counter"	INTEGER NULL,
            "rights"	INTEGER NOT NULL,
            "old_password"	TEXT NULL,
            "active"	INTEGER NOT NULL,
            "phone_number"	TEXT NULL,
            "version_lib"	TEXT NULL,
            "ipv4"	TEXT NULL,
            "ipv6"	TEXT NULL,
            "password_birth"    INTEGER NOT NULL,
            "delay_password"    INTEGER NULL,
            "connection_date"   INTEGER NULL,
            "password_error"    INTEGER NULL, 
            "token" TEXT NULL,
            "tokenU2F" TEXT NULL);'
            );
        }
    }


    /**
     *
     */
    private static function _getAvailablePDODriver(){
        $present = false;
        $driver = PDO::getAvailableDrivers();
        foreach ($driver as $value){
            if (DATABASE_TYPE == 1 && $value == "mysql")
                $present = true;
            if (DATABASE_TYPE == 2 && $value == "pgsql")
                $present = true;
            if (DATABASE_TYPE == 3 && $value == "sqlite")
                $present = true;
        }
        if (!$present){
            echo "missing pdo driver";
            exit();
        }
    }


    /**
     *
     */
    public static function _checkSSL(){
        if (FORCE_SSL == 1 && !isset($_SERVER['HTTPS'])) {
            header("Location: https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']);
            exit();
        }
    }


    /**
     * Get browser lang and set in const LANG
     */
    private static function _getHTMLLang(){
//        echo $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        $codeLang = 'NONE';
        $res = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
        echo "<br />";
        $res2 = explode(';', $res);
        foreach ($res2 as $val){
            $res3 = explode(',', $val);
            foreach ($res3 as $val2){
                $res4 = strpos($val, '-');
                if (strpos($val2, '-') !== false && isset(TEXT_LANG[$val2]) && $codeLang == 'NONE'){
                    $codeLang = $val2;
                }
            }
        }
        define('LANG', $codeLang);
    }


    /**
     * Initiate PDO
     * Uncomment print_r(PDO::getAvailableDrivers()); to see
     * what kind of pdo drivers you'll need
     *
     * @return $pdo
     */
    private static function _initPdo()
    {
        self::_getAvailablePDODriver();
        if (DATABASE_TYPE == 1) {
            $pdo = new PDO(
                'mysql:host=' . DATABASE_HOST .
                ';dbname=' . DATABASE_NAME,
                DATABASE_USER,
                DATABASE_PASSWORD
            );
        } elseif (DATABASE_TYPE == 2) {
            $pdo = new PDO(
                'pgsql:host=' . DATABASE_HOST .
                ';dbname=' . DATABASE_NAME .
                ';user=' . DATABASE_USER .
                ';password=' . DATABASE_PASSWORD
            );
        } elseif (DATABASE_TYPE == 3) {
            $pdo = new PDO('sqlite:' . DATABASE_NAME);
        } else {
            exit();
        }
        if (CREATE_TABLE == 1){
        self::_createTable($pdo);
        }
        return $pdo;
    }


    /**
     * Request to get elements on database
     *
     * @param string $req request
     * @param mixed $param is the element to read on database
     *
     * @return $res
     */
    private static function _getBDD($req, $param)
    {
        $pdo = self::_initPdo();
        $get = $pdo->prepare($req);
        if (self::DEBUG == 1){
            var_dump($pdo->errorInfo());
        }
        $get->execute($param);
        if (self::DEBUG == 1){
            var_dump($pdo->errorInfo());
        }
        $res = $get->fetchAll();
        return $res;
    }


    /**
     * Request to set elements on database
     *
     * @param string $req request
     * @param array $param is the element to add on database
     */
    private static function _setBDD($req, $param)
    {
        $pdo = self::_initPdo();
        $set = $pdo->prepare($req);
        if (self::DEBUG == 1) {
            var_dump($pdo->errorInfo());
            //error_debug($pdo->errorInfo());
        }
        $set->execute($param);
        if (self::DEBUG == 1) {
            var_dump($pdo->errorInfo());
            //error_debug($set->errorInfo());
        }
    }


    /**
     * Register log on defined file with LOG_PATH
     * create a new log file each day
     *
     * @param string $action describe the log
     * @param int $level level of numbers of enabled logs
     * @param int $user_id used to find who created the log
     */
    private static function _log($action, $level, $user_id = null)
    {
        if (LOG > 0 && LOG >= $level) {
            $file = LOG_PATH . 'log-' . date('Y-m-d') . '.txt';
            if (!file_exists($file)) {
                $text = " Date ; User id ; Action \n";
                file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
            }
            $date = date('d/m/Y H:i:s');
            //CSV format
            $text = $date . ';' . $user_id . ';' . $action . "\n";
            file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
        }
    }


    /**
     * Define the strength of the user's password
     *
     * @param string $pass could be from form or other
     */
    private static function _passwordStrength($pass)
    {
        $password = false;
        $strength = PASSWORD_STRENGTH;
        if ($strength > count(PASSWORD_PATTERN)) {
            $strength = count(PASSWORD_PATTERN) - 1;
        }
        if (!preg_match(PASSWORD_PATTERN[$strength], $pass)) {
            if (PASSWORD_LENGHT > strlen($pass)) {
                self::_error(ERROR_PASSWORD_TOO_SHORT);
            } else {
                self::_error(ERROR_PASSWORD_STRENGTH);
            }
        } else {
            $password = true;
        }
        return $password;
    }


    /**
     * Create a password to user account
     *
     * @param string $pass could be from form or other
     *
     * @return $password
     */
    private static function _validPasswd($pass)
    {
        if (!empty($pass) && self::_passwordStrength($pass) != 0) {
            $password = password_hash($pass, PASSWORD_BCRYPT);
            return ($password);
        }
    }


    /**
     * Check the kind of user ID
     * See constant to have some more info
     *
     * @param $user
     *
     * @return bool
     */
    private static function _checkUserID($user)
    {
        if (!empty($user)) {
            if (ID_TYPE == 0) {
                $res = true;
            } elseif (ID_TYPE == 1) {
                if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
                    $res = false;
                    self::_error(ERROR_ID_PATTERN_ERROR);
                } else {
                    $res = true;
                }
            } elseif (ID_TYPE > 1) {
                if (preg_match(ID_PATTERN[ID_TYPE - 2], $user)) {
                    $res = true;
                } else {
                    $res = false;
                    self::_error(ERROR_ID_PATTERN_ERROR);
                }
            }
        }
        return $res;
    }


    /**
     * Create an user and add a log
     *
     * @param mixed $user
     * @param mixed $pass
     * @param int $rights
     * @param string $phone
     *
     * @return
     */
    private static function _createUser($user, $pass, $rights = 1, $phone = null)
    {
        $pdo = self::_initPdo();
        $result = self::_getBDD(
            "SELECT user_id FROM " . DATABASE_PREFIX . "registrations 
            WHERE user_id = ?",
            array($user)
        );
        if (count($result) == 0) {
            if (self::_checkUserID($user)) {
                $password = self::_validPasswd($pass);
                self::_setBDD(
                    "INSERT INTO " . DATABASE_PREFIX . "registrations 
                    (user_id, password, rights, active, password_birth)
                    VALUES (?, ?, ?, ?, ?)",
                    array($user, $password, $rights, 1, time())
                );
                self::_error(ERROR_OK);
                //self::_log("user created", 10, $pdo->lastInsertId());
            } else {
                self::_error(ERROR_ID_PATTERN_ERROR);
                //self::_log("user create attempt failed", 10);
            }
        } else {
            self::_error(ERROR_ID_ALREADY_EXISTS);
        }

    }


    /**
     * Check the lifetime of the password registered on database
     *
     * @param timestamp $passwordBirthday registered on database
     *
     * @return $res;
     */
    private static function _checkPasswordLifetime($passwordBirthday)
    {
        if (($passwordBirthday + (PASSWORD_LIFE * 86400)) < time()) {
            $res = 0;
        } else {
            $res = 1;
        }
        return $res;
    }


    /**
     * Update rights on database
     *
     * @param int $rights is the element to update on database
     * @param mixed $user is the ID of user for WHERE condition
     *
     * @return void
     */
    public static function _updateRights($rights, $user)
    {
        if (self::_updateBDD(
            "UPDATE " . DATABASE_PREFIX . "
            registrations SET rights = ? WHERE user_id = ?",
            array($rights, $user))) {
            self::_error(ERROR_OK);
        } else {
            self::_error(ERROR_UPDATE_FAILED);
        }
    }


    /**
     * Update active on database
     *
     * @param int $active is the element to update on database
     * @param mixed $user is the ID of user for WHERE condition
     *
     * @return void
     */
    public static function _updateActive($active, $user)
    {
        if ($active == 0 || $active == 1) {
            if (self::_updateBDD(
                "UPDATE " . DATABASE_PREFIX . "
                registrations SET active = ? WHERE user_id = ?",
                array($active, $user))) {
                self::_error(ERROR_OK);
            } else {
                self::_error(ERROR_UPDATE_FAILED);
            }
        } else {
            self::_error(ERROR_ACTIVE);
        }
    }


    /**
     * Update user ID
     *
     * @param mixed $oldUser
     * @param mixed $newUser
     *
     * @return void
     */
    public static function _updateUserID($oldUser, $newUser)
    {
        if ($newUser != $oldUser) {
            $result = self::_getBDD(
                "SELECT user_id FROM " . DATABASE_PREFIX . "registrations 
            WHERE user_id = ? OR user_id = ?", array($oldUser, $newUser)
            );
            if ((isset($result[0]['user_id'])
                    && $result[0]['user_id'] == $oldUser)
                || (isset($result[1]['user_id'])
                    && $result[1]['user_id'] == $oldUser)
            ) {
                if ((isset($result[0]['user_id'])
                        && $result[0]['user_id'] == $newUser)
                    || (isset($result[1]['user_id'])
                        && $result[1]['user_id'] == $newUser)
                ) {
                    self::_error(ERROR_ID_ALREADY_EXISTS);
                } else {
                    if (self::_checkUserID($newUser)) {
                        self::_setBDD(
                            "UPDATE " . DATABASE_PREFIX . "registrations SET user_id = ? 
                            WHERE user_id = ?",
                            array($newUser, $oldUser)
                        );
                        self::_error(ERROR_OK);
                    } else {
                        self::_error(ERROR_ID_PATTERN_ERROR);
                    }
                }
            } else {
                self::_error(ERROR_ID_DOESNT_EXIST);
            }
        } else {
            self::_error(ERROR_ID_NEW_USERID_EQUAL_OLD_USER_ID);
        }
    }


    /**
     * Update a new password
     * and store on database old passwords
     * If PASSWORD_REGISTER is ON, user won't be able to
     * register an old password
     *
     * @param mixed $user_id
     * @param mixed $newPassword
     *
     * @return void
     */
    private static function _updatePassword($user_id, $newPassword)
    {
        $result = self::_getBDD(
            "SELECT old_password FROM " . DATABASE_PREFIX . "registrations 
            WHERE user_id = ?",
            array($user_id)
        );
        if (isset($result[0]['old_password'])
            || (isset($result[0])
                && is_null($result[0]['old_password']))
        ) {
            $arrayPassword = json_decode($result[0]['old_password'], true);
            if (is_null($arrayPassword)) {
                $arrayPassword = array();
            }
            $currentPass = self::_getBDD(
                "SELECT password FROM " . DATABASE_PREFIX . "registrations 
                WHERE user_id = ?",
                array($user_id)
            );
            if (isset($currentPass[0]['password'])) {
                $arrayPassword[] = $currentPass[0]['password'];
            }
            $isOldPassword = 0;
            foreach ($arrayPassword as $value) {
                if (PASSWORD_REGISTER == 1
                    && $isOldPassword == 0
                    && password_verify($newPassword, $value)
                ) {
                    $isOldPassword = 1;
                    self::_error(ERROR_PASSWORD_ALREADY_EXISTS);
                }
            }
            if ($isOldPassword == 0) {
                $validPassword = self::_validPasswd($newPassword);
                if ($validPassword) {
                    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                    while (count($arrayPassword) > PASSWORD_MAX_REGISTER) {
                        array_shift($arrayPassword);
                    }
                    self::_setBDD(
                        "UPDATE " . DATABASE_PREFIX . "registrations 
                        SET old_password = ?, password = ? WHERE user_id = ?",
                        array(json_encode($arrayPassword), $newPasswordHash, $user_id)
                    );
                }
            }
        } else {
            self::_error(ERROR_ID_DOESNT_EXIST);
        }
    }


    /**
     * My session start function support timestamp management
     *
     * @return void
     */
    private static function _sessionStart()
    {
        session_start();
        // Do not allow to use too old session ID
        if (!empty($_SESSION[SESSION_ARRAY_USER_INFO]['deleted_time'])
            && $_SESSION[SESSION_ARRAY_USER_INFO]['deleted_time'] < time() - SESSION_TIME_BEFORE_DECO
        ) {
            session_destroy();
            session_start();
        }
    }



    /**
     * Destroy the active/actual session
     *
     * @return void
     */
    public static function resetSession()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
        session_start();
    }


    /**
     *
     */
    private static function changePassword()
    {
        if (isset($_GET['password_forgotten'])){
            header("Location: " . LOGIN_PAGE . "?password_forgotten");
        } elseif (isset($_GET['change_password'])){
            header("Location: " . LOGIN_PAGE . "?change_password");
        }
    }


    /**
     *
     */
    private static function _checkForm()
    {
        if (isset($_POST) && isset($_POST['user_id']) && isset($_POST['password'])) {
            self::_connection($_POST['user_id'], $_POST['password']);
        } elseif (isset($_GET['disconnect'])) {
            self::resetSession();
        } elseif (isset($_GET['lost_password'])) {
            self::_passwordForgotten();
        } elseif (isset($_GET['change_password'])) {
            self::changePassword();
        }
        if (isset($_POST['reg'])){
            $reg = $_POST['reg'];
            self::_addRegister($reg);
        }
        if (isset($_POST['auth'])){
            $auth = $_POST['auth'];
            self::_updateRegister($auth);
        }
    }


    /**
     * Check if an user is connected and have fill
     * SESSION variable
     *
     * @return $res
     */
    //self::_validSession($_SESSION[SESSION_ARRAY_USER_INFO]
    private static function _isUserConnected()
    {
        $res = false;
        if (isset($_SESSION)) {
            if (isset($_SESSION[SESSION_ARRAY_USER_INFO])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['session_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['ipv4'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['rights'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_agent'])
            ) {
                $token = session_id() . $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SERVER['REMOTE_ADDR'] . $_SESSION[SESSION_ARRAY_USER_INFO]['rights'] . $_SERVER['HTTP_USER_AGENT'];
                $data = self::_getBDD("SELECT * FROM " . DATABASE_PREFIX . "registrations
                WHERE user_id = ?",
                    array($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                );
                if (password_verify($token, $data[0]['token'])) {
                    self::$currentUser = $data[0];
                    $res = true;
                }
            }
        }
        return $res;
    }


    /**
     * @return bool
     */
    public function readUserConnected()
    {
        return ($this->userConnected);
    }


    /**
     * @return bool
     */
    public function readUser2FAConnected()
    {
        return $this->user2FAConnected;
    }


    /**
     * Check if user is connected with 2FA system
     * or not
     */
    private static function _isUser2FAConnected()
    {
        $res = false;
        $data = self::_getBDD("SELECT * FROM " . DATABASE_PREFIX . "registrations
        WHERE user_id = ?",
            array($_SESSION[SESSION_ARRAY_USER_INFO]['user_id']));
        if (DOUBLEFA == 0) {
            $res = true;
        } else { //process to check SMS token
            if (isset($_SESSION[SESSION_ARRAY_USER_INFO]) && DOUBLEFA == 1) {
//                //var_dump($_SESSION);
//                if (isset($_SESSION[SESSION_ARRAY_USER_INFO])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['phone_number'])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['random_number'])) {
//                    $token = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SESSION[SESSION_ARRAY_USER_INFO]['phone_number'] . $_SESSION[SESSION_ARRAY_USER_INFO]['random_number'];
//                    //var_dump($token);
//                    $res = password_verify($token, $data[0]['tokenSMS'])
//                    }
            }elseif (isset($_SESSION[SESSION_ARRAY_USER_INFO]) && DOUBLEFA == 2){
                //process to check U2F token
                if (isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'])) {
                    $token = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'];
//                    $tokenHash = password_hash($token, PASSWORD_BCRYPT);
                    $res = password_verify($token, $data[0]['tokenU2F']);
                }
            }
        } return $res;
    }


    /**
     * Connect an user to his panel
     * Set a delay or not if number of attemps failed
     * more than constant is defined.
     *
     * @param $user_id
     * @param $password
     */
    private static function _connection($user_id, $password)
    {
        $res = self::_getBDD("SELECT *
        FROM " . DATABASE_PREFIX . "registrations 
        WHERE user_id = ?",
            array($user_id));
        //check if user_id is here, and different to parameter
        if (!isset($res[0]['user_id']) || $res[0]['user_id'] != $user_id) {
            self::_error(ERROR_CONNECTION);
        //else if user is not active
        } elseif ($res[0]['active'] == 0
            && ($res[0]['delay_password'] > time()
                || $res[0]['delay_password'] == 0)) {
            if (PASSWORD_DELAY_BEFORE_RETRY == 0) {
                self::_error(ERROR_USER_NOT_ACTIVE);
            } else {
                self::_error(ERROR_ACCOUNT_TEMPORARILY_DISABLED);
            }
            //else if password doesn't match
        } elseif (!password_verify($password, $res[0]['password'])) {
            // if const is different to 0
            if (PASSWORD_ATTEMPT_ERROR != 0) {
                $password_error = $res[0]['password_error'];
                $password_error++;
                //update number of password_error
                self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations 
                        SET password_error = ?, 
                        active = ?
                        WHERE user_id = ?",
                    array($password_error, 1, $user_id)
                );
                self::_error(ERROR_CONNECTION);
                //if password_error number is equal or lower than const
                if ($password_error < PASSWORD_ATTEMPT_ERROR) {
                    self::_error(ERROR_COUNTDOWN_PASSWORDS, PASSWORD_ATTEMPT_ERROR - $password_error);
                //else if password_error number is higher than const
                } elseif ($password_error >= PASSWORD_ATTEMPT_ERROR) {
                    //declare a delay + const*60
                    //declare un delai + la constante*60 (conversion en secondes)
                    if (PASSWORD_DELAY_BEFORE_RETRY == 0) {
                        $delay = 0;
                        self::_error(ERROR_USER_NOT_ACTIVE);
                    } else {
                        $delay = time() + (PASSWORD_DELAY_BEFORE_RETRY * 60);
                        self::_error(ERROR_ACCOUNT_TEMPORARILY_DISABLED);
                    }
                    //reset active field, number of password_error and add delay
                    self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                            SET active = ?, password_error = ?, delay_password = ?
                            WHERE user_id = ?",
                        array(0, 0, $delay, $user_id)
                    );
                }
            } else {
                //if const is set to 0, display an error connection alert
                self::_error(ERROR_CONNECTION);
            }
        } else {
            $data = session_id() . $user_id . $_SERVER['REMOTE_ADDR'] . $res[0]['rights'] . $_SERVER['HTTP_USER_AGENT'];
            self::$currentUser = $res[0];
            $_SESSION[SESSION_ARRAY_USER_INFO]['session_id'] = session_id();
            $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] = $user_id;
            $_SESSION[SESSION_ARRAY_USER_INFO]['ipv4'] = $_SERVER['REMOTE_ADDR'];
            $_SESSION[SESSION_ARRAY_USER_INFO]['rights'] = $res[0]['rights'];
            $_SESSION[SESSION_ARRAY_USER_INFO]['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
            $_SESSION[SESSION_ARRAY_USER_INFO]['id'] = self::$currentUser['id'];

            $_SESSION[SESSION_ARRAY_USER_INFO]['token'] = password_hash($data, PASSWORD_BCRYPT);

            $_SESSION[SESSION_ARRAY_USER_INFO]['connection_date'] = time();

            self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                   SET password_error = ?,
                    token = ?,
                    connection_date = ?,
                    delay_password = ?
                    WHERE user_id = ?",
                array(0, $_SESSION[SESSION_ARRAY_USER_INFO]['token'], time(), 0, $user_id)
            );
//            error_debug("ERRORINFO", $_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'] . $_SESSION[SESSION_ARRAY_USER_INFO]['errorText']);
        }

    }


    /**
     * This function is only if you want to
     * disable user and reset delay_password "manually"
     *
     * @param $user_id
     */
    public function disableUser($user_id)
    {
        self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations 
        SET delay_password = ?,
        active = ?
        WHERE user_id = ?",
            array(0, 0, $user_id)
        );
    }


    /**
     * Prepare parameter for JS
     */
    public static function _readU2FRegisterParam(){
        echo '<script>';
        echo 'var req = '.$_SESSION[SESSION_ARRAY_USER_INFO]['regReq'].';';
        echo 'var sigs = '.$_SESSION[SESSION_ARRAY_USER_INFO]['sigs'].';';
        echo 'var username = \''.$_SESSION[SESSION_ARRAY_USER_INFO]['user_id'].'\';';
        echo 'setTimeout(function (){u2fRegisterKey();}, 1000); ';
        echo '</script>';
    }


    /**
     * Prepare parameter for JS
     */
    public static function _readU2FAuthenticateParam()
    {
        echo '<script>';
        $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'];
        echo 'var req = '.$_SESSION[SESSION_ARRAY_USER_INFO]['req'].';';
        echo 'var username = \''.$_SESSION[SESSION_ARRAY_USER_INFO]['user_id'].'\';';
        echo 'setTimeout(function (){u2fSignKey();}, 1000); ';
        echo '</script>';
    }


    /**
     * Init key U2F
     *
     * @param $user_id
     */
    public static function _initKey(){
        $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
        if (self::$currentUser['u2f_key_handle'] == null){
            try {
                //create challenge and get authentifications (if there are some)
                // according to keys registered on database
                $data = $u2f->getRegisterData();
                list($req, $sigs) = $data;
                $_SESSION[SESSION_ARRAY_USER_INFO]['regReq'] = json_encode($req);
                $_SESSION[SESSION_ARRAY_USER_INFO]['req'] = json_encode($req);
                $_SESSION[SESSION_ARRAY_USER_INFO]['sigs'] = json_encode($sigs);
                $_SESSION[SESSION_ARRAY_USER_INFO]['id'] = self::$currentUser['id'];
            } catch (Exception $e) {
                error_debug("getRegister", $e);
            }
        } else {
            try {
                //$res has to be an object
                $keyHandleObj = array((object) array("keyHandle" => self::$currentUser['u2f_key_handle']));
                error_debug("authentification nouvelle clef");
                $req = json_encode($u2f->getAuthenticateData($keyHandleObj));//appel de la fonction $u2f->getAuthenticateDate($u2f qui est un tableau $sigs contenant l'objet $sig)
                $_SESSION[SESSION_ARRAY_USER_INFO]['authReq'] = $req; //est stocké dans 'authReq' le resultat $reqs
                $_SESSION[SESSION_ARRAY_USER_INFO]['req'] =  $req; //prepare une variable JS de $reqs en cdc
                $_SESSION[SESSION_ARRAY_USER_INFO]['id'] = self::$currentUser['id'];
                $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] =  self::$currentUser['user_id']; //prepare une variable JS de $user
                $_SESSION[SESSION_ARRAY_USER_INFO]['publicKey'] = self::$currentUser['u2f_public_key'];
                $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] = self::$currentUser['u2f_key_handle'];
                $_SESSION[SESSION_ARRAY_USER_INFO]['counter'] = self::$currentUser['u2f_counter'];
            } catch (Exception $e) {
                error_debug("getAuthenticate", $e);
            }
        }
    }


    /**
     * Add a registration on database
     *
     * @param mixed $reg is encoded Json from xhr JS request
     */
    private static function _addRegister($reg)
    {
        $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
        if (isset($_SESSION[SESSION_ARRAY_USER_INFO]['regReq'])){
            $reg1 = $u2f->doRegister(json_decode($_SESSION[SESSION_ARRAY_USER_INFO]['regReq']), json_decode($reg));
            $dataU2F = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $reg1->keyHandle . $reg1->publicKey . $reg1->certificate;
            $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] = $reg1->keyHandle;
            $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'] = $reg1->publicKey;
            $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'] = $reg1->certificate;
            $dataU2FHash = password_hash($dataU2F, PASSWORD_BCRYPT);
            $_SESSION[SESSION_ARRAY_USER_INFO]['tokenU2F'] = $dataU2FHash;
            //add registration
            self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                SET u2f_key_handle = ?,
                u2f_public_key = ?,
                u2f_certificate = ?,
                u2f_counter = ?,
                tokenU2F = ?
                WHERE user_id = ?",
                array($reg1->keyHandle, $reg1->publicKey, $reg1->certificate, $reg1->counter, $dataU2FHash, $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
            );
        } else {
            $_SESSION['regReq'] = null;
        }
    }


    /**
     * Authenticate user with u2fKey
     *
     * @param mixed $auth is encoded Json from xhr JS request
     */
    private static function _updateRegister($auth)
    {

        $res = json_decode($auth);
        if(isset($res->errorCode) && $res->errorCode !==0){
            self::resetSession();
            self::_error(14);
        } else {
            $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
            $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
            if (isset($_SESSION[SESSION_ARRAY_USER_INFO]['authReq'])){
                $keyHandleObj = array((object) array("keyHandle" => $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'], "publicKey" => $_SESSION[SESSION_ARRAY_USER_INFO]['publicKey'], "counter" => $_SESSION[SESSION_ARRAY_USER_INFO]['counter']));
                $reg2 = $u2f->doAuthenticate(json_decode($_SESSION[SESSION_ARRAY_USER_INFO]['authReq']), $keyHandleObj, json_decode($auth));
                if (isset ($reg2)
                    && $reg2->counter > $_SESSION[SESSION_ARRAY_USER_INFO]['counter']
                    && ($reg2->counter == -1 || $reg2->counter >= 0)){
                    //we must call the function getBDD here, because $currentUser was not loaded before.
                    //and we absolutely need no load session variables to check if token matches on function isUser2FAconnected
                    self::$currentUser  = self::_getBDD("SELECT * FROM ".DATABASE_PREFIX."registrations 
                    WHERE user_id = ?",
                        array($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                    )[0];
                    $dataU2F = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] . self::$currentUser['u2f_public_key'] . self::$currentUser['u2f_certificate'];
                    $dataU2FHash = password_hash($dataU2F, PASSWORD_BCRYPT);
                    //met a jour l'element $reg
                    self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                    SET u2f_counter = ?,
                    tokenU2F = ?
                    WHERE user_id = ?",
                        array($reg2->counter, $dataU2FHash, $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                    );
                    $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'] = self::$currentUser['u2f_public_key'];
                    $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'] = self::$currentUser['u2f_certificate'];
                    self::_error(0);
                } else {
                    self::resetSession();
                    self::_error(14);
                }
            } else {
                $_SESSION['authReq'] = null;
            }
        }
    }


    /**
     * Will check global var $userConnected and $user2FAConnected
     * if one of them or both are true,
     * function will redirect, or init HTML code, or init Key
     * if is_Ajax is set, it will store errors for
     * display on console command on your browser
     *
     * @param $userConnected
     * @param $user2FAConnected
     */
    public function _loginForm($userConnected, $user2FAConnected)
    {
        self::_isAjax();
            if ($_SERVER['PHP_SELF'] != LOGIN_PAGE
            && !$userConnected
            && !$user2FAConnected
            ) {
                if (LOGIN_PAGE == "AUTO") {
                   $this->getHTMLLoginCode($userConnected);
                } else {
                header("Location: " . LOGIN_PAGE . "?redirect=" . urlencode($_SERVER['PHP_SELF']));
                }
                exit();
            } elseif ($_SERVER['PHP_SELF'] != LOGIN_PAGE
                && $userConnected
                && !$user2FAConnected){
                    self::_initKey();
                if (LOGIN_PAGE == "AUTO") {
                    $this->getHTMLLoginCode($userConnected);
                } else {
                header("Location: " . LOGIN_PAGE);
                }
                exit();
            } elseif ($_SERVER['PHP_SELF'] == LOGIN_PAGE
                && $userConnected
                && $user2FAConnected){
                header("Location: ".BASEPAGE);
                exit();
            }
    }


    /**
     * Redirect form action
     *
     * @return string
     */
    public static function _getRedirectPage()
    {
        if (isset($_GET['redirect'])) {
            $res = urldecode($_GET['redirect']);
        } else {
            $res = BASEPAGE;
        }
        return $res;
    }


    /**
     * If $_POST['ajax] is set, it will store errors for
     * display on console command on your browser
     */
    private static function _isAjax()
    {
        if (isset ($_POST['ajax'])){
            echo json_encode(self::getLastError());
            exit();
        }
    }


    /**
     * Prepare parameter for JS
     */
    private static function _pageJSParameters(){
        if (LOGIN_PAGE == "AUTO") {
            echo '<script>';
            echo 'var selfPage = \'' . $_SERVER['PHP_SELF'] . '\';';
            echo '</script>';
        } else {
            echo '<script>';
            echo 'var selfPage = \'' . LOGIN_PAGE . '\';';
            echo '</script>';
        }
    }


    /**
     * Will generate HTML code
     *
     * @param $userConnected
     */
    public function getHTMLLoginCode($userConnected)
    {
        //var_dump($_SESSION[SESSION_ARRAY_USER_INFO]);
        if (LOGIN_PAGE == 'AUTO'){
            $loginPage = $_SERVER['PHP_SELF'];
        }else {
            $loginPage = LOGIN_PAGE;
        }
            if(isset($_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'])
            || isset ($_SESSION[SESSION_ARRAY_USER_INFO]['errorText'])){
                echo '<style type="text/css"> p{font-weight: bold; color: #9b4dca}</style>
                <p>'. $_SESSION[SESSION_ARRAY_USER_INFO]['errorText'].'</p>';
            unset($_SESSION[SESSION_ARRAY_USER_INFO]['errorCode']);
            unset($_SESSION[SESSION_ARRAY_USER_INFO]['errorText']);
            }
            echo ' <!DOCTYPE html>
            <html>
            <head>
            <meta charset="utf-8" />
            <link rel="stylesheet" href="dist/milligram.css">
            <!--<link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">-->';
            self::_pageJSParameters();
            echo '<script src="2fa4users.js"></script>';
            if (DOUBLEFA == 2){
                echo '<script src="U2F/u2f-api.js"></script>';
            }
                echo'<title>'.TEXT_LANG[LANG][0].'</title>
                </head>
                <body>';
            if (!$userConnected){
                echo '
                <div class="container">
                    <div class="row">
                        <div class="column column-25"></div>
                        <div class="column">
                        <h1>'.TEXT_LANG[LANG][1].'</h1>
                            <form method="post" action="'.$_SERVER['PHP_SELF'].'">
                                <div>
                                    <input type="text" name="user_id" id="phpLibUserConnectedLastNameField" placeholder="'.TEXT_LANG[LANG][2].'">
                                    <input type="password" name="password" id="phpLibUserConnectedFirstNameField" placeholder="'.TEXT_LANG[LANG][3].'">
                                    <div class="row">
                                        <div class="column column-10 "></div>
                                        <div class="column column-80 "> 
                                            <input class="button-primary" type="submit" value="'.TEXT_LANG[LANG][4].'" style="width: 100%">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    <div class="column column-25"></div>
                    </div>
                </div> ';
            } elseif ($userConnected
                && !isset($_SESSION[SESSION_ARRAY_USER_INFO]['publicKey']))
            {
                self::_readU2FRegisterParam();
                echo ' <div id="phpLibUserConnectedScreen">
                    <div id="phpLibUserConnectedForm">
                        <h2>'.TEXT_LANG[LANG][6].'</h2>
                                <fieldset>
                                <br/>
                                <p style="display: none; font-weight: bold; color: #9b4dca" id="phpLibUserConnectedDelayRegister">'.TEXT_LANG[LANG][7].'</p>
                                <button onclick="u2fRegisterKey(); displayDelayRegister()" id="phpLibUserConnectedRegister" style="display: none">'.TEXT_LANG[LANG][8].'</button>
                            </fieldset>
                    </div>
                </div>';
            } elseif ($userConnected
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['publicKey']))
            {
                self::_readU2FAuthenticateParam();
                echo ' <div id="phpLibUserConnectedScreen">
                    <div id="phpLibUserConnectedForm">
                        <h2>'.TEXT_LANG[LANG][9].'</h2>
                            <fieldset>
                                <br/>
                                <p style="display: none; font-weight: bold; color: #9b4dca" id="phpLibUserConnectedDelayAuthenticate">'.TEXT_LANG[LANG][10].'</p>
                                <button onclick="u2fSignKey(); displayDelayAuthenticate()" id="phpLibUserConnectedAuthenticate" style="display: none">'.TEXT_LANG[LANG][11].'</button>
                            </fieldset>
                    </div>
                </div>';
            }
            echo '</body> </html>';
    }


    
    public static function _getHTMLCode(){
        //js functions
    }


//TODO : improve library by doing a read folder. It have to be able to check if "require '2FA4Users.php'" is setted on each files on the app
//TODO : sould be able to disconnect user after few seconds on the app if there is no response from user (key down, mouse event...)
//TODO : sould be able to update password on demand
//TODO : sould be able to reinitiate password when users forgot them
//TODO : have to set SMS authentification
//TODO : include js functions in this file. Everything have to works with only one file
//TODO : change const name
//TODO : add logs 

}


ini_set('session.use_strict_mode', 1);
error_debug("Librairie.php : ", $_SERVER['PHP_SELF']);
$user = new userLibrary();
