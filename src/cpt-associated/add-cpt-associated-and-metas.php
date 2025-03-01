<?php

defined('ABSPATH') or die();
if (!defined('ABSPATH')) exit;

// Registrar o CPT "posts_associados"
function csc_register_cpt_associados() {
    $labels = [
        'name'               => __('Posts de Associados', 'associados-minde'),
        'singular_name'      => __('Post de Associado', 'associados-minde'),
        'menu_name'          => __('Posts de Associados'),
        'add_new'            => __('Adicionar Novo'),
        'add_new_item'       => __('Adicionar Novo Post de Associado'),
        'edit_item'          => __('Editar Post de Associado'),
        'new_item'           => __('Novo Post de Associado'),
        'view_item'          => __('Ver Post de Associado'),
        'view_items'         => __('Ver Posts de Associados'),
        'search_items'       => __('Buscar Posts de Associados'),
        'not_found'          => __('Nenhum post encontrado'),
        'not_found_in_trash' => __('Nenhum post encontrado na lixeira')
    ];
    $args = [
      'labels'             => $labels,
      'public'             => true, 
      'publicly_queryable' => true, // Agora o single post pode ser acessado
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => ['slug' => 'posts-associados'],
      'capability_type'    => 'post',
      'has_archive'        => true,
      'hierarchical'       => false, // Recomendo false para posts normais
      'menu_position'      => 5,
      'menu_icon'          => 'dashicons-groups',
      'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt'],
      'exclude_from_search' => false,
      'show_in_nav_menus' => false,
    ];

    register_post_type('posts_associados', $args);
}
add_action('init', 'csc_register_cpt_associados');
