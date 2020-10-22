<?php if (!defined('ABSPATH')) exit;
    get_header();
?>

    <?php get_template_part('templates/header', 'page'); ?>

    <div class="archive-content">

        <div id="react-news"></div>

    </div>

    <script type="text/javascript">
        var siteUrl = '<?php echo home_url('/'); ?>';
    </script>

<?php get_footer(); ?>