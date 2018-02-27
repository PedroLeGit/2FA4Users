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
    '`^[[:alnum:]]{4,8}$`',
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
const PASSWORD_STRENGTH = 3;

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
 * Activate/desactivate if user could change his password with an old password
 * already registered by this user
 */
const PASSWORD_REGISTER = 0;

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
const DATABASE_TYPE = 3;

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
 * sqlite:nom_fichier.sqlite.db
 */
const DATABASE_NAME = "nom_fichier.sqlite.db";

/**
 * ID's you're using to connect on database
 */
const DATABASE_USER = "postgres";

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

const ERROR_PASSWORD_TOO_SHORT = 1;
const ERROR_PASSWORD_STRENGTH = 2;
const ERROR_ID_PATTERN_ERROR = 3;

const ERROR_TEXT = array(
    "OK",
    "password trop court",
    "mot de passe trop faible",
    "identifiant ne correspond pas au pattern"
);

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
        //self::_setBDD("INSERT INTO ".DATABASE_PREFIX."Registrations (`user`) VALUES (?)", array('michel'));
        //Valide self::_initTable($pdo);
        //valide self::_createPasswd("p?0Awetpwet?");
        self::_createUser("jean?", "pwert?0Ayuetpwet" );
        //valide echo self::_checkPasswordLifetime(time()-864000);
    }


    /**
     * Set error on var and
     * Return last error
     *
     * @param int $errorCode error number
     */
    private static function _error($errorCode){
        self::$lastErrorCode = $errorCode;
        self::$lastErrorText = ERROR_TEXT[$errorCode];
    }

    /**
     * Get last error
     *
     * @return array
     */
    public static function _getLastError(){
        return (array(self::$lastErrorCode, self::$lastErrorText));
    }


    /**
     *Initiate a table in order of the databade type
     *
     * @param object $pdo is the pdo from the _initPDO() function
     */
    private static function _initTable($pdo){
        if(DATABASE_TYPE == 1){
            $res = $pdo->exec("CREATE TABLE if not exists `".DATABASE_PREFIX."Registrations`( 
            `user_id` SERIAL NOT NULL AUTO_INCREMENT ,
            `user` VARCHAR(50) NOT NULL ,  
            `password` VARCHAR(60) NOT NULL ,
            `u2fKeyHandle` VARCHAR(255) NULL ,
            `u2fPublicKey` VARCHAR(255) NULL ,
            `u2fCertificate` TEXT NULL ,
            `u2fCounter` INT NULL ,
            `rights` INT NOT NULL ,
            `oldPassword` VARCHAR(255) NULL ,
            `active` BOOLEAN NOT NULL ,
            `phoneNumber` VARCHAR(10) NULL ,
            `versionLib` VARCHAR(50) NULL ,
            `ipv4` VARCHAR(15) NOT NULL ,
            `ipv6` VARCHAR(36) NULL ,
            `agePassword` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP )
            ENGINE = InnoDB;
            ");
        }elseif (DATABASE_TYPE == 2){
            $pdo->exec('CREATE TABLE if not exists '.DATABASE_PREFIX.'Registrations (
            "user_id" integer NOT NULL,
            "user" character varying(50) COLLATE pg_catalog."default" NOT NULL,
            "password" character varying(60) COLLATE pg_catalog."default" NOT NULL,
            "u2fKeyHandle" character varying(255) COLLATE pg_catalog."default" NULL,
            "u2fPublicKey" character varying(255) COLLATE pg_catalog."default" NULL,
            "u2fCertificate" text COLLATE pg_catalog."default" NULL,
            "u2fCounter" integer NULL,
            "rights" integer NOT NULL,
            "oldPassword" character varying(255) COLLATE pg_catalog."default" NULL,
            "active" boolean NOT NULL,
            "phoneNumber" character varying(10) COLLATE pg_catalog."default" NULL,
            "versionLib" character varying(50) COLLATE pg_catalog."default" NULL,
            "ipv4" character varying(15) COLLATE pg_catalog."default" NOT NULL,
            "ipv6" character varying(36) COLLATE pg_catalog."default" NULL,
            "agePassword" timestamp without time zone NOT NULL,
            CONSTRAINT '.DATABASE_PREFIX.'Registrations_pkey PRIMARY KEY ("u2fKey_id"))
            WITH (OIDS = FALSE)
            TABLESPACE pg_default;');
        }elseif (DATABASE_TYPE == 3){
            $pdo->exec('CREATE TABLE if not exists '.DATABASE_PREFIX.'Registrations (
        "user_id"	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
        "user"	TEXT NOT NULL,
        "password"	TEXT NOT NULL,
        "u2fKeyHandle"	TEXT NULL,
        "u2fPublicKey"	TEXT NULL,
        "u2fCertificate"    TEXT NULL,
        "u2fCounter"	INTEGER NULL,
        "rights"	INTEGER NOT NULL,
        "oldPassword"	TEXT NULL,
        "active"	INTEGER NOT NULL,
        "phoneNumber"	TEXT NULL,
        "versionLib"	TEXT NULL,
        "ipv4"	TEXT NOT NULL,
        "ipv6"	TEXT NULL,
        "agePassword"	INTEGER NOT NULL
        );');
        }
    }

