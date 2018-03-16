<?php require"librairie.php";
if(isset($_SESSION[SESSION_ARRAY_USER_INFO]['errorCode'])
    || isset ($_SESSION[SESSION_ARRAY_USER_INFO]['errorText'])): ?>
<style type="text/css"> p{font-weight: bold; color: #9b4dca}</style>
    <p> <?php
        echo $_SESSION[SESSION_ARRAY_USER_INFO]['errorText'];
        unset($_SESSION[SESSION_ARRAY_USER_INFO]['errorCode']);
        unset($_SESSION[SESSION_ARRAY_USER_INFO]['errorText']);
    ?> </p>
<?php
endif;
?>
<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8" />
    <link rel="stylesheet" href="dist/milligram.css">
    <script src="librairie.js"></script>
    <?php if (DOUBLEFA == 1): ?>
        <script src="U2F/u2f-api.js"></script>
    <?php endif; ?>
    <title>Connexion</title>

</head>
<?php
    if (!$user->readUserConnected()){
        echo '
            <div id="phpLibUserConnectedScreen">
                <div id="phpLibUserConnectedForm">
            
                    <h1>Connexion</h1>
                    <form method="post" action="'; echo userLibrary::_getRedirectPage(); echo '">
                        <fieldset>
                            <label for="LastField">Identifiants</label>
                            <input type="text" name="user_id" id="phpLibUserConnectedLastNameField">
                            <label for="FirstNameField">Mot de passe</label>
                            <input type="password" name="password" id="phpLibUserConnectedFirstNameField">
                            <style type="text/css"> p{font-weight: bold; color: #9b4dca}</style>
                            <div class="float-right">
                                <br/>
                                <a href="login.php?lost_password" <label class="label-inline" for="confirmField">Mot de passe oublié</label>
                            </div>
                            <br/>
                            <input class="button-primary" type="submit" value="Valider">
                        </fieldset>
                    </form>
                </div>
            </div>';
    } elseif ($user->readUserConnected()
        && !isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'])
    ){
        userLibrary::_readU2FRegisterParam();
        echo '
            <div id="phpLibUserConnectedScreen">
                <div id="phpLibUserConnectedForm">
                    <h1>Inserer la clef</h1>
                    <form method="post" action="#">
                        <fieldset>
                            <input type="hidden" name="register">
                            <br/>
                            <input  type="submit" name="submit" value="Enregistrer nouvelle clef">
                        </fieldset>
                    </form>
                </div>
            </div>';
    } elseif ($user->readUserConnected()
        && isset($_SESSION[SESSION_ARRAY_USER_INFO]['u2f_key_handle'])) {
        echo '
            <div id="phpLibUserConnectedScreen">
                <div id="phpLibUserConnectedForm">
                    <h1>Inserer la clef</h1>
                    <form method="post" action="'; echo userLibrary::_getRedirectPage(); echo '">
                        <fieldset>
                        <input type="hidden" name="authenticate">
                            <br/>
                            <input  type="submit" name="submit" value="Authentifier clef">
                        </fieldset>
                    </form>
                </div>
            </div>';
    } elseif ($user->readUser2FAConnected()) {
        header("Location: index.php");
        //formulaire pour changer mot de passe
    }
// elseif (isset($_GET['password_forgotten']))}
    ?>
<script> alert(window.location.href);</script> <!--constante/ variable page courante
    //alert box
