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

//namespace u2fLibConnectedUser;//a changer

/**
 * Double authenticate way:
 * 0(none)
 * 1(SMS)
 * 2(Key U2f)
 */
const DOUBLEFA = 0;

/**
 * Short message text for SMS authenticate
 * Change as you want
 */
const DOUBLEFA_SMS_TEXT = "this is your code";

/**
 * The kind of ID for user connect
 * 0 no check
 * 1 email
 * 2 array of pattern
 */
const ID_TYPE = 1;

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

/**
 * Number of attempt failed
 * 0(desactivate)
 * 1(1)
 * 2(2)
 * ...
 */
const PASSWORD_ERROR = 0;

//si le développeur rentre un chiffre entre 1 et 7,
// 8 lettres seront prises en compte obligatoirement
/**
 * Password lenght
 * 8(8 lettres)
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
 * this constant define how many old passowrds
 * could be stored in database before purge the first one
 * who is the older stored
 */
const PASSWORD_MAX_REGISTER = 5;

/**
 * Automatic disconnection after few minutes
 * 1(1 min)
 * 2(2 min)
 * ...
 */
const AUTO_DISCONNECT = 0;

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

/**
 * Activate/Desactivate forcing browsers to connect with HTTPS protocol
 */
const FORCE_SSL = 0;

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

const ERROR_TEXT = array(
    "OK",
    "Password trop court",
    "Mot de passe trop faible",
    "Identifiant ne correspond pas au pattern",
    "Cet utilisateur existe deja",
    "La mise a jour de l'element a echouee",
    "L'element actif ne prend que 0 ou 1",
    "Cet utilisateur n'existe pas",
    "Le nouvel identifiant est identique a l'ancien",
    "Le mot de passe est un ancien mot de passe deja enregistre"
);

/**
 * Library version
 */
const VERSION_LIB = 001;

/**
 * Define time for session active before deconnection
 */
const SESSION_TIME_BEFORE_DECO = 300;

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
class Library
{
    public static $lastErrorCode;
    public static $lastErrorText;

    /**
     * Library constructor.
     */
    public function __construct()
    {
        //Valide self::_log("Connexion", 1, 1);
        //Valide self::_initPdo();
        //self::_setBDD("INSERT INTO ".DATABASE_PREFIX."Registrations (`user`)
        // VALUES (?)", array('michel'));
        //Valide self::_initTable($pdo);
        //valide self::_createPasswd("p?0Awetpwet?");
        //valide self::_checkUserID("jean?");
        //valide pour les 3 SGBD
        //self::_createUser("jb", "pwert?0Ayuetpwet");
        //valide pour les 3 SGBD self::_updateRights(4, "jb");
        //valide echo self::_checkPasswordLifetime(time()-864000);
        //self::_updateActive();
        //valide self::_updateUserID("jb", "jf@gmail.fr");
        //valide self::_updatePassword("cquetuveux", "qwertyui11");
    }


