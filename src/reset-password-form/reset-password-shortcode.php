<?php 

if(!defined('ABSPATH')) exit;

function custom_reset_password_form() {
  ob_start();
  
  if (isset($_GET['key']) && isset($_GET['login'])) {
      return '<p>Use o link enviado ao seu e-mail para redefinir a senha.</p>';
  }
  
  ?>
  <form method="post">
      <label for="user_login">E-mail ou Nome de Usuário</label>
      <input type="text" name="user_login" required>
      <input type="submit" name="submit" value="Redefinir Senha">
  </form>
  <?php
  
  if (isset($_POST['submit'])) {
      $user_login = $_POST['user_login'];
      $user = get_user_by('email', $user_login) ?: get_user_by('login', $user_login);

      if ($user) {
          $reset_key = get_password_reset_key($user);
          $reset_link = network_site_url("wp-login.php?action=rp&key=$reset_key&login=" . rawurlencode($user->user_login));
          
          // Enviar e-mail com o link de redefinição
          wp_mail($user->user_email, "Redefinição de Senha", "Acesse este link para redefinir sua senha: $reset_link");
          
          echo '<p>Se o e-mail ou nome de usuário existir, um link de redefinição foi enviado.</p>';
      } else {
          echo '<p>Usuário não encontrado.</p>';
      }
  }
  
  return ob_get_clean();
}
add_shortcode('reset_password_form', 'custom_reset_password_form');
