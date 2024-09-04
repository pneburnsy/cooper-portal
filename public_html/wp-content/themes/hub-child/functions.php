<?php

add_action( 'wp_enqueue_scripts', 'liquid_child_theme_style', 99 );

function liquid_parent_theme_scripts() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
function liquid_child_theme_style(){
    wp_enqueue_style( 'child-hub-style', get_stylesheet_directory_uri() . '/style.css' );
}


// ------------------------------------------ User Management - Hide Fields ------------------------------------------
function remove_fields_wordpress() {
    echo '<style>tr.user-admin-color-wrap, tr.user-syntax-highlighting-wrap, tr.user-rich-editing-wrap, tr.user-admin-bar-front-wrap, tr.user-language-wrap, tr.user-comment-shortcuts-wrap, tr.user-url-wrap, .application-passwords, tr.user-description-wrap { display: none !important; }</style>';
}
add_action( 'admin_head-user-edit.php', 'remove_fields_wordpress' );
add_action( 'admin_head-profile.php',   'remove_fields_wordpress' );


// ------------------------------------------ Login Redirect ------------------------------------------
function admin_default_page() {
  return '/app/dashboard.php';
}
add_filter('login_redirect', 'admin_default_page');


// ------------------------------------------ Disable WP Backend ------------------------------------------
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
  if (!current_user_can('administrator') && !is_admin()) {
    show_admin_bar(false);
  }
}
add_filter( 'body_class', 'portal_current_user');
function portal_current_user( $classes ) {
    return array_merge( $classes, array( 'portal_' . get_current_user_id() ) );
}


// ------------------------------------------ User Fields ------------------------------------------
function custom_user_profile_fields($user){
    # Get current accounts active on site
    global $wpdb;
    $accounts_team_distinct = $wpdb->get_results("SELECT * FROM `ae_accounts` GROUP BY accountname");
    if (esc_attr(get_the_author_meta('account', $user->ID))) {
        $currentuser = esc_attr(get_the_author_meta('account', $user->ID));
        $accounts_team_view = $wpdb->get_results("SELECT * FROM `ae_accounts` WHERE displayid='$currentuser'");
    }
    # print_r($accounts_team_distinct);
    ?>
    <h3>User Information</h3>
    <table class="form-table">
        <tr>
            <th><label for="account">Clients Account</label></th>
            <td>
                <select name="account" class="form-control modal_input" data-trigger id="account">
                    <?php if (esc_attr(get_the_author_meta('account', $user->ID))) {
                        ?><option value="<?= esc_attr(get_the_author_meta('account', $user->ID)); ?>" selected>Current: <?= $accounts_team_view[0]->accountname ?></option><?php
                    } else {
                        ?><option value="" selected>Select Account...</option><?php
                    } ?>
                    <?php for ($i = 0; $i < count($accounts_team_distinct); $i++) {
                        ?><option value="<?= $accounts_team_distinct[$i]->displayid; ?>"><?= $accounts_team_distinct[$i]->accountname; ?></option><?php
                    } ?>
                </select>
            </td>
        </tr>
    </table>
    <?php
}
add_action( 'show_user_profile', 'custom_user_profile_fields' );
add_action( 'edit_user_profile', 'custom_user_profile_fields' );
add_action( "user_new_form", "custom_user_profile_fields" );
function save_custom_user_profile_fields($user_id){
    if(!current_user_can('manage_options')) {
        return false;
    }
    update_usermeta($user_id, 'account', $_POST['account']);
    update_user_meta($user_id, 'user_active', '1');
}
add_action('user_register', 'save_custom_user_profile_fields');
add_action('profile_update', 'save_custom_user_profile_fields');


// ------------------------------------------ Login Message ------------------------------------------
function portal_login_message() {
    echo '<style>.message a {color: #fff;}</style><span style="width: 88.5%;text-align: center;display: block;background-color: #df2323;color:#fff;border-radius: 4px;padding: 12px;margin: 0 auto 20px auto;">Welcome to the new Cooper Portal, please reset your password to gain access to your account.</span>';
}
add_action('login_message', 'portal_login_message');


// ------------------------------------------ Stop WP Admin Access ------------------------------------------
add_action( 'admin_init', 'restrict_wpadmin_access' );
if ( ! function_exists( 'restrict_wpadmin_access' ) ) {
    function restrict_wpadmin_access() {
        if ( wp_doing_ajax() || current_user_can( 'delete_posts' ) ) {
            return;
        } else {
            header( 'Refresh: 2; ' . esc_url( home_url() ) );
            $args = array(
            'back_link' => true,
            );
            wp_die( 'Restricted Access.', 'Error', $args );
        };
    };
};

// ------------------------------------------ Redirect to Portal ------------------------------------------
function home_redirect() {
    echo "<script> location.href='https://portal.cooperhandling.com/app/dashboard.php'; </script>";
    exit;
}
add_shortcode('home_redirect', 'home_redirect');

function load_ajax() {
    
} add_shortcode('load_ajax', 'load_ajax');




//function add_meta_to_all_users() {
//    $users = get_users();
//    foreach ($users as $user) {
//        $user_id = $user->ID;
//        if (get_user_meta($user_id, 'createdby', true) === '') {
//            update_user_meta($user_id, 'createdby', '5');
//        }
//
//    }
//}
//add_action('init', 'add_meta_to_all_users');