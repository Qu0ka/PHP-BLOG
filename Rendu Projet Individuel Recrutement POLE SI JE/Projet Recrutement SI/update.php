<?php
$comptPublis = 0;
$comptUsers = 0;
try{
    $bdd = new PDO('mysql:host=localhost;dbname=projet_recrutement_si_db;charset=utf8', 'root', 'root');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}
// On lis toutes les publications de la table
$publis = $bdd->query('SELECT * FROM publications');
$users = $bdd->query('SELECT * FROM utilisateurs');

while ($donnees = $publis->fetch()){
    $comptPublis++;
    // A chaque publication on incrémentaire un compteur
}
// Ici on gère la modification d'une publication ou d'une suppresion
if(isset($_POST['modifPubli']) OR isset($_POST['deletePubli'])){

        //On parcours à l'aide d'un string qui prend successivement les valeurs des boutons modif publication possibles
        // Comme ça on peut envoyer la bonne zone de texte modifiée au bon endroit
        for($k = 1; $k < $comptPublis; $k++){

            $String = "modifPubli" . $k;

            if(isset($_POST[$String])){
                echo "The comment that you entered is:" . "<br><br>" . $_POST[$String];
                echo "L'id de la publication associée est" . "<br><br>" . $_POST['id_Publication'];

                $req = $bdd->prepare('UPDATE publications SET contenu = :contenu WHERE id = :id_Publication');
                $req->execute(array('contenu' => $_POST[$String], 'id_Publication' => $_POST['id_Publication']));
            }
        
        if(isset($_POST['deletePubli'])){
                echo "L'id de la publication associée que l'on supprime est" . "<br><br>" . $_POST['id_Publication'];
                $bdd->query('ALTER TABLE publications AUTO_INCREMENT = 1');
                $req = $bdd->prepare('DELETE FROM publications WHERE id = :id_Publication');
                $req->execute(array('id_Publication' => $_POST['id_Publication']));
        }
    }
}
// Ici on gère l'ajout effectif d'une publication en utilisant la requete (ici, préparée) INSERT INTO de mySQL
if(isset($_POST['submitPubli'])){
    $bdd->query('ALTER TABLE publications AUTO_INCREMENT = 1');
    $req = $bdd->prepare('INSERT INTO publications(titre, contenu) VALUES(:titre, :contenu)');
    $req->execute(array(
    'titre' => $_POST['modifTittle'], 'contenu' => $_POST['contenu']));
}

// Ici on gère la modification des informations de l'admin ou du client en utilisant la requete (ici, préparée) UPDATE SET de mySQL
// La vérification du type d'utilisateur est faite sur myProfil.php
if(isset($_POST['submitInfo'])){
    $req = $bdd->prepare('UPDATE utilisateurs SET nom = :nom, prenom = :prenom, dateOfBirth = :dateOfBirth, email = :email, password = :password WHERE id = :id');
    $req->execute(array(
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'dateOfBirth' => $_POST['dateOfBirth'],
    'email' => $_POST['email'],
    'password' => $_POST['password'],
    'id_Publication' => $_POST['id_Publication']
    ));
}

// Ici on gère l'ajout effectif d'un commentaire en utilisant la requete (ici, préparée) INSERT INTO de mySQL
if(isset($_POST['submitCommentaire'])){

    $bdd->query('ALTER TABLE commentaires AUTO_INCREMENT = 1'); //Ignore cette ligne

    $reponse = $bdd->prepare('SELECT * FROM utilisateurs WHERE nom = :nom');
    $reponse->execute(array('nom' => $_POST['nom']));

    while ($donnees = $reponse->fetch())
    {
        $id_Client = $donnees['id'];
    }
    /*echo "The comment that you entered is:" . "<br><br>" . $_POST['addCommentaire'];
    echo "L'id de la publication associée est" . "<br><br>" . $_POST['id_Publication'];
    echo "L'id de l'utilisateur associé est" . "<br><br>" . $id_Client;*/

    $req = $bdd->prepare('INSERT INTO commentaires(commentaireContenu, utilisateur_ID, publication_ID) VALUES(:commentaireContenu, :utilisateur_ID, :publication_ID)');
    $req->execute(array(
    'commentaireContenu' => $_POST['addCommentaire'],
    'utilisateur_ID' => $id_Client,
    'publication_ID' => $_POST['id_Publication']));
}


?>
<!-- Comme dans la page myProfil.php, ce formulaire sert de passage d'information pour le retour automatique sur la page blogStart.php -->
<form action="blogStartPage.php" id="goBackForm" method="POST">
    <input type="hidden" id="userMode" name="userMode" value = "<?php echo $_POST['userMode']; ?>">
    <input type="hidden" id="nom" name="nom" value = "<?php echo $_POST['nom']; ?>">
    <input type="hidden" id="prenom" name="prenom" value = "<?php echo $_POST['prenom']; ?>">
    <input type="hidden" id="dateOfBirth" name="dateOfBirth" value = "<?php echo $_POST['dateOfBirth']; ?>">
    <input type="hidden" id="email" name="email" value = "<?php echo $_POST['email']; ?>">
    <input type="hidden" id="password" name="password" value = "<?php echo $_POST['password']; ?>">
</form>

<!-- Le formulaire de retour est submit automatiquement (javascript) -->
<script type="text/javascript">
    document.getElementById('goBackForm').submit();
</script>