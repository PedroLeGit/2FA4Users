<?php
/**
 * Created by PhpStorm.
 * User: Pedro
 * Date: 13/02/2018
 * Time: 14:38
 */

namespace u2fLibConnectedUser;//a changer

//Double facteur d'authentification
/**
 * Double authenticate way:
 * 0(none)
 * 1(SMS)
 * 2(Key U2f)
 */
const DOUBLEFA = 0;

//Texte de message sms a remplacer si besoin
/**
 * Short message text for SMS authenticate
 * Change as you want
 */
const DOUBLEFA_SMS_TEXT = "this is your code";

//Nombre de tentative avant deconnexion 0(désactivé), 1(1), 2(2), 3(3),
/**
 * Number of attempt failed
 * 0(desactivate)
 * 1(1)
 * 2(2)
 * ...
 */
const PASSWORD_ERROR = 0;

//Taille du mot de passe 8(8 lettres mini), 9(9 lettres mini), 10(), etc…
//si le développeur rentre un chiffre entre 1 et 7, 8 lettres seront prises en compte obligatoirement
/**
 * Password lenght
 * 8(8 lettres)
 * 9(9 letters)
 * ...
 */
const PASSWORD_LENGHT = 8;

//Force du mot de passe 1(+chiffre), 2(+caractère spécial), 3(+Maj)
/**
 * Password strength
 * 1(numbers)
 * 2(special caracters)
 * 3(Capslock)
 */
const PASSWORD_STRENGTH = 1;

//Duree de vie du mot de passe 1(un jour), 2(deux jours), 3(), etc…
/**
 * Define how long the user could connect with the same password
 * 1(1 day)
 * 2(2 days)
 * ...
 */
const PASSWORD_LIFE = 1;

//Possibilite d'enregistrement d'un ancien mot de passe 0(désactivé), 1(activé)
/**
 * Activate/desactivate if user could change his password with an old password already
 * registered by this user
 */
const PASSWORD_REGISTER = 0;

//Deconnexion automatique sur innactivite 0(désactivé), 1(1 min), 2(2 min), 3(), etc…
/**
 * Automatic disconnection after few minutes
 * 1(1 min)
 * 2(2 min)
 * ...
 */
const AUTO_DISCONNECT = 0;

//Gestion des logs 0(désactivé), 1(2 logs), 2(4 logs), 3(9 logs)
/**
 * Logs management
 * 0(none)
 * 1(2 logs)
 * 2(4 logs)
 * 3(9 logs)
 *
 *NIVEAU 0	  NIVEAU 1	      NIVEAU 2	        NIVEAU 3
 *desactivé	  connection	  connection	    connection
 *	          deconnection	  deconnection      deconnection
 *		                      changingPass      changingPass
 *                            deleteUserAccount deleteUserAccount
 *                                              autoDisconnect
 *		                                        ChangingUserAccount
 *                                              passwordError
 *                                              2FA
 *		                                        disableUserAccount
 */
const LOG = 0;

//Chemin log
/**
 * Determine the log path
 */
const LOG_PATH = "log/";

//Type de base de donnees 1(MySQL), 2(SQLite3), 3(PostgreSQL)
/**
 * Define the type of database you have to user for the project
 */
const DATABASE_TYPE = 3;

//Hote base de donnees ‘mysql:host= ;’, ‘pgsql:host= ;’
/**
 * Determine the host of the database
 * by default: localhost
 */
const DATABASE_HOST = "localhost";

//Port par defaut base de donnees ‘5432’ (port par défaut)
/**
 * Default port of database postgres
 */
const DATABASE_PORT = "5432";

//Identifiants base de donnees
/**
 * ID's you're using to connect on database
 */
//const DATABASE_ID = " ";

//Nom de base de donnees. Pour SQlite cela donnera 'nom_fichier.sqlite.db'
/**
 * The name of your database
 * If you are using sqlite, please write the name of the file, followed by .sqlite.db
 */
const DATABASE_NAME = "nom_fichier.sqlite.db";

/**
 * ID's you're using to connect on database
 */
const DATABASE_USER = "";

/**
 * Password you're using to connect on database
 */
const DATABASE_PASSWORD = "";

//Force la connexion en SSL 0(désactivé), 1(activé)
/**
 * Activate/Desactivate forcing browsers to connect with HTTPS protocol
 */
const FORCE_SSL = 0;


public class Library
{
    public function __construct()
    {
    }


