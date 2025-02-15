<?php 

if(!defined('ABSPATH'))exit;

// Redirecionar usuários Associado para a página /associado
function csc_redirect_associado_dashboard() {
  if (current_user_can('associado') && !defined('DOING_AJAX')) {
      wp_redirect(home_url('/associado'));
      exit;
  }
}
add_action('admin_init', 'csc_redirect_associado_dashboard');