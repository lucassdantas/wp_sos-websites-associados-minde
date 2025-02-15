<?php

defined('ABSPATH') or die();
// Registrar Custom Post Type para Avisos
function csc_register_aviso_cpt() {
  register_post_type('aviso', [
      'label' => __('Avisos', 'associados-minde'),
      'public' => true,
      'show_in_menu' => true,
      'supports' => ['title', 'editor'],
      'capability_type' => 'post',
      'labels' => [
          'name' => __('Avisos', 'associados-minde'),
          'singular_name' => __('Aviso', 'associados-minde')
      ]
  ]);
}
add_action('init', 'csc_register_aviso_cpt');

// Adicionar campos personalizados ao CPT Aviso
function csc_add_aviso_meta_boxes() {
  add_meta_box('aviso_meta', __('Configurações do Aviso', 'associados-minde'), 'csc_render_aviso_meta_box', 'aviso', 'normal', 'high');
}
add_action('add_meta_boxes', 'csc_add_aviso_meta_boxes');


function csc_render_aviso_meta_box($post) {
  wp_nonce_field('save_aviso_meta', 'aviso_meta_nonce');

  $associados = get_users(['role' => 'associado']);
  $selected_clients = get_post_meta($post->ID, '_associados', true) ?: [];
  $expiration = get_post_meta($post->ID, '_expiration', true);

  echo '<label for="associados">Associados:</label><select id="associados" name="associados[]" multiple="multiple">';
  echo '<option value="all"' . (in_array('all', $selected_clients) ? ' selected' : '') . '>Todos</option>';
  foreach ($associados as $associado) {
      $selected = in_array($associado->ID, $selected_clients) ? ' selected' : '';
      echo '<option value="' . esc_attr($associado->ID) . '"' . $selected . '>' . esc_html($associado->display_name) . '</option>';
  }
  echo '</select>';

  echo '<label for="expiration">Data de Expiração:</label>';
  echo '<input type="date" id="expiration" name="expiration" value="' . esc_attr($expiration) . '" />';
}