var xhr = new XMLHttpRequest();

//12* Callback, verifie le bon deroulement de l'action.
function xhrFin(){

    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
        alert(xhr.responseText);
    }
}

//11* Initialise objet XHR
//Cela permet de recuperer des infos en AJAX en faisant une requete asynchrone au serveur.
//C'est exactement le meme principe d'ecrire l'url dans la barre de recherche et envoyer au serv pour
// obtenir un resultat.
function initXHRRegister(reg, user, aj){
    if (aj == "ajaxreg"){
        alert('register');
        xhr.open('POST', window.location.href, true);
        // Si on utilise la methode POST il faut imperativement changer le type MIME, grace a la methode setRequestHeader
        // sinon le serveur ignorera la requete
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.getAllResponseHeaders();
        // xhr.addEventListener('readystatechange', xhrFin()); //ancienne syntaxe de test non fonctionnelle
        //evenement sur ecoute; readystatechange va egalement ecouter un changement d'etat. Ici, l'execution de la requete
        xhr.addEventListener('readystatechange',
            //Callback en cas de changement d'etat de la requete
            function(){xhrFin();}
        );
        xhr.send("reg="+reg+"&username="+user+"&ajax="+aj);

    }
}


function initXHRAuthenticate(auth, user){
    alert('authenticate');
    xhr.open('POST', 'https://10.0.10.156/Librairie/2FA4Users.php', true);
    // Si on utilise la methode POST il faut imperativement changer le type MIME, grace a la methode setRequestHeader
    // sinon le serveur ignorera la requete
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.getAllResponseHeaders();
    // xhr.addEventListener('readystatechange', xhrFin()); //ancienne syntaxe de test non fonctionnelle
    //evenement sur ecoute; readystatechange va egalement ecouter un changement d'etat. Ici, l'execution de la requete
    xhr.addEventListener('readystatechange',
        //Callback en cas de changement d'etat de la requete
        function(){xhrFin();}
    );
    xhr.send("auth="+auth+"&username="+user);
}


function u2fRegisterKey(){
    console.log("Register: ", req);
    //10* La fonction propre a la clef d'enregistrement
    u2f.register([req], sigs, function(data) {
        console.log("Register callback", data);
        if(data.errorCode && errorCode != 0) {
            alert("registration failed with error: " + data.errorCode);
            return;
        }
        var reg = JSON.stringify(data);
        var user = username;
        var aj = "ajaxreg";
        //Initialise un objet XHR et envoie les 3 parametres pour recuperation/traitement serveur
        //Le parametre aj est utilise dans 2 conditions:
        // La 1ere; Verification si l'objet xhr.open devra ouvrir une url vers register.php ou authenticate.php
        // La 2nd; Verification dans le traitement dans register.php ET authenticate.php
        // afin de verifier si le traitement doit s'executer cote serveur ou cote navigateur.
       initXHRRegister(reg, user, aj);
    });
}


function u2fSignKey(){
    console.log("sign: ", req);
    //Fonction propre a la clef d'authentification
    u2f.sign(req, function(data) {
        console.log("Authenticate callback", data);
        var auth = JSON.stringify(data);
        var user = username;
        //var aj = "ajaxauth";
        //Initialise un objet XHR et envoie les 3 parametres pour recuperation/traitement serveur
        //Le parametre aj est utilise dans 2 conditions:
        // La 1ere; Verification si l'objet xhr.open devra ouvrir une url vers register.php ou authenticate.php
        // La 2nd; Verification dans le traitement dans register.php ET authenticate.php
        //afin de verifier si le traitement doit s'executer cote serveur ou cote navigateur.
        initXHRAuthenticate(auth, user, aj = null);
    });
}
