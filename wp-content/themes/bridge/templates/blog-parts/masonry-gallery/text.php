<div class="post_text">
    <div class="post_text_inner">
        <h5 itemprop="name" class="entry_title"><a itemprop="url" href="<?php the_permalink(); ?>" target="_self" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
        <div class="post_info">
            <?php if($blog_hide_author == 'no'){ ?>
            <?php esc_html_e('By','bridge'); ?> <?php the_author(); ?> /
            <?php } ?>
            <?php esc_html_e('in','bridge'); ?> <?php the_category(', '); ?>

            <?php /* if($blog_enable_social_share == "yes"){
                echo do_shortcode('[social_share_list]');
            } */ ?>
        </div>
    </div>
</div>