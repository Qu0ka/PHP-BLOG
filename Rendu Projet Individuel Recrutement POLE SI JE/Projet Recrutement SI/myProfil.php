<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Blog sur League of Legend</title>
    </head>
    <body>
        
        <h1>Mon profil : <?php echo $_POST['userMode']; ?></h1> 
        
        <h2>Mes informations :</h2>
        
        <p>
            <?php

            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $dateOfBirth = $_POST['dateOfBirth'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            

            if($_POST['userMode'] == "Visiteur"){ ?>
                <strong>Mon nom :</strong> <?php echo $nom; ?><br>
                <strong>Mon prenom :</strong> <?php echo $prenom; ?> <br> 
                <strong>Ma date de naissance :</strong> <?php echo $dateOfBirth; ?><br>
                <strong>Mon email :</strong> <?php echo $email; ?> <br>
                <strong>Mon mot de passe :</strong> <?php echo $password; ?>
    <?php   }else{ ?>
                <div id="showInfoDiv"  style="display:block;">
                    <strong>Mon nom :</strong> <?php echo $nom; ?><br>
                    <strong>Mon prenom :</strong> <?php echo $prenom; ?> <br> 
                    <strong>Ma date de naissance :</strong> <?php echo $dateOfBirth; ?><br>
                    <strong>Mon email :</strong> <?php echo $email; ?> <br>
                    <strong>Mon mot de passe :</strong> <?php echo $password; ?><br>
                </div>
        <?php   } ?>

        <!--On créé ici un hidden form avec son bouton submit pour passer les données de la page myProfil.php à la page blogStartPage.php lorsque l'on clique sur le bouton submit-->
        <div id="modifInfoDiv"  style="display:none;"> 
             <form action="update.php" method="POST">

                <!-- On utilise des divs pour former un bloc entre les différents tags -->
                <!-- L'élément label sert à donner un texte à côté de l'elmt input, champs d'entrée pour l'utilisateur -->

                <!-- Des groupe d'input (type="text") = un champ textuel -->
                <label>Votre nom</label><br>
                <input type="text" name="nom" placeholder="<?php echo $nom; ?>" required><br>
                
                <label>Votre prénom</label><br>
                <input type="text" name="prenom" placeholder="<?php echo $prenom; ?>" required><br>

                 <!-- Un input de type date (type="date") -->
                <label>Votre date de naissance</label><br>
                <input type="date" name="dateOfBirth" placeholder="<?php echo $dateOfBirth; ?>" required><br>
                
                 <!-- Encore des champs textuels -->
                <label >Votre e-mail</label><br>
                <input type="email" name="email" placeholder="<?php echo $email; ?>" required><br>
            
                <label>Votre mot de passe</label><br>
                <input type="password" name="password" maxlength="12" required><br>

                <input type="hidden" id="id" name="id" value = "<?php echo $_POST['id']; ?>"><br>
                <input type="submit" name="submitInfo" value="Valider la modification"><br>

            </form>
        </div>

        <div>
            <input type="button" id="modifInfoButton" name="modifInfo" value="Modifier mes informations" onclick="showAndHideDiv('modifInfoDiv', 'showInfoDiv')" /><br>
            <input type="button" id="annulModifInfoButton" name="annulInfo" value="Annuler la modification" onclick="showAndHideDiv('modifInfoDiv', 'showInfoDiv')" style="display:none;" /><br>
            <input type="submit" name="logOut" value="Retourner sur la page d'accueil" onclick="goBack()">
        </div>

        <script type="text/javascript">
            function showAndHideDiv(elementToShow, elementToHide) {
                if (document.getElementById(elementToShow).style.display !== "none") {
                    document.getElementById(elementToShow).style.display = "none";
                    document.getElementById(elementToHide).style.display = "block";
                    document.getElementById('modifInfoButton').style.display = "block";
                    document.getElementById('annulModifInfoButton').style.display = "none";
                } else {
                    document.getElementById(elementToShow).style.display = "block";
                    document.getElementById(elementToHide).style.display = "none";
                    document.getElementById('modifInfoButton').style.display = "none";
                    document.getElementById('annulModifInfoButton').style.display = "block";
                }
            }
            function goBack(){
                document.getElementById('goBackForm').submit();
            }
        </script>

        </p>

        <form action="blogStartPage.php" id="goBackForm" method="POST">
            <input type="hidden" id="userMode" name="userMode" value = "<?php echo $userMode; ?>">
            <input type="hidden" id="nom" name="nom" value = "<?php echo $nom; ?>">
            <input type="hidden" id="prenom" name="prenom" value = "<?php echo $prenom; ?>">
            <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $dateOfBirth; ?>">
            <input type="hidden" id="email" name="email" value = "<?php echo $email; ?>">
            <input type="hidden" id="password" name="password" value = "<?php echo $password; ?>">
        </form>
    </body>
</html>