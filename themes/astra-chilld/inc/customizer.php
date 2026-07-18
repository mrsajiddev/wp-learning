<?php

function bs_theme_customizer($wp_customize)
{
    $wp_customize->add_section('bs_topbar_section', array(
        'title'    => 'Top Bar Settings',
        'priority' => 30,
    ));

    // Phone Number | Settings -> Create a value that WordPress should save.| Creates a storage location. Like creating a column in a database.


    $wp_customize->add_setting('bs_phone_number', array(
        'default' => '+1 777 123 4567',
        
    ));

    $wp_customize->add_control('bs_phone_number', array(
        'label'   => 'Phone Number',
        'section' => 'bs_topbar_section',
        'type'    => 'text',
    ));

    // Email
    $wp_customize->add_setting('bs_email_address', array(
        'default' => 'mail@domain.com',
    ));
//Control-> Creates the input field.
    $wp_customize->add_control('bs_email_address', array(
        'label'   => 'Email Address',
        'section' => 'bs_topbar_section',
        'type'    => 'email',
    ));
}

add_action('customize_register', 'bs_theme_customizer');