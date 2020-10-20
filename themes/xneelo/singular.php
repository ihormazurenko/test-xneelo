<?php if (!defined('ABSPATH')) exit;
    get_header();
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="content content-style">

        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; endif; ?>

    </div>

<?php get_footer(); ?>