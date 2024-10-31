<?php

if (!function_exists('reescribirtextos_settings_page_html')) {
    function reescribirtextos_settings_page_html()
    {
?>
        <div class="wrap title_back">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

            <form action="options.php" method="post">
                <?php
                settings_fields('reescribirtextos');
                do_settings_sections('reescribirtextos');
                submit_button('Save Changes');
                ?>
            </form>
        </div>
    <?php
    }
}
/**
 * Add options page
 */
if (!function_exists('rect_options_page')) {
    function rect_options_page()
    {
        // This page will be under "Settings"
        add_menu_page(
            'Reescribir Textos Settings',
            'Reescribir Textos',
            'manage_options',
            'reescribirtextos',
            'reescribirtextos_settings_page_html',
            'dashicons-media-text',
            20
        );
    }
    add_action('admin_menu', 'rect_options_page');
}

if (!function_exists('rect_custom_box_html')) {
    function rect_custom_box_html($post)
    {

        echo do_shortcode('[reescribirtextos]');
    }
}

if (!function_exists('rect_settings_init')) {
    function rect_settings_init()
    {

        register_setting(
            'reescribirtextos',
            'rect_pin_option'
        );


        add_settings_section(
            'rect_section_pin_id',
            'API key',
            'rect_pin_section',
            'reescribirtextos'
        );

        add_settings_field(
            'rect_pin_id',
            'Enter Api Key',
            'rect_pin_field',
            'reescribirtextos',
            'rect_section_pin_id'
        );
    }
    add_action('admin_init', 'rect_settings_init');
}

if (!function_exists('rect_pin_section')) {
    function rect_pin_section()
    {
        echo "<p>Ingrese la clave API. Si no tiene ninguna clave o una clave no válida, haga clic  <a href='https://www.reescribirtextos.net/' target='_blank'>aquí</a> e inicie sesión/regístrese para obtener la clave.</p>";
    }
}

if (!function_exists('rect_pin_field')) {
    function rect_pin_field()
    {
        $rect_text = get_option('rect_pin_option');
        // output the field
    ?>
        <input type="text" name="rect_pin_option" value="<?php echo isset($rect_text) ? esc_attr($rect_text) : ''; ?>">
<?php
    }
}

?>