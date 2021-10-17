<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8" />
        <title>Blog sur League of Legend</title>
        <link rel="stylesheet" href="blogStartPage.css">
    </head>

    <body>
    <?php
            $messageToPrint;
            $i = 1;
            //On créé une instance de la BDD du projet
            try{
                $bdd = new PDO('mysql:host=localhost;dbname=projet_recrutement_si_db;charset=utf8', 'root', 'root');
            }
            catch(Exception $e){
                    die('Erreur : '.$e->getMessage());
            }
            // Vérification pour afficher la page d'accueil lors d'une création de compte
            if (isset($_POST['mdpCreate'])) 
            {
                // On y ajoute lors de la création de compte les infos rentrées par l'utilisateur
                $req = $bdd->prepare('INSERT INTO utilisateurs(nom, prenom, dateOfBirth, email, password) VALUES(:nom, :prenom, :dateOfBirth, :email, :password)');
                
                // On récupère les valeurs de l'entrée à ajouter en vérifiant que l'utilisateur créé pas un compte ayant les mêmes valeurs que celui de l'admin
                if($_POST['emailCreate'] != "admin@admin.com" AND $_POST['mdpCreate'] != "admin")
                {
                  $req->execute(array(
                    'nom' => $_POST['nameCreate'],
                    'prenom' => $_POST['firstNameCreate'],
                    'dateOfBirth' => $_POST['birthDateCreate'],
                    'email' => $_POST['emailCreate'],
                    'password' => $_POST['mdpCreate'],
                    ));  
                }
                
                /*On va maitenant afficher le nom et le prénom de l'utilisateur qui vient de créer
                son compte pour l'afficher comme la session en cours*/
                $messageToPrint = $_POST['firstNameCreate'] . " " . $_POST['nameCreate'];

                $nomClient = $_POST['nameCreate'];
                $prenomClient = $_POST['firstNameCreate'];
                $dateOfBirth = $_POST['birthDateCreate'];
                $email = $_POST['emailCreate'];
                $password = $_POST['mdpCreate'];

                $userMode = "Client";
            }

            // Vérification pour afficher la page d'accueil en cas d'une connexion
            // La vérification ci dessous devrait être faite sur connectAccount.php pour empêcher de passer à la page suivante si le compte n'a pas été trouvé ==> à modifier si j'ai le temps

            elseif((isset($_POST['mdpConnex'])))
            {
                $reponse = $bdd->prepare('SELECT * FROM utilisateurs WHERE email = :email AND password = :password');
              
                $reponse->execute(array('email' => $_POST['emailConnex'],'password' => $_POST['mdpConnex']));

                // On définie une variable indiquant que l'on a trouvé l'utilisateur
                $found = false;

                while ($donnees = $reponse->fetch())
                {

                   if($_POST['emailConnex'] == $donnees['email'] AND $_POST['mdpConnex'] = $donnees['password'])
                   {
                        $messageToPrint = $donnees['prenom'] . " " . $donnees['nom'];
                        $nomClient = $donnees['nom'];
                        $prenomClient = $donnees['prenom'];
                        $dateOfBirth = $donnees['dateOfBirth'];
                        $email = $donnees['email'];
                        $password = $donnees['password'];
                        $id_Client = $donnees['id'];

                        echo($id_Client);

                        $userMode = "Client";

                        if(($_POST['emailConnex'] == "admin@admin.com" AND $_POST['mdpConnex'] == "admin"))
                            {
                                $messageToPrint = "Mr l'Administrateur";
                                $userMode = "Admin";
                            }
                        $found = true;  
                    }  
                }

                if($found == false)
                {
                    $messageToPrint = "Visiteur (Votre compte n'a pas été trouvé)";
                    $userMode = "Visiteur";
                }
                $reponse->closeCursor();
            } 
            /* Ici on gère l'envoie des données lorsque l'on repasse de la page myProfil.php à la page d'accueil : blogStartPage.php*/
            else if(isset($_POST['prenom']) AND $_POST['prenom'] != "N/A")
            {
               if(isset($_POST['prenom']))
               {
                    $messageToPrint = $_POST['prenom'] . " " . $_POST['nom'];
                    $nomClient = $_POST['nom'];
                    $prenomClient = $_POST['prenom'];
                    $dateOfBirth = $_POST['dateOfBirth'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $userMode = "Client";

                    if(($_POST['email'] == "admin@admin.com") AND $_POST['password'] == "admin")
                    {
                        $messageToPrint = "Mr l'Administrateur";
                        $userMode = "Admin";
                    }
               }  
            }
            // Vérification lorsque l'on se connecte en tant que visiteur
            else
            {
                $messageToPrint = "Visiteur";
                $userMode = "Visiteur";
                $nomClient = "N/A";
                $prenomClient = "N/A";
                $dateOfBirth = "N/A";
                $email = "N/A";
                $password = "N/A";
            }

            

    ?>
        <h1>
            <strong style="text-decoration: underline;">Bienvenue : <?php echo $messageToPrint; ?></strong>
        </h1>

        <div id="options">
            <input type="submit" value="Voir mon profil" onclick="showProfil()">
            <input type="submit" name="logOut" value="Se déconnecter" onclick="logOut()">
        </div><br>
              
    <?php
        // On va maintenant récuper (lire) les différents articles crées par l'administrateur dans la BDD
        // On récupère tout le contenu de la table publications

            $publications = $bdd->query('SELECT * FROM publications');
            $reqCommentaire = $bdd->query('SELECT * FROM commentaires ORDER BY publication_ID');
            $run = true;
        ?>
            <!--- // On affiche chaque entrée une à une ---->
    <?php   while ($donneesPublications = $publications->fetch()) { ?>

    <?php       if($userMode == "Visiteur") { ?>

                    <p>
                        <strong style="text-decoration: underline;">Publication n° : <?php echo $donneesPublications['id']; ?></strong><br />
                        <strong>Titre </strong> : <?php echo $donneesPublications['titre']; ?><br /><?php echo $donneesPublications['contenu']; ?><br />
                    </p>   
    <?php       }else if ($userMode == "Admin")  { ?>                 
                    <form action="update.php" method="post">

                        <?php
                        $id_Publication = $donneesPublications['id'];
                        $titre = $donneesPublications['titre'];
                        ?>
                        <!-- Je dois repasser toutes ces informations pour simuler le fait que je reviens d'une page exterieure et donc actualier la page blogStartPage.php avec mon compte en mémoire ---->
                        <input type="hidden" id="userMode" name="userMode" value = "<?php echo $userMode; ?>">
                        <input type="hidden" id="nom" name="nom" value = "<?php echo $nomClient; ?>">
                        <input type="hidden" id="prenom" name="prenom" value = "<?php echo $prenomClient; ?>">
                        <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $dateOfBirth; ?>">
                        <input type="hidden" id="email" name="email" value = "<?php echo $email; ?>">
                        <input type="hidden" id="id_Publication" name="id_Publication" value = "<?php echo $id_Publication; ?>">
                        <input type="hidden" id="password" name="password" value = "<?php echo $password; ?>">

                        <strong style="text-decoration: underline;">Publication n° : <?php echo $donneesPublications['id']; ?></strong><br>
                        <strong>Titre : </strong>
                        <label type="text" id="text" rows="2" cols="40" name="textToModif"><?php echo $titre; ?>                      
                        </label><br>
                        <?php $String = "modifPubli" . $i; ?>
                        <?php // $i++; echo nl2br("Le submit de cette publi a pour id : " . $String . "\n");?>
                        <strong>Contenu : </strong><br>
                        <textarea id="contenu" name="<?php echo $String; ?>" rows="5" cols="40"><?php echo $donneesPublications['contenu']; ?>
                        </textarea><br>
                        
                        <input  type="submit" name="modifPubli" value="Modifier la publication">
                        <input  type="submit" name="deletePubli" value="Supprimer la publication"><br>
                        
                    </form>
    <?php       }else if($userMode == "Client"){   ?>
                    <form action="update.php" method="post">
                        <?php
                            $id_Publication = $donneesPublications['id'];
                            $titre = $donneesPublications['titre'];
                        ?>
                            <!-- Je dois repasser toutes ces informations pour simuler le fait que je reviens d'une page exterieure et donc actualier la page blogStartPage.php avec mon compte en mémoire ---->
                            <input type="hidden" id="userMode" name="userMode" value = "<?php echo $userMode; ?>">
                            <input type="hidden" id="nom" name="nom" value = "<?php echo $nomClient; ?>">
                            <input type="hidden" id="prenom" name="prenom" value = "<?php echo $prenomClient; ?>">
                            <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $dateOfBirth; ?>">
                            <input type="hidden" id="email" name="email" value = "<?php echo $email; ?>">
                            <input type="hidden" id="id_Publication" name="id_Publication" value = "<?php echo $id_Publication; ?>">
                            <input type="hidden" id="password" name="password" value = "<?php echo $password; ?>">

                            <strong style="text-decoration: underline;">Publication n° : <?php echo $donneesPublications['id']; ?></strong><br>
                            <strong>Titre : </strong>
                            <label type="text" id="text" rows="2" cols="40" name="textToModif"><?php echo $titre; ?>                      
                            </label><br>
                            <strong>Contenu : </strong><br>
                            <textarea id="contenu" name="<?php echo $String; ?>" rows="5" cols="40"><?php echo $donneesPublications['contenu']; ?>
                            </textarea><br>
                    
                            <strong>Précédents commentaires : </strong><br><br>

                    <?php   while($run){
                                $comm = $reqCommentaire->fetch();

                                echo($comm['publication_ID'].'.');
                                echo($donneesPublications['id']);

                                // On voit (sur le site web) grâce aux 2 lignes ci-dessus que le commentaire d'id de publication 2 saute car on est encore à la publication d'id 1; cependant on s'attends à ce que ce commentaire soit évalué pour la publication d'id 2, mais lors du changement de publication, on incrémente la publication en cours, de 1 à 2, donc on veux -- l'id de la publication en cours avant de quitter le while($run) et de repasser dans le while($donneesPublications = $publications->fetch()) qui va incrémenter l'id de la publication de 0 à 1, et ainsi on est censé évaluer le commentaire 2.1 et ainsi de suite
                                // En gros, tant que c'est 1.1 alors le comm évalué appartient à la publication 1
                                if($comm['publication_ID'] == $donneesPublications['id']){ 

                                    $id_correspondant=$comm['utilisateur_ID'];
                                    $reqUser=$bdd->prepare('SELECT prenom, nom FROM utilisateurs WHERE id=?');
                                    $reqUser->execute(array($id_correspondant));
                                    $pseudo=$reqUser->fetch(); ?>

                                    <label id="showCommentaires" name="showCommentaires"><?php echo $pseudo['prenom'].' '.$pseudo['nom'].' a commenté : '.$comm['commentaireContenu']; ?></label><br>

                    <?php       }else{
                                    $run = false;
                                }
                            }
                            $run = true; ?>
                            <?php $String = "commentID" . $i; ?>
                            <?php // $i++; echo nl2br("Le submit de cette publi a pour id : " . $String . "\n");?>
                            <br><strong>Ajouter un commentaire ? </strong><br>
                            <textarea id="addCommentaire" name="addCommentaire" rows="2" cols="40"></textarea><br>
                            <input  type="submit" name="submitCommentaire" value="Poster votre commentaire"><br>
                    </form>
        <?php       }
            }
    $reqCommentaire->closeCursor();
    $publications->closeCursor();
           
    ?>
    <?php if($userMode == "Admin"){ ?>
        
        <!-- Ici on gère l'ajout d'une publication -->
        <div id="addPubliDiv"  style="display:none;"> 
            <form action="update.php" method="post">

                <!-- Je dois repasser toutes ces informations pour simuler le fait que je reviens d'une page exterieure et donc actualier la page blogStartPage.php avec mon compte en mémoire ---->
                <input type="hidden" id="userMode" name="userMode" value = "<?php echo $userMode; ?>">
                <input type="hidden" id="nom" name="nom" value = "<?php echo $nomClient; ?>">
                <input type="hidden" id="prenom" name="prenom" value = "<?php echo $prenomClient; ?>">
                <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $dateOfBirth; ?>">
                <input type="hidden" id="email" name="email" value = "<?php echo $email; ?>">
                <input type="hidden" id="id_Publication" name="id_Publication" value = "<?php echo $id_Publication; ?>">
                <input type="hidden" id="password" name="password" value = "<?php echo $password; ?>">

                <strong>Ajoutez une publication</strong><br>
                <input type="text" name="modifTittle" placeholder="Entrez le titre"><br>
                <textarea rows="5" cols="40" name="contenu">Entrez un contenu</textarea><br>
                <input  type="submit" name="submitPubli" value="Envoyer l'ajout">
                <input  type="submit" name="annulSubmitPubli" value="Annuler" onclick="showAndHideDiv('addPubli', 'annulSubmitPubli')"><br>

                </form>
        </div>
        
        <div>
            <input type="button" name="addPubli" value="Ajouter une publication" onclick="showAndHideDiv('annulSubmitPubli', 'addPubli')" />
        </div>
    <?php } ?>

    <div style="display:none;">
        <form action="myProfil.php" id="myProfilForm" method="POST">

            <input type="hidden" id="userMode" name="userMode" value = "<?php echo $userMode; ?>">
            <input type="hidden" id="nom" name="nom" value = "<?php echo $nomClient; ?>">
            <input type="hidden" id="prenom" name="prenom" value = "<?php echo $prenomClient; ?>">
            <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $dateOfBirth; ?>">
            <input type="hidden" id="email" name="email" value = "<?php echo $email; ?>">
            <input type="hidden" id="password" name="password" value = "<?php echo $password; ?>">
            <input type="hidden" id="id_Publication" name="id_Publication" value = "<?php echo $id; ?>">
            
        </form>
    </div>
    
     <script type="text/javascript">
        function showAndHideDiv(elementToShow, elementToHide) {
            if (document.getElementById('addPubliDiv').style.display !== "none") {
                document.getElementById('addPubliDiv').style.display = "none";
            } else {
                document.getElementById('addPubliDiv').style.display = "block";
            }
        }
        function logOut(){
            window.location.href="connectAccount.php";
        }
        function showProfil(){
             document.getElementById('myProfilForm').submit();
        }
    </script>
    </body>
</html>