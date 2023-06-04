<footer class="footer">
    <div class="footer_addr">
        <img src="Images/Logo_DonjonKraken.svg" alt="" class="footer_logo">
        <h2>Nous contacter :</h2>
        <address>2 Rue Albert Einstein, 77420 Champs-sur-Marne <br>
            <p>Email : midey.yannick@gmail.com</p>
        </address>
    </div>

    <ul class="footer_nav">
        <li class="nav_item">
            <h3 class="nav_title">Nos évènements</h3>
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
            <h3 class="nav_title">Catégories d'évènements</h3>

            <ul class="nav_ul nav_ul--extra">
                <?php foreach ($resultCategorie as $row) { ?>
                    <li>
                        <a href="nos-evenements.php?categorie[]=<?php echo $row["ID_Categorie"] ?>"><?php echo $row["Nom_categorie"] ?></a>
                    </li>
                <?php } ?>
            </ul>
        </li>
        <li class="nav_item">
            <h3 class="nav_title">À propos</h3>

            <ul class="nav_ul">
                <li>
                    <a href="a-propos.php#createur">Le créateur</a>
                </li>

                <li>
                    <a href="a-propos.php#pourquoi">Le concept</a>
                </li>
                <li>
                    <a href="a-propos.php#mentionslegales">Mentions légals</a>
                </li>
            </ul>
        </li>
    </ul>

    <div class="legal">
        <p>&copy;2023 Le Donjon du Kraken.</p>
    </div>

</footer>


</body>

<!-- Appel des différents fichiers js utile au bon fonctionnement du site -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="js/script.js"></script>

</html>