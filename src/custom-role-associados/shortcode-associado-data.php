<?php 

defined('ABSPATH') or die();

// Criar shortcode para pasta do associado
function csc_shortcode_pasta_associado($atts) {
  $user_id = get_current_user_id();
  if (!$user_id || !current_user_can('associado')) {
      return '';
  }
  $url = get_user_meta($user_id, 'url_specific_folder', true);
  if (!$url) {
      return '';
  }
  $image_url = plugins_url('assets/pasta-do-associado.png', __FILE__);
  return "<a href='" . esc_url($url) . "' target='_blank'><img src='" . esc_url($image_url) . "' alt='Pasta do Associado' /></a>";
}
add_shortcode('url_pasta_especifica_minde', 'csc_shortcode_pasta_associado');

// Shortcode para exibir Nome do Associado
function csc_shortcode_nome_associado() {
  $user_id = get_current_user_id();
  if (!$user_id || !current_user_can('associado')) {
      return '';
  }
  $user = get_userdata($user_id);
  return esc_html($user->first_name . ' ' . $user->last_name);
}
add_shortcode('nome_associado_minde', 'csc_shortcode_nome_associado');

// Shortcode para exibir Nome da Usina
function csc_shortcode_nome_usina() {
  $user_id = get_current_user_id();
  if (!$user_id || !current_user_can('associado')) {
      return '';
  }
  $usina = get_user_meta($user_id, 'usina', true);
  return esc_html($usina);
}
add_shortcode('nome_usina_minde', 'csc_shortcode_nome_usina');

// Função global para obter o nome da Usina do Associado logado
function csc_get_usina_associado_logado() {
  // Verifica se há um usuário logado
  $user_id = get_current_user_id();
  if (!$user_id) {
      return null; // Retorna null se não houver usuário logado
  }

  // Verifica se o usuário logado tem a função de Associado
  if (!in_array('associado', (array) wp_get_current_user()->roles)) {
      return null; // Retorna null se o usuário não for um Associado
  }

  // Busca o valor do metafield 'usina'
  $usina = get_user_meta($user_id, 'usina', true);

  // Retorna o valor sanitizado ou null se estiver vazio
  return $usina ? esc_html($usina) : null;
}