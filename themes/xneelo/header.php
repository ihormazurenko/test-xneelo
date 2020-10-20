<?php if (!defined('ABSPATH')) exit; ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <a class="skip-main" href="#main-content"><?php _e('Skip to main content', 'xneelo'); ?></a>

    <div class="wrapper">

        <?php get_sidebar(); ?>

        <section class="content-wrap" id="main-content">
