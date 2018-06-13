<?php get_header();	?>
<div>
<!--    --><?php //get_template_part( 'template-parts/header/gallery', 'search' ); ?>
</div>

    <div class="post_content_container">
        <?php if(have_posts()){ while( have_posts() ) : the_post();
            $more = 1;
            if(!get_the_title()){?>
                <h2 class="post_title">No title</h2>
            <?php }?>
            <h2 class="post_title"><?php the_title()?></h2>
            <div class="post_date"><?php the_time('j.m.Y')?></div>

                <?php if(!get_the_content()){?>
                <h3 class="empty_content">There are not any content... yet...</h3>
                <?php }
                else { ?>
                   <div class="post_content"> <?php the_content();?></div>
                <?php
                }
                if(get_the_category()){ ?>
                    <p>Categories: <?php the_category(', '); ?></p>
                    <p><?php the_tags('Tags: ', ' > '); ?></p>
                <?php
                }
                ?>
        <?php
            comments_template();
        endwhile;
        }
        ?>

<?php get_footer()?>