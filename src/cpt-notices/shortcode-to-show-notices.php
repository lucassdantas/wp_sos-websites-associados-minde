<?php 

defined('ABSPATH') or die();
// Shortcode para exibir Avisos
function csc_aviso_shortcode() {
  $user_id = get_current_user_id();
  if (!$user_id || !current_user_can('cliente')) {
      return '';
  }

  $args = [
      'post_type' => 'aviso',
      'meta_query' => [
          'relation' => 'OR',
          [
              'key' => '_clientes',
              'value' => 'all',
              'compare' => 'LIKE'
          ],
          [
              'key' => '_clientes',
              'value' => $user_id,
              'compare' => 'LIKE'
          ]
      ]
  ];

  $query = new WP_Query($args);
  $output = '';

  if ($query->have_posts()) {
      while ($query->have_posts()) {
          $query->the_post();
          $output .= '<div class="aviso">';
          $output .= '<h2>' . get_the_title() . '</h2>';
          $output .= '<div>' . get_the_content() . '</div>';
          $output .= '</div>';
      }
      wp_reset_postdata();
  }

  return $output;
}
add_shortcode('aviso_cliente_minde', 'csc_aviso_shortcode');