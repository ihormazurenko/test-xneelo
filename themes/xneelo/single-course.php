<?php if (!defined('ABSPATH')) exit;
    get_header();

    $start_date         = get_field('start_date');
    $end_date           = get_field('end_date');
    $days_of_classes    = get_field('days_of_classes');
    $skill_level        = get_field('skill_level');
    $price              = get_field('price');
    $teachers           = get_field('teachers');
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="content content-style">

        <h2><?php _e('Custom Fields:', 'xneelo'); ?></h2>
        <ul class="custom-field-list">
            <?php
            if ($start_date) {
                echo '<li>'. __('Start Date:', 'xneelo') .' <strong>'. $start_date .'</strong></li>';
            }
            if ($end_date) {
                echo '<li>'. __('End Date:', 'xneelo') .' <strong>'. $end_date .'</strong></li>';
            }
            if (is_array($days_of_classes) && count($days_of_classes) > 0) {
                echo '<li>'. __('Days of Classes:', 'xneelo') .' <strong>';
                $d = 0;
                foreach ($days_of_classes as $day) {
                    if ($d !== 0) echo ', ';
                    echo $day['label'];
                    $d++;
                }
                echo '</strong></li>';
            }
            if (is_array($skill_level) && $skill_level[0]) {
                echo '<li>'. __('Skill Level:', 'xneelo') .' <strong>'. $skill_level[0]['label'] .'</strong></li>';
            }
            if ($price) {
                echo '<li>'. __('Price:', 'xneelo') .' <strong>'. $price .'</strong></li>';
            }
            if ($teachers) {
                echo '<li>'. __('Teachers:', 'xneelo') .' <strong>'. $teachers .'</strong></li>';
            }
            ?>
        </ul>


        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

            <?php the_content(); ?>

        <?php endwhile; endif; ?>

    </div>

<?php get_footer(); ?><?php