    /**
     * Initiate object PDO
     * @return PDO
     */
    function initPdo()
    {
        if (DATABASE_TYPE == 1) {
            $pdo = new PDO('mysql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ',' . DATABASE_PORT . ',' . DATABASE_USER . ',' . DATABASE_PASSWORD);
        } elseif (DATABASE_TYPE == 2) {
            $pdo = new PDO('pgsql:host=' . DATABASE_HOST . ';dbname=' . DATABASE_NAME . ',' . DATABASE_USER . ',' . DATABASE_PASSWORD);
        } elseif (DATABASE_TYPE == 3) {
            $pdo = new PDO(DATABASE_NAME);
        } else {
            exit();
        }
        return $pdo;
    }

    /**
     * Selecting request
     * @param $req string request
     * @param $param is the element to read on database
     */
    function selectSQL($req, $param)
    {
        $pdo = $this->initPdo();
        $select = $pdo->prepare($req);
        $select->execute($param);
        $res = $select->fetch();
        return $res;
    }

    /**
     * Inserting request
     * @param $req string request
     * @param $param is the element to read on database
     */
    function insertSQL($req, $param)
    {
        $pdo = $this->initPdo();
        $insert = $pdo->prepare($req);
        $insert->execute($param);
    }

    /**
     * Register log on defined file with LOG_PATH
     * And on database on table Logs
     * @param $param
     */
    function regLog($action, $user_id, $date)
    {
        $file = LOG_PATH . 'log.txt';
//        $current = file_get_contents($file);
//        debug($current);
        $text = 'Event: ' . $action . ' User_id: ' . $user_id . ' Date: ' . $date;
        $var = file_put_contents($file, $text, FILE_APPEND | LOCK_EX);
        debug($var);
        insertSQL("Insert into Logs values (?, ?, ?)", );
    }


    /**
     * Creating log
     * @param $action string
     */
    function createLog($action)
    {
        if (LOG == 1 && LOG == 2 && LOG == 3) {
            switch ($action) {
                case "connection":
                    regLog($action);
                    break;
                case "deconnection":
                    regLog($action);
                    break;
            }
        } elseif (LOG == 2 && LOG == 3) {
            switch ($action) {
                case "changingPass":
                    regLog($action);
                    break;
                case "deleteUserAccount":
                    regLog($action);
                    break;
            }
        } elseif (LOG == 3) {
            switch ($action) {
                case "autoDisconnect":
                    regLog($action);
                    break;
                case "ChangingUserAccount":
                    regLog($action);
                    break;
                case "passwordError":
                    regLog($action);
                    break;
                case "2FA":
                    regLog($action);
                    break;
                case "disabeUserAccount":
                    regLog($action);
                    break;
            }
        }
    }


    /**
     * Create an user and add a log
     */
    function create()
    {

        function createLog()
        {
        }
    }

    /**
     * Read one element on database
     * @param $param string name of column Name from database
     */
    function read($param)
    {
    }

    /**
     * Read all elements on database
     */
    function readAll()
    {
    }

    /**
     * Update an element on database
     * @param $user_id int is the element to update on database
     */
    function update($user_id)
    {
        createLog(){}
    }

    /**
     * Delete an element on database
     * @param $user_id int is the element to delete on database
     */
    function delete($user_id)
    {
        createLog(){}
    }

    /**
     * Disable an user account
     * @param $user_id int is the element to disable on database
     */
    function disable($user_id)
    {
        createLog(){}
    }

    /**
     * Give rights to users
     * @param $user_id int is the element to attribut rights on database
     */
    function rights($user_id)
    {

    }

    /**
     * Create a password to user account
     */
    function createPasswd()
    {
        checkPasswd(){
            regPasswd()
            {
            createLog(){}
            }
        }
    }

    /**
     * Read folders and check if -require "lib"- is here
     * @param $path string indicate path of root files of project
     */
    function readFolder($path){
    }

    /**
     * Session disconnect user
     */
    function Deconnection()
    {
        $time = AUTO_DISCONNECT;
        while()
        session_destroy();
        createLog(){}
    }

    /**
     * Check old passwords if user is able to or unable to register with
     */
    function connectOld()
    {
        read(){
        create(){}
        }
    createLog(){}
    }

    /**
     * Disconnect user after few secondes
     */
    function decoIfNoAnswer()
    {
        Deconnection(){
        createLog(){}
        }
    }

    /**
     * Should be able to update the library
     */
    function upDateLib()
    {

    }

//function get(?){}
//function set(?){}

}





















