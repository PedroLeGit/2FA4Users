var xhr = new XMLHttpRequest();
var countTimeout = 0;

/**
 * Will log and redirect depending on the error code
 */
function xhrFin()
{
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200){
        console.log("Response: ", xhr.responseText);
        responseObj = JSON.parse(xhr.responseText);
        console.log(responseObj);
        if (responseObj[0] > 0){
            window.location = selfPage;
        } else if (responseObj[0] == 0){
            window.location = "index.php";
        }
    }
}

/**
 * Initiate xhr object
 *
 * @param reg
 * @param user
 * @param aj
 */
function initXHRRegister(reg, user, aj)
{
    if (aj == "ajaxreg"){
        xhr.open('POST', window.location.href, true);
        //If POST method is used, you must to change MIME type, thanks to setRequestHeader method.
        // Else server will ignore request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.getAllResponseHeaders();
        //if request change
        xhr.addEventListener('readystatechange',
            //this callback will be called
            function(){xhrFin();}
        );
        xhr.send("reg="+reg+"&username="+user+"&ajax="+aj);
    }
}


function initXHRAuthenticate(auth, user, aj)
{
    if (aj == "ajaxauth") {
        xhr.open('POST', window.location.href, true);
        //If POST method is used, you must to change MIME type, thanks to setRequestHeader method.
        // Else server will ignore request
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.getAllResponseHeaders();
        //if request change
        xhr.addEventListener('readystatechange',
            //this callback will be called
            function () {xhrFin();}
        );
        xhr.send("auth="+auth+"&username="+user+"&ajax="+aj);
    }
}

function displayDelayRegister(){
    delayReg.style.display = "none";
}

function displayDelayAuthenticate(){
    delayAuth.style.display = "none";
}


function u2fRegisterKey(){
    console.log("Register: ", req);
    //this object is from u2f-api.js
    u2f.register([req], sigs, function(data) {
        console.log("Register callback", data);

        if(data.errorCode && data.errorCode == 5 && countTimeout < 2){
            buttonReg = document.getElementById("phpLibUserConnectedRegister");
            delayReg = document.getElementById("phpLibUserConnectedDelayRegister");
            delayReg.style.display = "block";
            buttonReg.style.display = "block";
            countTimeout ++;
            return;
        }
        var reg = JSON.stringify(data);
        var user = username;
        var aj = "ajaxreg";
        initXHRRegister(reg, user, aj);
    });
}


function u2fSignKey(){
    console.log("sign: ", req);
    //this object is from u2f-api.js
    u2f.sign(req, function(data) {
        console.log("Authenticate callback", data);
        if(data.errorCode && data.errorCode == 5 && countTimeout < 2) {
            buttonAuth = document.getElementById("phpLibUserConnectedAuthenticate");
            delayAuth = document.getElementById("phpLibUserConnectedDelayAuthenticate");
            delayAuth.style.display = "block";
            buttonAuth.style.display = "block";
            countTimeout ++;
            return;
        }
        var auth = JSON.stringify(data);
        var user = username;
        var aj = "ajaxauth";
        initXHRAuthenticate(auth, user, aj);
    });
}
