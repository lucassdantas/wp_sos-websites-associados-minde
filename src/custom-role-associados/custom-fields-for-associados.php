<?php 

defined('ABSPATH') or die();
// Adicionar campos personalizados na edição de usuário
function csc_add_custom_user_fields($user) {
    $fields = [
        'cidade' => __('Cidade', 'Associado-minde'),
        'estado' => __('Estado (UF)', 'Associado-minde'),
        'usina' => __('Usina', 'Associado-minde'),
        'url_specific_folder' => __('Link para pasta específica', 'Associado-minde')
    ];
    echo "<h3>Informações do Associado</h3><table class='form-table'>";
    foreach ($fields as $field => $label) {
        $value = get_user_meta($user->ID, $field, true);
        echo "<tr><th><label for='{$field}'>{$label}</label></th>";
        echo "<td><input type='text' id='{$field}' name='{$field}' value='" . esc_attr($value) . "' class='regular-text' /></td></tr>";
    }
    echo "</table>";
}
add_action('show_user_profile', 'csc_add_custom_user_fields');
add_action('edit_user_profile', 'csc_add_custom_user_fields');


// Salvar campos personalizados
function csc_save_custom_user_fields($user_id) {
  if (!current_user_can('edit_user', $user_id)) {return false;}
  
  $fields = ['cidade', 'estado', 'usina', 'url_specific_folder'];
  foreach ($fields as $field) {
      if (isset($_POST[$field])) {
          update_user_meta($user_id, $field, sanitize_text_field($_POST[$field]));
      }
  }
}
add_action('personal_options_update', 'csc_save_custom_user_fields');
add_action('edit_user_profile_update', 'csc_save_custom_user_fields');