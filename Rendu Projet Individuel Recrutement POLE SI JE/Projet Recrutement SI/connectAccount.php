<!DOCTYPE html>
<html>
    
    <head>
        <!-- Encodage -->
        <meta charset="utf-8" />
        <!-- Titre de l'onglet -->
        <title>Blog sur League of Legend</title>
        <link rel="stylesheet" href="connectStyleSheet.css">
    </head>

    <!-- Corps de la page -->
    <body>
        <div>
            <!-- Titre de niveau 1 -->
            <h1>Me connecter pour accéder au blog !</h1>
            <div>
                <form action="blogStartPage.php" method="POST">
                    <!-- On utilise des divs pour former un bloc entre les différents tags -->
                    <!-- L'élément label sert à donner un texte à côté de l'input, champs d'entrée pour l'utilisateur -->
                    <div class="emailField">
                        <label for="emailConnex">Votre e-mail</label>
                        <!-- type à changer pour un type email -->
                        <input type="text" id="emailConnex" name="emailConnex" placeholder="xyz@gmail.com" required>
                    </div>
                    
                    <div class="passwordField">
                        <label>Votre mot de passe</label>
                        <input type="password" id="mdpConnex" name="mdpConnex" placeholder="Votre mot de passe" maxlength="12" required>
                    </div>

                    <div class="actionButtons">
                        <input type="reset" id="resetConnex" name="resetConnex">
                        <input type="submit" id="submitConnex" name="submitConnex">
                    </div>

                </form>
            </div> 
                <div class="connectAsGuest">
                    <!-- Lien vers une page web différente, pour organiser le site, différents attributs -->
                    <a href="blogStartPage.php" target=_self tittle="Connection Visiteur"> Se connecter en tant que visiteur
                    </a>
                </div>
                
                <div class="createMode">
                    <!-- Lien vers une page web différente, pour organiser le site, différents attributs -->
                    <a href="createAccount.php" target=_self tittle="Créer mon compte"> Créer un compte
                    </a>
                </div>   
        </div>
    </body>

</html>