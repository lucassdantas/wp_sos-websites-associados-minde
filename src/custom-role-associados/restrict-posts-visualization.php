<?php 

defined('ABSPATH') or die();

// Restringir visualização de posts exclusivos
function csc_restrict_exclusive_posts($query) {
  if (is_admin() || !$query->is_main_query()) {
      return;
  }
  if (is_category('exclusivo') && !current_user_can('administrator') && !current_user_can('editor') && !current_user_can('associado')) {
      wp_redirect(home_url());
      exit;
  }
}
add_action('pre_get_posts', 'csc_restrict_exclusive_posts');