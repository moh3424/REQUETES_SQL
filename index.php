<!DOCTYPE html>
<?php
// -Connexion à la base de données BDD:
$pdo = new PDO ('mysql:host=localhost;dbname=immobilier', // driver mysql : serveur; nom de la PDD
                'root',// pseudo de la BDD
                '', // Mot de passe de la BDD
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,// option1 : pour affichez les erreurs SQL
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8') // option 2 : définit le jeu de caractères des échanges avec la BDD
                );


        



?>




<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
   
	<title>Ma Boutique</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

</head>
<body>

<h1>La maison du bonheur! Location et vente dans toute la france</h1> 
<div class ='row'>

  <div class = 'col-lg-3'>
      <p>1/ Afficher le nom des agences : <code>SELECT * FROM agence</code></p>
        <d>1bis/
  </div> en les triant par nom : <code>SELECT * FROM agence ORDER BY nom  ASC</code></p>
    <hr>

<?php 
    $resultat = $pdo->prepare("SELECT * FROM agence");
    $resultat->execute();
?>

<div class ='col-lg-9'>
    <legend scope="col">Agence</legend>
    <table class="table table-hover" border ="1">
    <thead class="thead-dark">
    <th>Nom</th>
    <th>Adresse</th>
    </thead>
    <?php 
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        //  var_dump($commentaire);
        echo '<tr>';
        echo '<td>' . $ligne['nom'] . ' .</td>';
        echo '<td>' . $ligne['adresse'] . ' .</td>';
        echo '</tr>';
        }
    ?>
    </table>
</div>
    </div>
 <hr>
 <div class ='row'>
 <?php 
    $resultat = $pdo->prepare("SELECT idAgence, nom FROM agence WHERE nom='orpi'");
    $resultat->execute();
?>
 
      <div class="col-lg-3">
            <p>2/ Afficher le numéro ou l'identifiant de l'agence Orpi
                <code>SELECT idAgence FROM agence WHERE nom='orpi'</code>
            </p>
      </div>
    
    <div class='col-lg-9'>
            <table class="table table-hover" border ="1">
            <thead class="thead-dark">
                <th>Numéro</th>
                <th>Nom de l'agence</th>
            </thead>
        <?php 
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
            //  var_dump($ligne);
            echo '<tr>';
            echo '<td>' . $ligne['idAgence'] . '.</td>';
            echo '<td>' . $ligne['nom'] . '.</td>';
            echo '</tr>';    
            }
        ?>
        </table>
    </div>
 </div>

<?php 
    $resultat = $pdo->prepare("SELECT * FROM logement ORDER BY idLogement, ville DESC LIMIT 0,4");
    $resultat->execute();
?>
 <hr>
<div class ="row">
     <div class='col-lg-3'>
            <p>3/ Quel est le premier enregistrement de la table logement ? :
                <code>SELECT * FROM logement LIMIT 0,1</code>
                    Si on veut les 2 premiers ex. <code>SELECT * FROM logement LIMIT 0,2</code> etc.
                <code>SELECT * FROM logement ORDER BY idLogement, ville DESC LIMIT 0,4</code>
            </p>
     </div>
    
    <div class ="col-lg-9">
            <table class="table table-hover" border ="1">
        
            <thead class="thead-dark">
                <th>Genre</th>
                <th>Ville</th>
                <th>Prix</th>
                <th>Categorie</th>
                <th>Surface</th>
            </thead >
        <?php 
            while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
            //  var_dump($ligne);
             echo '<tr>';
                    echo '<td>' . $ligne['genre'] . '.</td>';
                    echo '<td>' . $ligne['ville'] . '.</td>';
                    echo '<td>' . $ligne['prix'] . '.</td>';
                    echo '<td>' . $ligne['categorie'] . '.</td>';
                    echo '<td>' . $ligne['superficie'] . '.</td>';
            echo '</tr>' ; 
            }
        ?>
           
        </table>
    </div>
</div>

<div class="row">
    <div class="col-lg-3">
         <p>3bis/ Quel est le dernier enregistrement de la table logement ? :
            <code>SELECT * FROM logement WHERE idLogement =(SELECT max(idLogement) FROM logement)</code>
        </p>
    </div>
        <hr>
    
    
    <?php 
        $resultat = $pdo->prepare("SELECT * FROM logement WHERE idLogement =(SELECT max(idLogement) FROM logement)");
        $resultat->execute();
    ?>
    <div class="col-lg-9">
        <table class="table table-hover" border ="1">
        
        <thead class="thead-dark">
            <th>Genre</th>
            <th>Ville</th>
            <th>Prix</th>
            <th>Categorie</th>
            <th>Surface</th>
        </thead >
        <?php 
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        //  var_dump($ligne);
         echo '<tr>';
                echo '<td>' . $ligne['genre'] . '.</td>';
                echo '<td>' . $ligne['ville'] . '.</td>';
                echo '<td>' . $ligne['prix'] . '.</td>';
                echo '<td>' . $ligne['categorie'] . '.</td>';
                echo '<td>' . $ligne['superficie'] . '.</td>';
        echo '</tr>' ; 
        }
        ?>
        </table>
    </div>
</div>

 <div class="row">
       <div class ='col-lg-3'>
           <p>4/Afficher le nombre de logement (avec un alias "nombre_de_logement") ? qui va permettre de créer une tbake virtuelle :
                <code>SELECT COUNT(*) AS 'nombre de logements' FROM logement</code>
           </p>
       </div>
        <hr>
    
    
    <?php 
        $resultat = $pdo->prepare("SELECT COUNT(*)  FROM logement");
        $resultat->execute();
        $resultat->rowCount();
    ?>
    <div class="col-lg-9">
        <?php echo $resultat->rowCount() ?>
        <table class="table table-hover" border ="1">
        
        <thead class="thead-dark">
            <th>nombre de logements</th>
        </thead >
        <?php 
        $a=0;
        while ($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        //  var_dump($ligne);
        $a++;
         echo '<tr>';
                echo '<td>' . $resultat->rowCount() . '.</td>';
             
        echo '</tr>' ; 
        }
        ?>
        </table>
    </div>
 </div>
    
</body>
</html>