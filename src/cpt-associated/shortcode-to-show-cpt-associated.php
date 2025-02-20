<?php
defined('ABSPATH') or die();

function csc_shortcode_associados($atts) {
    $posts_por_pagina = 6;
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = [
        'post_type'      => 'posts_associados',
        'posts_per_page' => $posts_por_pagina,
        'paged'          => $paged
    ];
    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        echo '<div class="elementor-container">';
        echo '<div class="elementor-row">';

        while ($query->have_posts()) {
            $query->the_post();

            $post_slug = get_post_field('post_name', get_the_ID());
            $post_date = get_the_date('d/m/Y'); // Data do post no formato 'dd/mm/yyyy'

            echo '<div class="elementor-column" style="width: 100%;">';
            echo '  <div class="elementor-card" style="width: 100%; background-color:#fff; border: 1px solid #ddd; border-radius: 8px; box-shadow: 2px 2px 10px rgba(0,0,0,0.1); text-align: left;">';
            echo '      <h3 style="margin-top: 10px; font-size:18px;"><a style="color:#009600;" href="' . esc_url(home_url('/posts-associados/' . $post_slug)) . '">' . get_the_title() . '</a></h3>';
            echo '      <hr style="margin: 10px 0; width:100%;color: #eee;">'; // Linha separadora
            echo '      <p style="font-size:14px; color: #eee;">' . $post_date . '</p>'; // Exibe a data do post
            echo '  </div>';
            echo '</div>';
        }

        echo '</div>'; // Fechar elementor-row
        echo '</div>'; // Fechar elementor-container

        echo '<div style="text-align: center; margin-top: 20px;">';
        echo paginate_links([
            'total'   => $query->max_num_pages,
            'current' => $paged,
            'prev_text' => '« Anterior',
            'next_text' => 'Próximo »',
        ]);
        echo '</div>';
    } else {
        echo '<p>Nenhum post encontrado.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}

add_shortcode('associados_posts', 'csc_shortcode_associados');