private static function _settingAttributesPDO($pdo){
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
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
                DATABASE_PASSWORD);
            //self::_settingAttributesPDO($pdo);
        } elseif (DATABASE_TYPE == 2) {
            $pdo = new PDO(
                'pgsql:host=' . DATABASE_HOST .
                ';dbname=' . DATABASE_NAME .
                ';user=' . DATABASE_USER .
                ';password=' . DATABASE_PASSWORD);
            //self::_settingAttributesPDO($pdo);
        } elseif (DATABASE_TYPE == 3) {
            $pdo = new PDO('sqlite:' . DATABASE_NAME);
            //self::_settingAttributesPDO($pdo);
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
        $get->execute($param);
        $res = $get->fetchAll();
        return $res;
    }

    /**
     * Request to set elements on database
     *
     * @param string $req   request
     * @param array  $param is the element to add on database
     *
     * @return true
     */
    private static function _setBDD($req, $param)
    {
        $pdo = self::_initPdo();
        $set = $pdo->prepare($req);
        //var_dump($pdo->errorInfo());
        $set->execute($param);
        //var_dump($set->errorInfo());
        //self::_log($error, 10, 1);
    }


    /**
     * Register log on defined file with LOG_PATH
     * create a new log file each day
     *
     * @param string $action  describe the log
     * @param int    $user_id used to find who created the log
     *
     * @return true
     */
    private static function _log($action, $level, $user_id = NULL)
    {
            if (LOG > 0 && LOG >= $level){
                $file = LOG_PATH . 'log-'.date('Y-m-d').'.txt';
                if(!file_exists($file)){
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
    private static function _passwordStrength($pass){
        $password = false;
        $strength = PASSWORD_STRENGTH;
        if($strength > count(PASSWORD_PATTERN)){
            $strength = count(PASSWORD_PATTERN)-1;
    }
        if(!preg_match(PASSWORD_PATTERN[$strength], $pass)){
            if(PASSWORD_LENGHT > strlen($pass)) {
                self::_error(ERROR_PASSWORD_TOO_SHORT);
                }else{
            self::_error(ERROR_PASSWORD_STRENGTH);
                }
        }else{
            $password = true;
        }
        return $password;
    }


    /**
     * Create a password to user account
     *
     * @param string $pass could be from form or other
     */
    private static function _validPasswd($pass)
    {
        if(!empty($pass) && self::_passwordStrength($pass) != 0) {
            $pdo = self::_initPdo();
            $password = password_hash($pass, PASSWORD_BCRYPT);
            return ($password);
        }
    }


    /**
     * @param $user
     * @return bool|int
     */
    private static function _checkUserID($user){
        echo $user;
        if(!empty($user)) {
            if (ID_TYPE == 0) {
                $res = true;
            } elseif (ID_TYPE == 1) {
                if(!filter_var($user, FILTER_VALIDATE_EMAIL)){
                $res = false;
                self::_error(ERROR_ID_PATTERN_ERROR);
                }else{
                    $res = true;
                }
            } elseif (ID_TYPE > 1) {
                echo ID_PATTERN[ID_TYPE - 2] . "\n";
                var_dump(preg_match(ID_PATTERN[ID_TYPE - 2], $user));
                if(preg_match(ID_PATTERN[ID_TYPE - 2], $user)){
                    $res = true;
                }else{
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
     * @param int   $rights
     * @param string $phone
     *
     * @return true
     */
    private static function _createUser($user, $pass, $rights=0, $phone= NULL)
    {
        $pdo = self::_initPdo();
        if (self::_checkUserID($user)) {
            $password = self::_validPasswd($pass);
            //var_dump($password);
            //self::_setBDD(
            //"INSERT INTO prefix_Registrations ('user', 'password', 'passwordBirthday')
            //VALUES (?, ?, ?)",
            //$user, $password, time()
            //);
            //self::_log("user created", 10, $pdo->lastInsertId());
        } else {
            self::_error(ERROR_ID_PATTERN_ERROR);
            //self::_log("user create attempt failed", 10);
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
        if(($passwordBirthday + (PASSWORD_LIFE*86400)) < time()){
           $res = 0;
        }else{
            $res = 1;
        }
        return $res;
    }



//
//    /**
//     * Read all elements on database
//     *
//     * @return true
//     */
//    private function _readAll()
//    {
//    }
//
//    /**
//     * Update an element on database
//     *
//     * @param int $user_id is the element to update on database
//     *
//     * @return true
//     */
//    private function _update($user_id)
//    {
//        createLog(){}
//    }
//
//    /**
//     * Delete an element on database
//     *
//     * @param int $user_id is the element to delete on database
//     *
//     * @return true
//     */
//    private function _delete($user_id)
//    {
//        createLog(){}
//    }
//
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
//    /**
//     * Give rights to users
//     *
//     * @param int $user_id is the element to attribut rights on database
//     *
//     * @return true
//     */
//    private function _rights($user_id)
//    {
//
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
print_r($test::_getLastError());
//if($test::_getLastError()[0] == ERROR_PASSWORD_TOO_SHORT){
//    ERROR_TEXT[ERROR_PASSWORD_TOO_SHORT];
//}
