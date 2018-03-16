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
include "error_debug.php";

////////////////////////////////////////////////////////////////////////////////////
//****************************  DOUBLE AF CONSTANTS  *****************************//
////////////////////////////////////////////////////////////////////////////////////
/**
 * Double authenticate way:
 * 0 (none)
 * 1 (SMS)/(U2F)
 */
const DOUBLEFA = 1;

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
    "Tentative(s) de connexion restante(s): "
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
const FORCE_SSL = 0;
/**
 * Login page
 */
const LOGIN_PAGE = "/Librairie/login.php";
/**
 * Admin rights default number
 */
const ADMIN = 10000;

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
    const DEBUG = 1;

    /**
     * Library constructor.
     */
    public function __construct()
    {
        self::_sessionStart();
        self::_checkForm();
        $this->userConnected = self::_isUserConnected();
        var_dump(self::_isUserConnected());
        $this->user2FAConnected = self::_isUser2FAConnected();
        var_dump(self::_isUser2FAConnected());

        //Valide self::_log("Connexion", 1, 1);
        //self::_initPdo();
        //Valide self::_initTable($pdo);
        //valide self::_createPasswd("p?0Awetpwet?");
        //valide self::_checkUserID("jean?");
        //valide pour les 3 SGBD
        //self::_createUser("alfred", "qwertyuioP0?", 1);
        //self::_createUser("admin", "asdfghjkL;0", ADMIN);
        //valide pour les 3 SGBD self::_updateRights(4, "jb");
        //valide echo self::_checkPasswordLifetime(time()-864000);
        //self::_updateActive();
        //valide self::_updateUserID("jb", "jf@gmail.fr");
        //valide self::_updatePassword("cquetuveux", "qwertyui11");
        self::_loginForm($this->userConnected, $this->user2FAConnected);
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
     * Initiate a table in order of the databade type
     *
     * @param object $pdo is the pdo from the _initPDO() function
     *
     * @return void
     */
    private static function _initTable($pdo)
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
     * Initiate PDO
     *
     * @return $pdo
     */
    private static function _initPdo()
    {
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
        self::_initTable($pdo);
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
        if (self::DEBUG == 1)
            var_dump($pdo->errorInfo());
        $get->execute($param);
        if (self::DEBUG == 1)
            var_dump($pdo->errorInfo());
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
        if (self::DEBUG == 1)
            var_dump($pdo->errorInfo());
        $set->execute($param);
        if (self::DEBUG == 1)
            var_dump($set->errorInfo());
        //self::_log($error, 10, 1);
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
                //var_dump(preg_match(ID_PATTERN[ID_TYPE - 2], $user));
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
                self::_log("user created", 10, $pdo->lastInsertId());
            } else {
                self::_error(ERROR_ID_PATTERN_ERROR);
                self::_log("user create attempt failed", 10);
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
    private static function _updateRights($rights, $user)
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
    private static function _updateActive($active, $user)
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
    private static function _updateUserID($oldUser, $newUser)
    {
        if ($newUser != $oldUser) {
            $result = self::_getBDD(
                "SELECT user_id FROM " . DATABASE_PREFIX . "registrations 
            WHERE user_id = ? OR user_id = ?", array($oldUser, $newUser)
            );
            //var_dump($result);

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
        //var_dump($result[0]['old_password']);
        //var$result[0]['old_password'];
        if (isset($result[0]['old_password'])
            || (isset($result[0])
                && is_null($result[0]['old_password']))
        ) {

            $arrayPassword = json_decode($result[0]['old_password'], true);
            //var_dump($arrayPassword);
            if (is_null($arrayPassword)) {
                $arrayPassword = array();
            }
            $currentPass = self::_getBDD(
                "SELECT password FROM " . DATABASE_PREFIX . "registrations 
                WHERE user_id = ?",
                array($user_id)
            );
            //var_dump($currentPass);
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
                //var_dump($validPassword);
                if ($validPassword) {
                    //hashage du nouveau mot de passe
                    $newPasswordHash = password_hash($newPassword, PASSWORD_BCRYPT);
                    while (count($arrayPassword) > PASSWORD_MAX_REGISTER) {
                        array_shift($arrayPassword);
                    }

                    $result = self::_setBDD(
                        "UPDATE " . DATABASE_PREFIX . "registrations 
                        SET old_password = ?, password = ? WHERE user_id = ?",
                        array(json_encode($arrayPassword), $newPasswordHash, $user_id)
                    );
                    //var_dump($result);
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
        $_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'] = ERROR_OK;
        $_SESSION[SESSION_ARRAY_USER_INFO]['errorText'] = ERROR_TEXT[ERROR_OK];
        // Do not allow to use too old session ID
        if (!empty($_SESSION[SESSION_ARRAY_USER_INFO]['deleted_time'])
            && $_SESSION[SESSION_ARRAY_USER_INFO]['deleted_time'] < time() - SESSION_TIME_BEFORE_DECO
        ) {
            session_destroy();
            session_start();
        }
    }


    // penser a changer la valeur du strict-mode
// ************  ini_set('session.use_strict_mode', 1);  ***************
    /**
     * Regenerate session id
     *
     * @return void
     */
//    private static function _sessionRegenerateId()
//    {
//        // Call session_create_id() while session is active to
//        // make sure collision free.
//        if (session_status() != PHP_SESSION_ACTIVE) {
//            session_start();
//        }
//        // WARNING: Never use confidential strings for prefix!
//        $newid = session_create_id('myprefix-');
//        // Set deleted timestamp.
//        // Session data must not be deleted immediately for reasons.
//        $_SESSION[SESSION_ARRAY_USER_INFO]['deleted_time'] = time();
//        // Finish session
//        session_commit();
//        // Make sure to accept user defined session ID
//        // NOTE: You must enable use_strict_mode for normal operations.
//        ini_set('session.use_strict_mode', 0);
//        // Set new custome session ID
//        session_id($newid);
//        // Start with custome session ID
//        session_start();
//    }


    /**
     * Destroy the active/actual session
     *
     * @return void
     */
    public static function destroySession()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
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
        //var_dump($_POST);
        if (isset($_POST) && isset($_POST['user_id']) && isset($_POST['password'])) {
            self::_connection($_POST['user_id'], $_POST['password']);
        } elseif (isset($_GET['disconnect'])) {
            self::destroySession();
        } elseif (isset($_GET['lost_password'])) {
            self::_passwordForgotten();
        } elseif (isset($_GET['change_password'])) {
            self::changePassword();
        }
        if (isset($_POST['ajax'])){
            $reg = $_POST['reg'];
            //$user_id = $_POST['username'];
            self::_addRegister($reg);
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
            //var_dump($_SESSION);
            if (isset($_SESSION[SESSION_ARRAY_USER_INFO])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['session_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['ipv4'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['rights'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_agent'])
            ) {
                $token = session_id() . $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SERVER['REMOTE_ADDR'] . $_SESSION[SESSION_ARRAY_USER_INFO]['rights'] . $_SERVER['HTTP_USER_AGENT'];
                //var_dump($token);

                $data = self::_getBDD("SELECT * FROM " . DATABASE_PREFIX . "registrations
                WHERE user_id = ?",
                    array($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                );
                //var_dump($data);


                if (password_verify($token, $data[0]['token'])) {
                    //echo "comparaison OK";
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
        //var_dump($data);
        if (DOUBLEFA == 0) {
            $res = true;
        } else { //procedure verif token SMS && U2F
            if (isset($_SESSION)) {
//                //var_dump($_SESSION);
//                if (isset($_SESSION[SESSION_ARRAY_USER_INFO])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['phone_number'])
//                    && isset($_SESSION[SESSION_ARRAY_USER_INFO]['random_number'])) {
//                    $token = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SESSION[SESSION_ARRAY_USER_INFO]['phone_number'] . $_SESSION[SESSION_ARRAY_USER_INFO]['random_number'];
//                    //var_dump($token);
//                    if (password_verify($token, $data[0]['tokenSMS'])) {
//                        $res = true;
//                    }
            } elseif (isset($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'])
                && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'])) {
                $token = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'] . $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'];
                //var_dump($token);
                if (password_verify($token, $data[0]['tokenU2F'])) {
                    $res = true;
                }
            }
        }
        return $res;
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
        //recupere toute la ligne
        $res = self::_getBDD("SELECT *
        FROM " . DATABASE_PREFIX . "registrations 
        WHERE user_id = ?",
            array($user_id));

        //verifie si l'element user_id n'est pas presents et != du parametre
        if (!isset($res[0]['user_id']) || $res[0]['user_id'] != $user_id) {
            self::_error(ERROR_CONNECTION);

            //sinon si l'utilisateur n'est pas actif
        } elseif ($res[0]['active'] == 0
            && ($res[0]['delay_password'] > time()
                || $res[0]['delay_password'] == 0)) {
            if (PASSWORD_DELAY_BEFORE_RETRY == 0) {
                self::_error(ERROR_USER_NOT_ACTIVE);
            } else {
                self::_error(ERROR_ACCOUNT_TEMPORARILY_DISABLED);
            }

            //sinon si le mot de passe ne correspond pas
        } elseif (!password_verify($password, $res[0]['password'])) {

            // si la constante est != 0
            if (PASSWORD_ATTEMPT_ERROR != 0) {
                $password_error = $res[0]['password_error'];
                $password_error++;

                //mise a jour du nombre de password_error
                self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations 
                        SET password_error = ?, 
                        active = ?
                        WHERE user_id = ?",
                    array($password_error, 1, $user_id)
                );
                self::_error(ERROR_CONNECTION);

                //si le nombre de password_error inferieur ou egal constante
                if ($password_error < PASSWORD_ATTEMPT_ERROR) {
                    self::_error(ERROR_COUNTDOWN_PASSWORDS, PASSWORD_ATTEMPT_ERROR - $password_error);
                    //sinon si nombre de password_error superieur constante
                } elseif ($password_error >= PASSWORD_ATTEMPT_ERROR) {
                    //declare un delai + la constante*60 (conversion en secondes)
                    if (PASSWORD_DELAY_BEFORE_RETRY == 0) {
                        $delay = 0;
                        self::_error(ERROR_USER_NOT_ACTIVE);
                    } else {
                        $delay = time() + (PASSWORD_DELAY_BEFORE_RETRY * 60);
                        self::_error(ERROR_ACCOUNT_TEMPORARILY_DISABLED);
                    }

                    //mise a zero du champ actif, du nombre de password_error et ajout du delais
                    self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                            SET active = ?, password_error = ?, delay_password = ?
                            WHERE user_id = ?",
                        array(0, 0, $delay, $user_id)
                    );
                }
            } else {
                //si la constante est a zero, on affiche juste un message pour signaler
                //une erreur de connexion.
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
            $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key+handle'] = $res[0]['u2f_key_handle'];
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
//            self::_sessionRegenerateId();

            error_debug("ERRORINFO", $_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'] . $_SESSION[SESSION_ARRAY_USER_INFO]['errorText']);
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
     *
     */
    public static function _readU2FRegisterParam(){
        echo '<script>';
        echo 'var req = '.$_SESSION[SESSION_ARRAY_USER_INFO]['regReq'].';'; //prepare une variable JS de $req en cdc
        echo 'var sigs = '.$_SESSION[SESSION_ARRAY_USER_INFO]['sigs'].';'; //prepare une variable JS de $sigs en cdc
        echo 'var username = \''.$_SESSION[SESSION_ARRAY_USER_INFO]['user_id'].'\';';
        echo 'setTimeout(function (){u2fRegisterKey();}, 1000); ';
        echo '</script>';
    }


    /**
     * @param $user_id
     */
    public static function _initKey(){
        $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
        try {
            //Cree challenge et recupere authentification (s'il y a) en fonction
            //des clefs presentes en base
            //$user = array();
            //$user[] = (object) self::$currentUser;
            $data = $u2f->getRegisterData();
//            var_dump($data);
//            exit();
            //$data = $u2f->getRegisterData(self::$currentUser);
            list($req, $sigs) = $data;
            //Formate les elements en json pour un traitement en JS
            $_SESSION[SESSION_ARRAY_USER_INFO]['regReq'] = json_encode($req);
            $_SESSION[SESSION_ARRAY_USER_INFO]['req'] = json_encode($req);
            $_SESSION[SESSION_ARRAY_USER_INFO]['sigs'] = json_encode($sigs);
            $_SESSION[SESSION_ARRAY_USER_INFO]['id'] = self::$currentUser['id'];
            //echo "var username = '" . $user_id . "';";
        } catch (Exception $e) {
            //ne sera pas affiche en cas d'erreur a cause du header _loginForm
            echo "alert('error');";
            echo $e;
        }
    }


    /**
     *
     */
    private static function _addRegister($reg)
    {
        echo "ADDREGISTER";
        echo "\n";
        $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
        $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
            if (isset($_SESSION[SESSION_ARRAY_USER_INFO]['regReq'])){
                echo "reqReg present";
                //var_dump($_SESSION[SESSION_ARRAY_USER_INFO]['regReq']);
                echo "\n";
                //var_dump($reg);
//                exit();
                //parametres: (valeur de 'regReq', valeurs en chaine de register2)
                $reg1 = $u2f->doRegister(json_decode($_SESSION[SESSION_ARRAY_USER_INFO]['regReq']), json_decode($reg)); //est stocké dans $reg le resultat de la fonction doRegister presente dans U2F_olf.php
                $dataU2F = $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'] . $reg1->keyHandle . $reg1->publicKey . $reg1->certificate;
                //var_dump($dataU2F);

                $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'] = $reg1->keyHandle;
                $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_public_key'] = $reg1->publicKey;
                $_SESSION[SESSION_ARRAY_USER_INFO]['u2f_certificate'] = $reg1->certificate;
//                var_dump($_SESSION[SESSION_ARRAY_USER_INFO]);
                $dataU2FHash = password_hash($dataU2F, PASSWORD_BCRYPT);
                $_SESSION[SESSION_ARRAY_USER_INFO]['tokenU2F'] = $dataU2FHash;
//                var_dump($_SESSION[SESSION_ARRAY_USER_INFO]['tokenU2F']);
//                echo "\n";
//                //ajoute un enregistrement
                self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
                    SET u2f_key_handle = ?,
                    u2f_public_key = ?,
                    u2f_certificate = ?,
                    u2f_counter = ?,
                    tokenU2F = ?
                    WHERE user_id = ?",
                    array($reg1->keyHandle, $reg1->publicKey, $reg1->certificate, $reg1->counter, $dataU2FHash, $_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
                );
                echo "alert('success');";
            } else {
                $_SESSION['regReq'] = null; //la valeur regReq devient nulle
            }

    }


    /**
     *
     */
    //si pas sur page login.php et pas d'utlisateur connecte
    // renvoit sur la page de login
    // ET ensuite renvoit sur la page courante
    private static function _loginForm($userConnected, $user2FAConnected)
    {
        self::_isAjax();
        if ($_SERVER['PHP_SELF'] != LOGIN_PAGE
            && !$userConnected
        && !$user2FAConnected
        ) {
            header("Location: " . LOGIN_PAGE . "?redirect=" . urlencode($_SERVER['PHP_SELF']));
            exit();
        } elseif ($_SERVER['PHP_SELF'] != LOGIN_PAGE
            && $userConnected
            && !$user2FAConnected){
            self::_initKey();
            header("Location: " . LOGIN_PAGE);
        } elseif ($_SERVER['PHP_SELF'] != LOGIN_PAGE
            && $userConnected
            && $user2FAConnected){
            echo "connecté !";
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
            $res = "index.php";
        }
        return $res;
    }


    /**
     *
     */
    private static function _isAjax(){
       // var_dump($_POST);
        if (isset ($_POST['ajax'])){
            echo json_encode(self::getLastError());
            exit();
        }
    }


//    private static function _updateRegister()
//    {
//        $scheme = isset($_SERVER['HTTPS']) ? "https://" : "http://";
//        $u2f = new u2flib_server\U2F($scheme . $_SERVER['HTTP_HOST']);
//        $res = self::_getBDD("SELECT * FROM " . DATABASE_PREFIX . "registrations
//        WHERE user_id = ?",
//            array($_SESSION[SESSION_ARRAY_USER_INFO]['user_id'])
//        );
//
//        if ($_POST['authenticate2']){
//            //parametres: (valeur de 'authReq', clefs de l'utilisateur presentes en base , valeur en chaine de register2, )
//            $reg = $u2f->doAuthenticate(json_decode($_SESSION['authReq']), $res[0]['id'], json_decode($_POST['authenticate2'])); //est stocké dans $reg le resultat de la fonction doAuthenticate presente dans U2F_olf.php
//            //met a jour l'element $reg
//            self::_setBDD("UPDATE " . DATABASE_PREFIX . "registrations
//            SET counter = ?
//            WHERE id = ?",
//                array($reg['counter'], $reg['id'])
//            );
//            echo "alert('success');"; //affiche une boite de dialogue l'attribut counter de la classe Registration (-1)
//        } else {
//            $_SESSION['authReq'] = null; //la valeur authReq devient nulle
//        }
//    }



    //
    //    /**
    //     * Read folders and check if -require "lib"- is here
    //     *
    //     * @param string $path indicate path of root files of project
    //     *
    //     * @return true
    //     */
    //    private function _readFolder($path)
    //    {
    //    }
    //


    //
    //    /**
    //     * Disconnect user after few secondes
    //     *
    //     * @return true
    //     */
    //    private function _decoIfNoAnswer()
    //    {
    //        deconnection(){
    //            createLog(){}
    //        }
    //    }
    //
    //    /**
    //     * Should be able to update the library
    //     *
    //     * @return true
    //     */
    //    private function _upDateLib()
    //    {
    //
    //    }
    //
    //

}
if (FORCE_SSL == 0){
    $user = new userLibrary();
} else {
    $user = new userLibrary();
}

ini_set('session.use_strict_mode', 1);
//include "test";
//error_debug("ceci est un test de debug ");
//print_r(userLibrary::getLastError());
error_debug(userLibrary::getLastError()[0], userLibrary::getLastError()[1]);

//eviter les failles XSS:
//$pseudo = htmlspecialchars($_POST['pseudo']);
//echo "Bonjour ".$pseudo." !";
