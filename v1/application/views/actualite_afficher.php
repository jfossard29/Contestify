<h1><?php echo $titre;?></h1>
<br />
<?php
if(isset($actu)) {
echo $actu->act_titre;
echo(" -- ");
echo $actu->act_texte;
}
else {echo "<br />";
echo "pas d’actualité !";
}
?>
