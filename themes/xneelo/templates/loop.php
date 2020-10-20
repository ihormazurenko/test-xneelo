<?php if (!defined('ABSPATH')) exit;

    $url        = get_the_permalink();
    $title      = get_the_title();
    $esc_title  = esc_attr(strip_tags($title));
?>

<li>
    <div class="image-box">
        <a href="<?php echo esc_url($url); ?>" title="<?php echo $esc_title; ?>"><?php
            if ( has_post_thumbnail()) {
                the_post_thumbnail( 'medium_large' );
            }
        ?></a>
    </div>

    <div class="content-box">
        <header>
            <h2><a href="<?php echo esc_url($url); ?>" title="<?php echo $esc_title; ?>"><?php echo $title; ?></a></h2>
        </header>

        <div class="excerpt"><?php the_excerpt(); ?></div>
    </div>
</li>