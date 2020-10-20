<aside class="sidebar">
    <div class="logo">
        <a href="<?php echo esc_url( home_url() ); ?>" title="<?php echo esc_attr( get_bloginfo('name') ); ?>">
            <?php
                if ( has_custom_logo() ) {
                    $logo = wp_get_attachment_image( get_theme_mod('custom_logo'), 'medium' );
                } else {
                    $logo = '<img src="' . get_template_directory_uri() . '/img/logo.png" alt="' . esc_attr( get_bloginfo('name') ) . '">';
                }

                echo $logo;
            ?>
        </a>
    </div>

    <a class="mobile-menu-toggle">
        <span></span>
    </a>

    <div class="mobile-menu-wrap">
        <?php
            if ( has_nav_menu('main-menu') ) {
                wp_nav_menu(array(
                    'theme_location'  => 'main-menu',
                    'menu'            => 'Main Menu',
                    'container'       => 'nav',
                    'container_class' => 'main-nav',
                    'container_id'    => false,
                    'items_wrap'      => '<ul>%3$s</ul>',
                    'depth'           => 1
                ));
            }
        ?>

        <ul class="account-list">
            <?php
                if ( is_user_logged_in() ) {
                    echo '<li>
                            <a href="' . esc_url( home_url('/wp-admin/profile.php') ) . '" title="' . esc_attr__('Account', 'xneelo') . '"><i class="far fa-user"></i> ' . __('Account', 'xneelo') . '</a>
                        </li>';

                    if ( current_user_can('administrator') ) {
                        echo '<li>
                            <a href="' . esc_url( home_url('/wp-admin/options-general.php') ) . '" title="' . esc_attr__('Settings', 'xneelo') . '"><i class="fas fa-cog"></i> ' . __('Settings', 'xneelo') . '</a>
                        </li>';
                    }

                } else {
                    echo '<li>
                            <a href="' . esc_url( home_url('/wp-login.php') ) . '" title="' . esc_attr__('Sign In', 'xneelo') . '"><i class="fas fa-sign-in-alt"></i> ' . __('Sign In', 'xneelo') . '</a>
                        </li>';
                }
            ?>
        </ul>
    </div>
</aside>