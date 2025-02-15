<?php 

if(!defined('ABSPATH')) exit;
// Adicionar a nova função de usuário Associado
function csc_add_user_role_associado() {
  error_log('A função csc_add_user_role_associado foi chamada.');
  if (!get_role('associado')) {
      add_role('associado', __('Associado', 'associados-minde'), get_role('subscriber')->capabilities);
  }
}
//register_activation_hook(__FILE__, 'csc_add_user_role_associado');

// Transformar Associado em assinantes ao desativar o plugin
function csc_remove_user_role_associado() {
  $users = get_users(['role' => 'associado']);
  foreach ($users as $user) {
      $user->set_role('subscriber');
  }
  remove_role('associado');
}
//register_deactivation_hook(__FILE__, 'csc_remove_user_role_associado');