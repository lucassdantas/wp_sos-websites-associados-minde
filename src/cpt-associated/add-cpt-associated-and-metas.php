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
        'public'             => false, // Impede acesso público direto
        'publicly_queryable' => true, // Permite que usuários logados consultem
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'posts-associados'],
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-groups', // Ícone no menu do WP
        'supports'           => ['title', 'editor', 'author', 'thumbnail', 'excerpt'],
    ];

    register_post_type('posts_associados', $args);
}
add_action('init', 'csc_register_cpt_associados');
