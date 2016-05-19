 <!-- Navigation -->
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-main-collapse">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top">
                  <!--  <img src="img/logo.png" height="60px" alt="erreur">-->
                </a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse navbar-right navbar-main-collapse">
                <ul class="nav navbar-nav">
                    <!-- Hidden li included to remove active class from about link when scrolled up past about section -->
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a class="page-scroll" href="index.php">Accueil</a>
                    </li>
                    <li>
                        <a class="page-scroll" id="subscribe">S'inscrire</a>
                    </li>
                    <li>
                        <a class="page-scroll" id="connect">Se connecter</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="faq.php">F.A.Q.</a>
                    </li>
                    <li>
                        <a class="page-scroll" href="admin/index.php">Administration</a>
                    </li>
                </ul>  
            </div>
            <!-- /.navbar-collapse -->
            <div class="row">
                <div class="navbar-right">   
                <form id="subscribeForm" class="form-inline"> 
                    
                    <div class="form-content">
                        <input type="text" name="pseudo" placeholder="Pseudo" id="nickNameSubscribe"> 
                        <Label class="subscribe_error_message"></Label>    

                        <input type="email" name="email" placeholder="Email" id="emailSubscribe">             
                        <Label class="subscribe_error_message"></Label>

                        <input type="text" name="surname" placeholder="Prénom" id="surnameSubscribe">             
                        <Label class="subscribe_error_message"></Label>
                    </div>
                    
                    <div class="form-content">
                        <br>
                        <input type="text" name="name" placeholder="Nom" id="nameSubscribe">             
                        <Label class="subscribe_error_message"></Label>

                        <input type="password" name="password" placeholder="Mot de passe" id="passwordSubscribe"> 
                        <Label class="subscribe_error_message"></Label>
                        <input type="password" name="confirmPassword" placeholder="Mot de passe (encore)" id="confirmPasswordSubscribe"> 
                        <Label class="subscribe_error_message"></Label>
                    </div>
                    <div class="form-content">
                        <br>
                        <Label>
                            <input type="radio"  name="kind" value="m" checked> homme
                        </Label>
                            
                        <Label>
                            <input type="radio"  name="kind" value="f"> femme 
                        </Label>
                        <Label class="subscribe_error_message"></Label>


                        <input class="form-content" type="button" value="S'inscrire" onclick="subscribe()" >   
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="navbar-right">
                <form method="" id="connectForm" class="form-inline">
                    <div class="form-content">   
                        <input type="text" placeholder="Pseudo" id="nicknameConnect" >
                        <input type="password" placeholder="Mot de passe" id="passwordConnect">
                        <input type="button" value="Se connecter" onclick="login()"> 
                    </div>   
                </form>
            </div>
        </div>
            <script>    
                $(function(){
                /* SHOW FORM */
                 $('#connect').click(function() {
                    $('#subscribeForm').hide();
                    $('#connectForm').slideDown();
                })
                });
            </script>
            <script>
                $(function(){
                    /* SHOW FORM */
                    $('#subscribe').click(function() {
                        $('#connectForm').hide();
                        $('#subscribeForm').slideDown();
                    })
                });
            </script>   
        </div>
        <!-- /.container -->
    </nav>