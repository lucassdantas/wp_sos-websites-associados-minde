<?php 

defined('ABSPATH') or die();

// Registrar último acesso
function csc_register_last_login($user_login, $user) {
  if ($user->roles[0] === 'associado') {
      update_user_meta($user->ID, 'last_login', current_time('mysql'));
  }
}
add_action('wp_login', 'csc_register_last_login', 10, 2);

// Remover barra de ferramentas para usuários Associado
function csc_remove_toolbar_for_associado($show_toolbar) {
  if (current_user_can('associado')) {
      return false;
  }
  return $show_toolbar;
}
add_filter('show_admin_bar', 'csc_remove_toolbar_for_associado');