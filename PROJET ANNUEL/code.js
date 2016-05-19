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

           if(request.readyState == 4) {
               if(request.responseText == '2') {
                    alert("Pseudo déja existant");
               } else if(request.responseText == 1){
                   alert("email déja existant");                                       
               }   else {
                   alert(request.responseText);
                   var form = document.getElementById("subscribeForm");
                   form.style.display = "none";
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
    for(var i = 0; i < kind.length; i++) {
        kind[i].checked ? kind = kind[i] : undefined;
    }
    
    
    var error = false;
    var errorMessage = "";
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/; // used for check email in js
    
    if(nickname.value.length < 1) {
        error = true;
        errorMessage += " - Votre pseudo doit contenir au moin 1 caractere. \n";
        nickname.style.borderColor = "red";
    }
    if (!filter.test(email.value)) {
        error = true;
        email.style.borderColor = "red";
        errorMessage += " - Veuillez entrer un email valide. \n";  
    }
    if(name.value.length < 1) {
        error = true;
        errorMessage += " - Veuillez entrer un nom. \n";
        name.style.borderColor = "red";
    }
    if(surname.value.length < 1) {
        error = true;
        surname.style.borderColor = "red";
        errorMessage += " - Veuillez entrer un prénom. \n";
    }
  if(name.value == surname.value) {
        error = true;
        surname.style.borderColor = "red";
        errorMessage += " - Le prénom doit être différent du nom. \n";
    }
    if(password.value.length < 6 || password.length > 32) {
        error = true;
        password.style.borderColor = "red";
        errorMessage += " - Le mot de passe doit etre compris entre 6 et 32 caracteres. \n";
    }
    if(confirmPassword.value != password.value || confirmPassword.value < 1) {
        error = true;
        confirmPassword.style.borderColor = "red";
        errorMessage += " - Les mots de passe ne correspondent pas. \n";
    }
    if(kind.value != "m" && kind.value != "f") {
        error = true;
        errorMessage += kind.value;
    }
    
    if(error) {
        alert(errorMessage);
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
            if (request.responseText == "Pseudo ou mot de passe incorrect")
                alert(request.responseText);
        }
    }
    
    var body = "pseudo="+nickname+"&password="+password;
    
    request.open("POST","login.php");
    request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    request.send(body);
}