    /**
     * Set error on var and
     * Return last error
     *
     * @param int $errorCode error number
     *
     * @return void
     */
    private static function _error($errorCode)
    {
        self::$lastErrorCode = $errorCode;
        self::$lastErrorText = ERROR_TEXT[$errorCode];
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
            $res = $pdo->exec(
                "CREATE TABLE if not exists `".DATABASE_PREFIX."registrations`( 
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
            `password_birth` INTEGER NOT NULL)
            ENGINE = InnoDB "
            );
        } elseif (DATABASE_TYPE == 2) {
            $pdo->exec(
                'CREATE TABLE if not exists '.DATABASE_PREFIX.'registrations (
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
            CONSTRAINT '.DATABASE_PREFIX.'Registrations_pkey PRIMARY KEY ("id"))
            WITH (OIDS = FALSE)
            TABLESPACE pg_default;'
            );
        } elseif (DATABASE_TYPE == 3) {
            $pdo->exec(
                'CREATE TABLE if not exists '.DATABASE_PREFIX.'registrations (
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
            "password_birth"	INTEGER NOT NULL );'
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
                'mysql:host=' . DATABASE_HOST.
                    ';dbname='.DATABASE_NAME,
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
     * @param string $req   request
     * @param mixed  $param is the element to read on database
     *
     * @return $res
     */
    private static function _getBDD($req, $param)
    {
        $pdo = self::_initPdo();
        $get = $pdo->prepare($req);
        var_dump($pdo->errorInfo());
        $get->execute($param);
        var_dump($pdo->errorInfo());
        $res = $get->fetchAll();
        return $res;
    }
    /**
     * Request to set elements on database
     *
     * @param string $req   request
     * @param array  $param is the element to add on database
     */
    private static function _setBDD($req, $param)
    {
        $pdo = self::_initPdo();
        $set = $pdo->prepare($req);
        var_dump($pdo->errorInfo());
        $set->execute($param);
        var_dump($set->errorInfo());
        //self::_log($error, 10, 1);
    }


    /**
     * Register log on defined file with LOG_PATH
     * create a new log file each day
     *
     * @param string $action  describe the log
     * @param int    $level   level of numbers of enabled logs
     * @param int    $user_id used to find who created the log
     */
    private static function _log($action, $level, $user_id = null)
    {
        if (LOG > 0 && LOG >= $level) {
            $file = LOG_PATH . 'log-'.date('Y-m-d').'.txt';
            if (!file_exists($file)) {
                $text = " Date ; User id ; Action \n";
                file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
            }
            $date = date('d/m/Y H:i:s');
            //CSV format
            $text = $date.';'.$user_id.';'.$action."\n";
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
            $strength = count(PASSWORD_PATTERN)-1;
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
     * @param mixed  $user
     * @param mixed  $pass
     * @param int    $rights
     * @param string $phone
     *
     * @return
     */
    private static function _createUser($user, $pass, $rights=0, $phone=null)
    {
        $pdo = self::_initPdo();
        $result = self::_getBDD(
            "SELECT user_id FROM ".DATABASE_PREFIX."registrations 
            WHERE user_id = ?",
            array($user)
        );
        if (count($result) == 0) {
            if (self::_checkUserID($user)) {
                $password = self::_validPasswd($pass);
                self::_setBDD(
                    "INSERT INTO ".DATABASE_PREFIX."registrations 
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
        if (($passwordBirthday + (PASSWORD_LIFE*86400)) < time()) {
            $res = 0;
        } else {
            $res = 1;
        }
        return $res;
    }



    /**
     * Update rights on database
     *
     * @param int   $rights is the element to update on database
     * @param mixed $user   is the ID of user for WHERE condition
     *
     * @return void
     */
    private static function _updateRights($rights, $user)
    {
        if (self::_updateBDD(
            "UPDATE ".DATABASE_PREFIX."
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
     * @param int   $active is the element to update on database
     * @param mixed $user   is the ID of user for WHERE condition
     *
     * @return void
     */
    private static function _updateActive($active, $user)
    {
        if ($active == 0 || $active == 1) {
            if (self::_updateBDD(
                "UPDATE ".DATABASE_PREFIX."
                registrations SET active = ? WHERE user_id = ?",
                array($active, $user))) {
                self::_error(ERROR_OK);
            }else{
                self::_error(ERROR_UPDATE_FAILED);
            }
        }else{
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
                "SELECT user_id FROM ".DATABASE_PREFIX."registrations 
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
                        "UPDATE ".DATABASE_PREFIX."registrations 
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
        // Do not allow to use too old session ID
        if (!empty($_SESSION['deleted_time'])
            && $_SESSION['deleted_time'] < time() - SESSION_TIME_BEFORE_DECO
        ) {
            session_destroy();
            session_start();
        }
    }


    /**
     * Regenerate session id
     *
     * @return void
     */
    private static function _sessionRegenerateId() 
    {
        // Call session_create_id() while session is active to
        // make sure collision free.
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
        // WARNING: Never use confidential strings for prefix!
        $newid = session_create_id('myprefix-');
        // Set deleted timestamp.
        // Session data must not be deleted immediately for reasons.
        $_SESSION['deleted_time'] = time();
        // Finish session
        session_commit();
        // Make sure to accept user defined session ID
        // NOTE: You must enable use_strict_mode for normal operations.
        ini_set('session.use_strict_mode', 0);
        // Set new custome session ID
        session_id($newid);
        // Start with custome session ID
        session_start();
    }

    /**
     * Destroy the active/actual session
     *
     * @return void
     */
    private static function _destroySession()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }



    //    /**
    //     * Disable an user account
    //     *
    //     * @param int $user_id is the element to disable on database
    //     *
    //     * @return true
    //     */
    //    private function _disable($user_id)
    //    {
    //        createLog(){}
    //    }
    //
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
    //    /**
    //     * Session disconnect user
    //     *
    //     * @return true
    //     */
    //    private function _deconnection()
    //    {
    //        $time = AUTO_DISCONNECT;
    //        session_destroy();
    //        createLog();
    //    }
    //
    //    /**
    //     * Check old passwords if user is able to or unable to register with
    //     *
    //     * @return true
    //     */
    //    private function _connectOld()
    //    {
    //        read(){
    //            create();
    //        }
    //        createLog();
    //    }
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

$test = new Library();
print_r($test::getLastError());
//if($test::_getLastError()[0] == ERROR_PASSWORD_TOO_SHORT){
//    ERROR_TEXT[ERROR_PASSWORD_TOO_SHORT];
//}