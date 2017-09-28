
<?php
ob_start(); // On initialise le tampon de sortie.
echo '<p>Lorem ipsum dolor sit amet</p>'; // On ajoute une balise HTML et du texte au tampon de sortie.
$tampon = ob_get_contents(); // On stocke le résultat des instructions précéentes dans une variable.
ob_end_clean(); // On ferme le tampon de sortie et le vide.

echo $tampon; // On affiche le contenu de la variable.
?>

<?php
function Censurer($buffer) {
     // Ici c'est notre fonction qui sera appelée avec ob_end_flush().
     $buffer = str_replace(array('patate', 'nain', 'chose'), '<span style="color: red;"> [Censuré] </span>', $buffer);
     return $buffer;
}
 
// On initialise le buffer :
ob_start('Censurer');
 
//… le contenu de notre page :
echo "J'aime bien les nains, surtout ceux qui mangent des patates et qui aiment faire des choses.";
/* 
   Ici, la fonction ob_end_flush() va être appelée,
   ce qui provoquera le retour du tampon au navigateur.
   Mais avant, notre fonction de callback sera
   automatiquement appelée pour appliquer la censure.
*/
ob_end_flush();
?>
<?php
ob_start(); // On initialise le tampon de sortie.
echo '<p>Lorem ipsum dolor sit amet</p>'.PHP_EOL;
echo "LOOOOOOOOOL".PHP_EOL;
echo "Blabliblou".PHP_EOL;
echo rand(0,10).PHP_EOL;
$tampon = ob_get_contents(); // On stocke le résultat des instructions précéentes dans une variable.
ob_end_clean(); // On ferme le tampon de sortie et le vide.
file_put_contents('Test.txt', $tampon);
echo str_replace(array(1,2,3,4,5,6,7,8,9),'',readfile('Test.txt'));


?>

