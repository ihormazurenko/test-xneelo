<?php if (!defined('ABSPATH')) exit;

    if ( is_archive() ) {
        $title = get_the_archive_title();
    } elseif ( is_search() ) {
        $title = sprintf( __( 'Search Results for &#8220;%s&#8221;', 'xneelo' ), get_search_query() );
    } else {
        $title = get_the_title();
    }
?>

<header class="page-header">
    <h1><?php echo $title; ?></h1>

    <div class="search-box">
        <form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ) ?>" >
            <label class="sr-only" for="s"><?php _e('Search', 'xneelo'); ?>: </label>
            <input type="search" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'xneelo'); ?>">
            <button type="submit" id="searchsubmit"><i class="fas fa-search"></i></button>
        </form>
    </div>
</header>