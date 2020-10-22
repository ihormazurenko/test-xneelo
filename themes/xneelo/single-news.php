<?php if (!defined('ABSPATH')) exit;
    get_header();
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="content content-style">

        <?php
            $city = get_field('city');
            $custom_field = get_field('custom_field');
            $gallery = get_field('gallery');

            if ($city || $custom_field || $gallery) {

                echo '<ul class="custom-field-list">';

                    if ( trim($city) ) {
                        echo '<li>'.__('City:', 'xneelo').' <strong>'.$city.'</strong></li>';
                    }

                    if ( trim($custom_field) ) {
                        echo '<li>'.__('Another Custom Field:', 'xneelo').' <strong>'.$custom_field.'</strong></li>';
                    }

                    if ( is_array($gallery) && count($gallery) > 0 ) {
                        echo '<li>'.__('Gallery:', 'xneelo').' <ul class="custom-gallery">';
                                foreach ($gallery as $img) {
                                    $imgUrl = $img['sizes']['medium'] ? $img['sizes']['medium'] : $img['url'];
                                    echo '<li><div class="img-box"><img src="'.esc_url($imgUrl).'" alt="'.esc_attr($img['alt']).'"></div></li>';
                                }
                        echo '</ul></li>';
                    }

                echo '</ul>';

            }
        ?>

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; endif; ?>

    </div>

<?php get_footer(); ?>