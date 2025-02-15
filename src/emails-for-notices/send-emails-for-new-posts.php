<?php 

defined('ABSPATH') or die();
// Função para enviar e-mail com aviso personalizado
function csc_send_aviso_email($client, $title) {
  $subject = __('Novo Aviso Publicado', 'Associados-minde');

  // Obtém o nome e o link personalizado do cliente
  $client_name = $client->display_name;
  $client_url = home_url('/associado'); // Substitua pelo link correto da área restrita do cliente

  $message = sprintf(
      __("Olá %s,\n\nUm novo aviso foi publicado na sua Área Restrita.\n\nAcesse o site para mais detalhes: %s\n\nAtenciosamente,\nSete Confiança", 
      'associados-minde'),
      $client_name,
      $client_url
  );

  wp_mail($client->user_email, $subject, $message);
}

function csc_save_aviso_meta($post_id) {
  if (!isset($_POST['aviso_meta_nonce']) || !wp_verify_nonce($_POST['aviso_meta_nonce'], 'save_aviso_meta')) {
      return;
  }

  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return;
  }

  if (!current_user_can('edit_post', $post_id)) {
      return;
  }

  $associados = isset($_POST['associados']) ? array_map('sanitize_text_field', $_POST['associados']) : [];
  $expiration = isset($_POST['expiration']) ? sanitize_text_field($_POST['expiration']) : '';

  update_post_meta($post_id, '_associados', $associados);
  update_post_meta($post_id, '_expiration', $expiration);

  $post_title = get_the_title($post_id);

  if (in_array('all', $associados)) {
      // Enviar e-mail para todos os associados
      $all_clients = get_users(['role' => 'associado']);
      foreach ($all_clients as $client) {
          csc_send_aviso_email($client, $post_title);
      }
  } else {
      // Enviar e-mail apenas para os associados específicos
      foreach ($associados as $associado_id) {
          $client = get_userdata($associado_id);
          if ($client) {
              csc_send_aviso_email($client, $post_title);
          }
      }
  }
}
add_action('save_post', 'csc_save_aviso_meta');