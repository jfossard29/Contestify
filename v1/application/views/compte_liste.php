<h1><?php echo $titre;?></h1>
<br />
<?php
if($pseudos != NULL) {
    echo "Nombre de comptes présents dans la table :".$nb->nb;
foreach($pseudos as $login){
 echo "<br />";
 echo " -- ";
echo $login["cpti_pseudo"];
echo " -- ";
echo "<br />";
}
}
else {echo "<br />";
echo "Aucun compte !";
}
?>
