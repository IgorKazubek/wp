
<?php
    /* Template Name: ContactUsPage */

    get_header();
?>

<div>
    <?php if(have_posts()): while( have_posts() ) : the_post();
        $more = 1;
        the_content();
    endwhile; ?>
    <?php endif;?>
</div>

<?php get_footer()?>