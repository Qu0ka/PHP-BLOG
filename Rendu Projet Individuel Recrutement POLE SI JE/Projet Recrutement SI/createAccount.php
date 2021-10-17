<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Blog sur League of Legend</title>
        <link rel="stylesheet" href="createStyleSheet.css">
    </head>

    <body>

        <div>
            <h1>Créer mon compte</h1>

            <!-- L'attribut action sert pour transmettre les données d'une page php à l'autre, et POST empeche d'append les données à l'URL -->

            <div>
                <form action="blogStartPage.php" method="POST">

                    <!-- On utilise des divs pour former un bloc entre les différents tags -->
                    <!-- L'élément label sert à donner un texte à côté de l'elmt input, champs d'entrée pour l'utilisateur -->

                    <!-- Des groupe d'input (type="text") = un champ textuel -->
                    <div class="nameCreate">
                        <label for="nameCreate">Votre nom</label>
                        <input type="text" name="nameCreate" placeholder="Votre nom" required>
                    </div>
                    
                    <div class="firstNameCreate">
                        <label for="firstNameCreate">Votre prénom</label>
                        <input type="text" name="firstNameCreate" placeholder="Votre prénom" required>
                    </div>

                     <!-- Un input de type date (type="date") -->
                    <div class="birthDateCreate">
                        <label for="birthDateCreate">Votre date de naissance</label>
                        <input type="date" name="birthDateCreate" required>
                    </div>
                    
                     <!-- Encore des champs textuels -->
                    <div class="emailCreate">
                        <label for="emailCreate">Votre e-mail</label>
                        <input type="email" name="emailCreate" placeholder="xyz@gmail.com" required>
                    </div>
                    
                    <div class="mdpCreate">
                        <label for="mdpCreate">Votre mot de passe</label>
                        <input type="text" name="mdpCreate" placeholder="Votre mot de passe" maxlength="12" required>
                    </div>
                    
                    <div class="mdpCreateConfirm">
                        <label for="mdpCreateConfirm">Confirmation</label>
                        <input type="text" name="mdpCreateConfirm" placeholder="Confirmation" maxlength="12" required>
                    </div>

                    <div class="radButton">
                        <!-- Un groupe de radioButton (type="radio") -->
                        <label for="MrCreate">Mr</label>
                        <input type="radio" name="sexChoosing" value="Mr" checked="checked" required>

                        <label for="MmeCreate">Mme</label>
                        <input type="radio" name="sexChoosing" value="Mme" required>

                    </div>
                     <!-- Des inputs sous forme de boutons (ici prédéfinis par reset et submit) -->
                    <div class="actionButtons">
                        <input type="reset" name="resetCreate">
                        <input type="submit" name="submitCreate">
                    </div>
                </form>
            </div>
            <div class="connectMode">
                <a href="connectAccount.php" target=_self tittle="Se connecter"> Se connecter
            </a>
            </div>
            
        </div>
    </body>

</html>