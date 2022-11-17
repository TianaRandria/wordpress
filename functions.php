<?php
function acstheme_supports () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails'); 
    add_theme_support('menus'); 
    register_nav_menu('header', 'En tête du menu');
    register_nav_menu('footer', 'Pied de page');
    


    add_image_size( 'post-thumbnail', 350, 215, true); 
    remove_image_size('medium');
    add_image_size('medium', 500, 500);

}

function acstheme_register_assets(){


    wp_register_style('bootstrap' ,'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', []);
    wp_register_script('boostrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css', ['popper', 'jquery'], false, true);
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js', [], false, true);
    wp_deregister_script('jquery');
    wp_register_script('jquery','https://code.jquery.com/jquery-3.2.1.slim.min.js', [], false, true);
  
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('boostrap');
}

function acstheme_title_separator()
{
    return '|';
}

function acstheme_menu_class($classes)
{
    $classes[] = 'nav-item';
    return $classes;
}

function acstheme_menu_link_class($attrs)
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function acstheme_pagination()
{
    $pages = paginate_links(['type' => 'array']);
    if ($pages === null) {
        return;
    }
    echo '<nav aria-label="Page navigation example" class="my-4">';
    echo '<ul class="pagination">';
    foreach ($pages as $page) {
        $active = strpos($page, 'current') !== false;
        $class = 'page-item';
        if ($active) {
            $class .= ' active';
        }
        echo '<li class="' . $class . '">';
        echo str_replace('page-numbers', 'page-link', $page);
        echo '</li>';
    }
    echo '</ul>';
    echo '</nav>';
}
   function acstheme_add_custom_box (){
    add_meta_box('acstheme_sponso','Sponsoring','acstheme_render_sponso_box','post','side');
   }

function acstheme_render_sponso_box(){
    ?>
    <input type="hidden" value="0" name="acstheme_sponso">
    <input type="checkbox" value="1" name="acstheme_sponso">
    <label for="acsthemesponso">Cet article est sponsorisé?</label>
    <?php

}

function acstheme_save_sponso ($post_id){
    if(array_key_exists('acstheme_sponso', $_POST)){
        if($_POST['acstheme_sponso'] === '0') {
            delete_post_meta($post_id,'acstheme_sponso');

        }else{
            update_post_meta($post_id,'acstheme_sponso', 1);
        }
        die();
    }
}
function acstheme_init(){
    register_taxonomy('sport','post',[
        'labels' => [
            'name' => 'Sport',
            'singular_name'     => 'Sport',
            'plural_name'       => 'Sports',
            'search_items'      => 'Rechercher des sports',
            'all_items'         => 'Tous les sports',
            'edit_item'         => 'Editer le sport',
            'update_item'       => 'Mettre à jour le sport',
            'add_new_item'      => 'Ajouter un nouveau sport',
            'new_item_name'     => 'Ajouter un nouveau sport',
            'menu_name'         => 'Sport',
        ],
        'show_in_rest' => true,
        'hierarchical' => true,
        'show_admin_column' => true,


    ]);
    /******************************CUSTOM POST TYPE */
    register_post_type('bien', [
        'label' => 'Bien',
        'public' => true,
        'menu_position' => 3, /**eto no hidefinisséna oe aiza ho aiza ny placenilay type ery aminy barre maintimainty) */
        'menu_icon' => 'dashicons-building', /** icone alaina ao dashicons/ */
        'supports' => ['title', 'editor','thumbnail' ], /**fanasiana ny image mis en avion ao amin'ilay type vao noforonina teo */
        'show_in_rest' => true,
        'has_archive' => true
/**lorsqu'on enregistre un nouveau post type il faut re sauvegarder les permaliens*/
    ]);
}

add_action('init','acstheme_init');
add_action('after_setup_theme', 'acstheme_supports');
add_action('wp_enqueue_scripts', 'acstheme_register_assets');
add_filter('document_title_separator', 'acstheme_title_separator');
add_filter('nav_menu_css_class', 'acstheme_menu_class');
add_filter('nav_menu_link_attributes', 'acstheme_menu_link_class');


require_once('metaboxes/sponso.php');
require_once('options/agence.php');

SponsoMetaBox::register();
AgenceMenuPage::register();


/*****************eto dray manampy colonne ao amin'ilay Categorie ohatra hoe Bien no noforonina voalohany */

add_filter('manage_bien_posts_columns', function ($columns) {
    return [
        'cb' => $columns['cb'],
        'thumbnail' => ['Miniature'],
        'title' => $columns['title'],
        'date' => $columns['date']
    ];
});

add_filter('manage_bien_posts_custom_column', function ($column, $postId) {
    if ($column === 'thumbnail') {
        the_post_thumbnail('thumbnail', $postId);
    }
}, 10, 2);

add_action('admin_enqueue_scripts', function () {
    wp_enqueue_style('admin_acstheme', get_template_directory_uri() . '/assets/admin.css');
});

add_filter('manage_post_posts_columns', function ($columns) {
    $newColumns = [];
    foreach($columns as $k => $v){
        if ($k === 'date'){
            $newColumns['sponso'] = 'Article sponsorisé ?' ;
        }
        $newColumns [$k] = $v;
    }
    return $newColumns;
});

add_filter('manage_post_posts_custom_column', function ($column, $postId) {
    if ($column === 'sponso') {
        if (!empty(get_post_meta($postId, SponsoMetaBox::META_KEY, true))) {
            $class = 'yes';
        } else {
            $class = 'no';
        }
        echo '<div class="bullet bullet-' . $class . '"></div>';
    }
}, 10, 2);


/**Chapitre 22 ,l'action pre_get_posts */
/**
 * @param WP_Query $query
 */
function acstheme_pre_get_posts($query) {
    if (is_admin() || !is_search() || !$query->is_main_query()){
        return;
    }

if(get_query_var('sponso') === '1'){
    $meta_query = $query->get('meta_query', []);
    $meta_query[] = 
    [
       'key' => SponsoMetaBox::META_KEY,
       'compare' => 'EXISTS',
    ];
    $query->set('meta_query',$meta_query);
}
 
}

function acstheme_query_vars ($params){
    $params[] ='sponso';
   return $params;
}
add_action('pre_get_posts', 'acstheme_pre_get_posts');
add_filter('query_vars','acstheme_query_vars');



/****************************SIDEBAR ******/
require_once 'widgets/YoutubeWidget.php';
   function acstheme_register_widget (){
    register_widget(YoutubeWidget::class);
    register_sidebar([
    'id' => 'homepage',
    'name' => 'Sidebar Accueil',
    'before_widget' => '<div class="p-4 %2$s" id="%1$s">',
    'after_widget' => '</div>',
    'before_title' => ' <h4 class="font-italic">',
    'after_title'  => '</h4>'
    ]);
   }
   
   add_action('widgets_init','acstheme_register_widget');