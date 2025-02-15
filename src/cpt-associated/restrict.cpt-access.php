<?php 

defined('ABSPATH') or die();

function csc_restringir_acesso_cpt_associados($query) {
  if (!is_admin() && $query->is_main_query() && is_singular('posts_associados')) {
      if (!current_user_can('administrator') && 
          !current_user_can('editor') && 
          !current_user_can('author') && 
          !current_user_can('associado')) {
              
          wp_redirect(home_url()); // Redireciona para a página inicial
          exit;
      }
  }
}
add_action('template_redirect', 'csc_restringir_acesso_cpt_associados');
