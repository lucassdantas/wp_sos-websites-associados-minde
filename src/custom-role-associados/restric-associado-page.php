<?php 

defined('ABSPATH') or die();
function restringir_acesso_associado() {
  if (
    is_page('associado') && 
    !current_user_can('administrator') && 
    !current_user_can('editor') && 
    !current_user_can('author') && 
    !current_user_can('associado')) {
      wp_redirect(home_url()); // Redireciona para a página inicial
      exit;
  }
}
//add_action('template_redirect', 'restringir_acesso_associado');

