<?php
// Filter Functions with Hooks
function orange_hr_bars()
{
    // Check if user have permission
    if (!current_user_can('edit_posts') || !current_user_can('edit_pages')) {
        return;
    }
    // Check if WYSIWYG is enabled
    if ('true' == get_user_option('rich_editing')) {
        add_filter('mce_external_plugins', 'custom_tinymce_plugin');
        add_filter('mce_buttons', 'register_mce_button');
    }
}
add_action('admin_head', 'orange_hr_bars');

// Function for new button
function custom_tinymce_plugin($plugin_array)
{
    $plugin_array['orange_hr_bars'] = get_template_directory_uri() . '/assets/js/tinymce_orange_hr.js';
    return $plugin_array;
}
// Register new button in the editor
function register_mce_button($buttons)
{
    array_push($buttons, 'orange_hr', 'orange_hr_wide');
    return $buttons;
}
