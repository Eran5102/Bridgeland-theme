<?php get_header(); ?>

<div class="container" style="padding-top: 120px; min-height: 60vh;">
    <div class="row">
        <div class="col-12">
            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                        <header class="entry-header mb-3">
                            <h1 class="entry-title">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none text-primary">
                                    <?php the_title(); ?>
                                </a>
                            </h1>
                            <div class="entry-meta text-muted small">
                                <i class="fas fa-calendar-alt me-2"></i>
                                Posted on <?php echo get_the_date(); ?> by <?php the_author(); ?>
                            </div>
                        </header>

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div>
                    </article>
                <?php endwhile; ?>

                <?php
                // Pagination
                the_posts_pagination(array(
                    'prev_text' => '<i class="fas fa-chevron-left me-2"></i>' . __('Previous'),
                    'next_text' => __('Next') . '<i class="fas fa-chevron-right ms-2"></i>',
                    'class' => 'pagination justify-content-center',
                ));
                ?>

            <?php else : ?>
                <div class="text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-search fa-3x text-muted"></i>
                    </div>
                    <h2 class="mb-3">Nothing Found</h2>
                    <p class="lead mb-4">It looks like nothing was found at this location.</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="<?php echo home_url(); ?>" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Go Home
                        </a>
                        <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-secondary">
                            <i class="fas fa-envelope me-2"></i>Contact Us
                        </a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>