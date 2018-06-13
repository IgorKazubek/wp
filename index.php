	<?php get_header(); ?>

    <?php get_template_part( 'template-parts/header/gallery', 'search' ); ?>

    <?php get_sidebar()?>

    <div class="posts-container row">

        <div class="all_posts">

            <?php
                if(have_posts()){
                    while( have_posts() ) : the_post();
                        get_template_part( 'template-parts/posts/posts', 'show' );
                    endwhile;
                }

                if (  $wp_query->max_num_pages > 1 ) {
            ?>
            <script>
                var ajaxurl = '<?php echo site_url() ?>/wp-admin/admin-ajax.php';
                var true_posts = '<?php echo serialize($wp_query->query_vars); ?>';
                var current_page = <?php echo (get_query_var('paged')) ? get_query_var('paged') : 1; ?>;
                var max_pages = '<?php echo $wp_query->max_num_pages; ?>';
            </script>
    </div>

        <div class="pagination">
            <div id="loadPrev" class="pagination_button_prev" style="display:none">Previous</div>
            <div id="true_loadmore" class="pagination_button_next">Next</div>
        </div>

        <?php } ?>
    </div>
    <?php get_footer()?>

