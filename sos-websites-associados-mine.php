<?php
/*
Plugin Name: SOS WEBSITES Associados Minde
Author: SOS WEBSITES
Author URI: https://soswebsites.com
Description: Plugin de criação de Área de Associados para afiliados da Minde Mineração, desenvolvido pela SOS WEBSITES para uso vitalício exclusivo neste website. Proibida sua utilização em sites de terceiros ou em novas versões do website não desenvolvidas pela SOS WEBSITES. NÃO DESATIVAR.
Version: 1.0.0
*/

defined('ABSPATH') or die('You do not have permission to access this file.');

require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/add-associados-role.php';

register_activation_hook(__FILE__, 'csc_on_plugin_activation');
function csc_on_plugin_activation() {
    csc_add_user_role_associado();
}
register_deactivation_hook(__FILE__, 'csc_on_plugin_deactivation');
function csc_on_plugin_deactivation() {
  csc_remove_user_role_associado();
}


require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/redirect-to-associados.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/custom-fields-for-associados.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/shortcode-associado-data.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/restrict-posts-visualization.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/admin-page.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/register-last-access-and-remove-toolbar.php';
require_once plugin_dir_path(__FILE__) . 'src/custom-role-associados/restric-associado-page.php';
require_once plugin_dir_path(__FILE__) . 'src/cpt-notices/add-cpt-notices-and-metas.php';
require_once plugin_dir_path(__FILE__) . 'src/emails-for-notices/send-emails-for-new-posts.php';
require_once plugin_dir_path(__FILE__) . 'src/cpt-notices/shortcode-to-show-notices.php';

?>