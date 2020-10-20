<?php if (!defined('ABSPATH')) exit;

    $url        = get_the_permalink();
    $title      = get_the_title();
    $esc_title  = esc_attr(strip_tags($title));
    $start_date = get_field('start_date');
?>

<li>
    <span class="start-month"><?php echo date( "M", strtotime($start_date) ); ?></span>

    <div class="course-heading">
        <h2><a href="<?php echo esc_url($url); ?>" title="<?php echo $esc_title; ?>"><?php echo $title; ?></a></h2>

        <?php
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
        ?>
    </div>

    <?php
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
    ?>

    <div class="course-excerpt"><?php the_excerpt(); ?></div>
</li>