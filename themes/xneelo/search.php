<?php if (!defined('ABSPATH')) exit;
    get_header();
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="archive-content">

        <?php if ( have_posts() ) : ?>

            <ul class="archive-list">

                <?php while ( have_posts() ) : the_post(); ?>

                    <?php get_template_part('templates/loop'); ?>

                <?php endwhile; ?>

            </ul>

        <?php else :
            echo "<p class='no-results'>".__('Sorry, nothing matched your search. Please try again.', 'xneelo')."</p>";
        endif; ?>

    </div>

<?php get_footer(); ?>