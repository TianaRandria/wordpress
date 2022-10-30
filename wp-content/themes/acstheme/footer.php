</div>
    <footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto'
    ])
    ?>
    </footer>
    <div>
        <?= get_option('agence_horaire') ?>  <!--lesona tao aminy option de page-->
    </div>
    <?php wp_footer() ?>
</body>
</html>