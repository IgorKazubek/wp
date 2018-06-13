
<div class="single_post">
    <div class="picture">
        <?php

        if(!get_the_post_thumbnail()){?>
            <img src="<?php bloginfo('template_url') ?>/img/default_200x145.png">
            <?php
        }
        else{
            echo get_the_post_thumbnail();
        }
        ?>
    </div>
    <div class="post_text">
    <?php if(!get_the_content()){?>
        <div class="post_text_excerpt"><p><?php trim_title_words(3, '...');?></p></div>
        <a href="<?php the_permalink();?>"><div class="glyphicon glyphicon-search"></div></a>
        <?php
    }
    else{ ?>
        <div class="post_text_excerpt"><?php the_excerpt();?></div>
        <a href="<?php the_permalink();?>"><div class="glyphicon glyphicon-search"></div></a>
        <?php
    }
    ?>
    </div>

<!--    <span>--><?php //echo get_the_date()?><!--</span>-->
</div>