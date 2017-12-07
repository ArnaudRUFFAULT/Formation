<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0" />
        <title>Les échecs</title>
    </head>
    <body>
        <header role="banner">
            <h1>Les échecs</h1>
            <hr />
            <p><em>Pour cet exercice : nous allons recréer un jeu d'échecs simplifié, via des objets.</em></p>
            <p><em>La partie ne peut débuter que lorsque deux joueurs sont connectés.<br />Une partie peut être interrompue en cours de jeu. Vous devez donc proposer un moyen de la reprendre lorsque les deux mêmes joueurs sont à nouveau connectés.<br />Tout au cours de la partie, nous devons disposer de l'historique des coups.</em></p>
            <p><em>Nous ne nous servirons que de quatre types de pièce différents en simplifiant leurs mouvements :</em></p>
            <ul style="font-style:italic;">
                <li><strong>le Roi</strong> : au nombre d'1 pièce par équipe, il peut se déplacer d'1 seule case. Le déplacement peut être soit horizontal soit vertical, en avant ou en arrière. Cette pièce ne peut pas sauter par dessus une autre.</li>
                <li><strong>la Reine</strong> : au nombre d'1 pièce par équipe, elle peut se déplacer d'un nombre de case illimité. Le déplacement peut être soit horizontal soit vertical, en avant ou en arrière. Cette pièce peut sauter par dessus une autre de sa propre couleur mais pas par dessus une pièce adverse.</li>
                <li><strong>les Cavaliers</strong> : au nombre de 2 pièces par équipe, ils peuvent se déplacer de 3 cases. Le déplacement peut être soit horizontal soit vertical, en avant ou en arrière. Cette pièce peut sauter par dessus une autre.</li>
                <li><strong>les Pions</strong> : au nombre de 4 pièces par équipe, ils peuvent se déplacer de 1 case seulement. Le déplacement ne peut être qu'horizontal vers l'avant. Cette pièce ne peut pas sauter par dessus une autre. Une fois arrivée sur la ligne adverse (en bout de plateau), elle permet de récupérer une pièce "mangée" (autre qu'un Pion) en ce changeant en cette dernière.</li>
            </ul>
            <p><em>Comme aux échecs classiques, on joue au tour par tour : honneur aux blancs !<br />Une pièce touchée est une pièce jouée (on ne peut donc pas déselectionner une pièce).<br />La partie s'arrête lorsque l'un des Rois est "Échec et Mat"; à savoir qu'il ne peut plus se déplacer sans risquer d'être "mangé" par une pièce adverse.</em></p>
        </header>
        <footer role="contentinfo">
            <span><?php echo date( 'Y' ); ?><sup>&copy;</sup> Tous droits réservés<?php echo ( defined( 'AUTHOR_NAME' ) ? ' - ' . AUTHOR_NAME : '' ); ?></span>
        </footer>
    </body>
</html>
