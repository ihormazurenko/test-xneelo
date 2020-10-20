<?php if (!defined('ABSPATH')) exit;
    get_header();
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="course-wrap">

        <ul class="course-list">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

                <?php get_template_part('templates/loop', 'course'); ?>

            <?php endwhile; endif; ?>

        </ul>

    </div>

<?php get_footer(); ?>