function subscribe() {
   if(subscribeIsVerified()) {
       var nickname = document.getElementById("nickNameSubscribe").value;
       var email = document.getElementById("emailSubscribe").value;
       var surname = document.getElementById("surnameSubscribe").value;
       var name = document.getElementById("nameSubscribe").value;
       var password = document.getElementById("passwordSubscribe").value;
       var confirmPassword = document.getElementById("confirmPasswordSubscribe").value;
       var kind = document.getElementsByName("kind");
       for(var i = 0; i < kind.length; i++)
            kind[i].checked ? kind = kind[i].value : undefined;

       var request = newXmlHttpRequest();
       
       request.onreadystatechange = function () {
       var divPseudo = document.getElementsByClassName("subscribe_error_message")[0];
       var divEmail = document.getElementsByClassName("subscribe_error_message")[1];
       var divEnd = document.getElementsByClassName("subscribe_error_message");
       divPseudo.innerHTML = "";
       divEmail.innerHTML = "";


           if(request.readyState == 4) {
               if(request.responseText == '2') {
                    divPseudo.innerHTML = "Pseudo déja existant";
               } else if(request.responseText == 1){
                    divEmail.innerHTML = "email déja existant";                                       
               }   else {
                   divEnd[divEnd.length].innerHTML = request.responseText;
               }
                           
           }
       }
       
       var body = "pseudo="+nickname+"&email="+email+"&name="+name+"&surname="+surname+"&password="+password+"&kind="+kind;
       
       request.open("POST", "subscribe.php");
       request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       request.send(body);
   }
}

function subscribeIsVerified() {
    var nickname = document.getElementById("nickNameSubscribe");
    var email = document.getElementById("emailSubscribe");
    var surname = document.getElementById("surnameSubscribe");
    var name = document.getElementById("nameSubscribe");
    var password = document.getElementById("passwordSubscribe");
    var confirmPassword = document.getElementById("confirmPasswordSubscribe");
    var kind = document.getElementsByName("kind");
    var div = document.getElementsByClassName("subscribe_error_message");
    for(var i = 0; i < div.length; i++)
        div[i].innerHTML = "";
    for(var i = 0; i < kind.length; i++) {
        kind[i].checked ? kind = kind[i] : undefined;
    }
    
    
    var error = false;
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; // used for check email in js
    
    if(nickname.value.length < 1) {
        error = true;
        div[0].innerHTML = "Votre pseudo doit contenir au moin 1 caractere";
    }
    if (!filter.test(email.value)) {
        error = true;
        div[1].innerHTML = "Veuillez entrer un email valide";  
    }
    if(name.value.length < 1) {
        error = true;
        div[2].innerHTML = "Veuillez entrer un nom";
    }
    if(surname.value.length < 1) {
        error = true;
        div[3].innerHTML = "Veuillez entrer un prénom";
    }
  if(name.value == surname.value) {
        error = true;
        div[3].innerHTML = "Le prénom doit être différent du nom";
    }
    if(password.value.length < 6 || password.length > 32) {
        error = true;
        div[4].innerHTML = "Le mot de passe doit etre compris entre 6 et 32 caracteres";
    }
    if(confirmPassword.value != password.value) {
        error = true;
        div[5].innerHTML = "Les mots de passe ne correspondent pas";
    }
    if(kind.value != "m" && kind.value != "f") {
        error = true;
        div[6].innerHTML = kind.value;
    }
    
    if(error) {
        return false;
    } else {
        return true;
    }
}

function ValidateEmail(mail, form)   
{  
 if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(form.mail))  
  {  
    return (true)  
  }  
    return (false)  
}  

function newXmlHttpRequest () {
	if(window.XMLHttpRequest)
		return new XMLHttpRequest();

	return new ActiveXobject("Microsoft.XHMHTTP");
}

function login() {
    var nickname = document.getElementById("nicknameConnect").value;
    var password = document.getElementById("passwordConnect").value;
    
    var request = newXmlHttpRequest();
    
    request.onreadystatechange = function () {
        
        if(request.readyState == 4) {
           console.log(request.responseText);
        }
    }
    
    var body = "pseudo="+nickname+"&password="+password;
    
    request.open("POST","login.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(body);
}

function usersTab() {
    
    var request = newXmlHttpRequest();
    
    request.onreadystatechange = function () {
        if(request.readyState == 4){
            
        }
    }
    
    request.open("GET", "user.php")
    
}