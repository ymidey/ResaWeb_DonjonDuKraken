<footer class="footer">
    <div class="footer_addr">
        <img src="Images/Logo_DonjonKraken.svg" alt="" class="footer_logo">

        <h1>Nous contacter :</h1>
        <address>2 Rue Albert Einstein, 77420 Champs-sur-Marne <br>
            <p>Email : midey.yannick@gmail.com</p>
        </address>
    </div>

    <ul class="footer_nav">
        <li class="nav_item">
            <h2 class="nav_title">Nos évènements</h2>
            <ul class="nav_ul">
                <li>
                    <a href="nos-evenements.php?tri=date-croissant">Prochains évènements</a>
                </li>
                <li>
                    <a href="nos-evenements.php?tri=nouveauté">Nouveaux évènements</a>
                </li>
            </ul>
        </li>

        <li class="nav_item nav_item-extra">
            <h2 class="nav_title">Catégories d'évènements</h2>

            <ul class="nav_ul nav_ul--extra">
                <?php foreach ($resultCategorie as $row) { ?>
                    <li>
                        <a href="nos-evenements.php?categorie[]=<?php echo $row["ID_Categorie"] ?>"><?php echo $row["Nom_categorie"] ?></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <li class="nav_item">
            <h2 class="nav_title">À propos</h2>

            <ul class="nav_ul">
                <li>
                    <a href="a-propos.php#createur">Le créateur</a>
                </li>

                <li>
                    <a href="a-propos.php#concept">Le concept</a>
                </li>
                <li>
                    <a href="a-propos.php#mentionslegales">Mentions légals</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="legal">
        <p>&copy;2023 Le Donjon du Kraken. Tout droits reservés.</p>
    </div>

</footer>


</body>
<script src="js/script.js"></script>
<script src="js/scriptevenementpage.js"></script>

</html>