<?php if (!defined('ABSPATH')) exit;
get_header(); ?>

    <div class="content content-style">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; else: endif; ?>

    </div>

<?php get_footer(); ?>