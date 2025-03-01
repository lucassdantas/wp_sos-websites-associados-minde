<?php 

defined('ABSPATH') or die();

// Página administrativa personalizada para Associados
function csc_add_associados_admin_page() {
  add_menu_page(
      __('Associados', 'associados-minde'),
      __('Associados', 'associados-minde'),
      'list_users',
      'associados-list',
      'csc_render_associados_page',
      'dashicons-businessman',
      50
  );
}
add_action('admin_menu', 'csc_add_associados_admin_page');

function csc_render_associados_page() {
  if (!current_user_can('list_users')) {
      wp_die(__('Você não tem permissão para acessar esta página.', 'associados-minde'));
  }

  $search = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : '';
  $filter_by = isset($_GET['filter_by']) ? sanitize_text_field($_GET['filter_by']) : '';

  echo "<div class='wrap'><h1>Associados</h1>";
  echo "<form method='get'><input type='hidden' name='page' value='associados-list' />";
  echo "<input type='text' name='s' value='" . esc_attr($search) . "' placeholder='Buscar Associados...' />";
  echo "<select name='filter_by'>";
  echo "<option value=''>Filtrar por</option>";
  echo "<option value='nome' " . selected($filter_by, 'nome', false) . ">Nome</option>";
  echo "<option value='usina' " . selected($filter_by, 'usina', false) . ">Usina</option>";
  echo "</select>";
  echo "<button type='submit' class='button'>Filtrar</button></form>";

  $args = ['role' => 'associado'];

  if ($search) {
      if ($filter_by === 'nome') {
          $args['search'] = '*' . esc_attr($search) . '*';
          $args['search_columns'] = ['display_name'];
      } elseif ($filter_by) {
          $args['meta_query'] = [
              [
                  'key' => $filter_by,
                  'value' => $search,
                  'compare' => 'LIKE'
              ]
          ];
      }
  }

  $associados = get_users($args);

  echo "<table class='wp-list-table widefat fixed striped users'><thead><tr>";
  echo "<th>Nome do Associado</th><th>Email</th><th>Usina</th><th>Pasta do Associado</th><th>Último Acesso</th></tr></thead><tbody>";

  foreach ($associados as $associado) {
      $usina = get_user_meta($associado->ID, 'usina', true);
      $url = get_user_meta($associado->ID, 'url_specific_folder', true);
      $ultimo_acesso = get_user_meta($associado->ID, 'last_login', true);
      $edit_link = admin_url('user-edit.php?user_id=' . $associado->ID);

      echo "<tr><td><a href='{$edit_link}'>{$associado->display_name}</a></td><td>{$associado->user_email}</td><td>{$usina}</td><td><a href='{$url}' target='_blank'>Abrir Pasta</a></td><td>{$ultimo_acesso}</td></tr>";
  }

  echo "</tbody></table></div>";
}