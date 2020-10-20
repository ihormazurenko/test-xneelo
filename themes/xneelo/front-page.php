<?php if (!defined('ABSPATH')) exit;
/**
 * Template Name: Front Page
 */
get_header(); ?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="course-wrap">

        <ul class="filter-list" id="course-filter">
            <li>
                <a href="#all" title="<?php esc_attr_e('All', 'xneelo'); ?>"><?php _e('All', 'xneelo'); ?></a>
            </li>
            <li class="active">
                <a href="#current" title="<?php esc_attr_e('Current', 'xneelo'); ?>"><?php _e('Current', 'xneelo'); ?></a>
            </li>
            <li>
                <a href="#pending" title="<?php esc_attr_e('Pending', 'xneelo'); ?>"><?php _e('Pending', 'xneelo'); ?></a>
            </li>
            <li>
                <a href="#completed" title="<?php esc_attr_e('Completed', 'xneelo'); ?>"><?php _e('Completed', 'xneelo'); ?></a>
            </li>
        </ul>

        <ul class="course-list" id="course-list">
            <?php
                $args = array(
                    'post_type'     => 'course',
                    'post_status'   => 'publish',
                    'posts_per_page'=> -1,
                    'orderby'       => 'date',
                    'order'         => 'DESC',
                );
                $course_query = new WP_Query( $args );

                if ( $course_query->have_posts() ) :
                    $i = 0;
                    while ( $course_query->have_posts() ) : $course_query->the_post();

                    $status = '';
                    $url        = get_the_permalink();
                    $title      = get_the_title();
                    $esc_title  = esc_attr(strip_tags($title));
                    $start_date = get_field('start_date');
                    $end_date   = get_field('end_date');

                    echo '<li data-status="'.$status.'">';
                        echo '<span class="start-month">'. date( "M", strtotime($start_date) ) .'</span>';

                        echo '<div class="course-heading">';
                            echo '<h2><a href="'. esc_url($url) .'" title="'. $esc_title .'">'. $title .'</a></h2>';

                            $categories = get_the_terms( $post->ID, 'course_category' );
                            if( is_array($categories) && count($categories) > 0 ){
                                echo '<div class="course-categories">';
                                $c = 0;
                                foreach( $categories as $cat ){
                                    if ($c !== 0) echo ', ';
                                    echo '<a href="'. get_term_link( $cat->term_id, $cat->taxonomy ) .'" title="'. esc_attr($cat->name) .'">'. $cat->name .'</a>';
                                    $c++;
                                }
                                echo '</div>';
                            }
                        echo '</div>';

                        if ($start_date) {
                            echo '<span class="start-date">'. date( get_option('date_format'), strtotime($start_date) ) .'</span>';
                        }

                        if ( has_post_thumbnail()) {
                            echo '<div class="thumbnail-box">
                                    <a href="'. esc_url($url) .'" title="'. $esc_title .'">'.
                                        get_the_post_thumbnail( $post->ID, 'medium_large' )
                                    .'</a>
                                </div>';
                        }

                        echo '<div class="course-excerpt">'. get_the_excerpt() .'</div>';
                    echo '</li>';

                    $i++;
                    endwhile;

                else:
                    echo "<p class='no-results'>".__('Sorry, no courses available.', 'xneelo')."</p>";
                endif;

                wp_reset_query();
            ?>

        </ul>
        
    </div>

<?php get_footer(); ?>