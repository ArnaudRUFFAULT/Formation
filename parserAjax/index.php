<?php
session_start();

spl_autoload_register(function($className)
{
    $file = 'class' . DIRECTORY_SEPARATOR . $className . '.php';
    
    if(file_exists($file))
    {
        require($file);
    }
});

if(!isset($_POST['calcul'])){
	?>
	<!DOCTYPE html>
	<html>
	<head>
		<meta charset="utf8"/>
		<title>Parser</title>
		<script type="text/javascript" src="ajax.js"></script>
	</head>
	<body>
	<h1>Parser</h1>
	<p>Un parser est un logiciel capable de lire et interpréter un langage paticulier, ici des expressions mathématiques.</p>
	<p>Le projet est actuellement capable de comprendre le langage, mais fais appel aux sous-classes d'Expression, qui ne sont pas complètes, pour l'interprétation. Votre but est de compléter ces classes afin qu'elles respectent leur documentation.</p>
	<p>Attention à bien effectuer vos calculs et effets de bords dans la fonction Evaluate, et pas ailleurs! Vous pouvez déclencher des LogicException en cas d'erreur.</p>
	<h2>Syntaxe</h2>
	<ul>
		<li><em>+</em>, <em>-</em>, <em>*</em>, <em>/</em> pour les opérations de base</li>
		<li><em>=</em>, <em>&gt;</em>, <em>&lt;</em>, <em>&gt;=</em>, <em>&lt;=</em> pour les comparaisons</li>
		<li><em>(</em> et <em>)</em> pour les priorités opératoires</li>
		<li>Vous pouvez sauvegarder des valeurs dans des variables avec <em>nom <- valeur</em> et les lires avec le nom de la variable</li>
		<li>Vous pouvez effectuer plusieurs opérations en les séparant par des <em>;</em></li>
	</ul>
	<form id="form" action="." method="POST">
		<input id="monCalcul" type="text" name="input" autocomplete="off"/>
		<input type="submit"/>
	</form>
	<hr/>
	<div id="affichageResultat">
	<?php
	if(isset($_POST['input'])){
		
		try
		{
			$input = new TokenStream($_POST['input']);
			$parser = new SyntaxParser($input);
			foreach ($parser->Generate() as $expr)
			{
				try
				{
					echo $expr->Evaluate();
				}
				catch(LogicException $e)
				{
					echo 'Error : ' . $e->getMessage();
				}
				echo '<br/>';
			}
		}

		catch(ParseException $e)
		{
			echo $e->getMessage();
		}
	}
}
if(isset($_POST['calcul'])){

	try
	{
		$input = new TokenStream($_POST['calcul']);
		$parser = new SyntaxParser($input);
		foreach ($parser->Generate() as $expr)
		{
			try
			{
				echo $expr->Evaluate();
			}
			catch(LogicException $e)
			{
				echo 'Error : ' . $e->getMessage();
			}
		}
	}
	catch(ParseException $e)
	{
		echo $e->getMessage();
	}
}
if(!isset($_POST['calcul'])){
?>
</div>
</body>
</html>
<?php }?>