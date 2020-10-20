<?php if (!defined('ABSPATH')) exit;
/**
 * Template Name: Front Page
 */
get_header(); ?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="course-wrap">

        <?php
            $filterArr = [
                'all'       => __('All', 'xneelo'),
                'current'   => __('Current', 'xneelo'),
                'pending'   => __('Pending', 'xneelo'),
                'completed' => __('Completed', 'xneelo'),
            ];

            $statusTab = ($_GET && $_GET['status']) ? $_GET['status'] : 'all';

            if ( is_array($filterArr) && count($filterArr) > 0 ) {
                echo '<ul class="filter-list" id="course-filter">';

                    foreach ($filterArr as $key => $value) {
                        $tab_class = ( $statusTab == $key ) ? ' class="active"' : '';
                        echo '<li'. $tab_class .'><a href="#'. $key .'" title="'. esc_attr($value) .'">'. $value .'</a></li>';
                    }

                echo '</ul>';
            }
        ?>

        <ul class="course-list" id="course-list">
            <?php
                $args = array(
                    'post_type'     => 'course',
                    'post_status'   => 'publish',
                    'posts_per_page'=> -1,
                    /* I saw the item about just the last 3 courses,
                        but I decided to display all of them in one list,
                        since I've implemented a dynamic determination of the course status
                        based on the start and end date, and not a custom field for that. */
                    'orderby'       => 'date',
                    'order'         => 'DESC',
                );
                $course_query = new WP_Query( $args );

                if ( $course_query->have_posts() ) :
                    $i = 0;
                    $currentDate = strtotime( date(get_option('date_format')) );

                    while ( $course_query->have_posts() ) : $course_query->the_post();

                    $url        = get_the_permalink();
                    $title      = get_the_title();
                    $esc_title  = esc_attr(strip_tags($title));
                    $start_date = get_field('start_date');
                    $end_date   = get_field('end_date');
                    $start_date_U   = strtotime($start_date);
                    $end_date_U     = strtotime($end_date);

                    $status     = '';
                    if ( $start_date_U < $end_date_U ) {
                        if ( $end_date_U >= $currentDate ) {

                            if ( $start_date_U > $currentDate ) {
                                $status = 'pending';
                            } else {
                                $status = 'current';
                            }

                        } else {
                            $status = 'completed';
                        }
                    }

                    $course_class = ( $statusTab == 'all' || $statusTab == $status ) ? 'show' : '';

                    echo '<li data-status="all '.$status.'" class="'.$course_class.'">';
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