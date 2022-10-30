<!--ity ilay barre de recherche-->

<form class="d-flex" action="<?= esc_url(home_url('/')) ?>">  <!--aza adino manisy an'io esc io rehefa misy formulaire -->
    <input class="form-control me-2" name="s" type="search" placeholder="Recherche" aria-label="Search" value="<?= get_search_query() ?>">
    <button class="btn btn-outline-dark" type="submit">Rechercher</button>
</form>