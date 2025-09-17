<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-12">
            <h1>Bridgeland Advisors - Debug Mode</h1>
            <p>If you can see this page, the theme is loading successfully.</p>

            <div class="alert alert-info">
                <h4>Theme Status: Active</h4>
                <ul>
                    <li>✅ PHP is working</li>
                    <li>✅ WordPress is connected</li>
                    <li>✅ Theme files are accessible</li>
                    <li>✅ Bootstrap CSS should be loading</li>
                </ul>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>Quick Navigation</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li><a href="<?php echo home_url('/about/'); ?>" class="btn btn-outline-primary btn-sm mb-2 d-block">About Page</a></li>
                                <li><a href="<?php echo home_url('/services/'); ?>" class="btn btn-outline-primary btn-sm mb-2 d-block">Services Page</a></li>
                                <li><a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-outline-primary btn-sm mb-2 d-block">Calculators</a></li>
                                <li><a href="<?php echo home_url('/contact/'); ?>" class="btn btn-outline-primary btn-sm mb-2 d-block">Contact Page</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5>Theme Information</h5>
                        </div>
                        <div class="card-body">
                            <p><strong>Theme:</strong> Bridgeland Advisors v2</p>
                            <p><strong>WordPress:</strong> <?php echo get_bloginfo('version'); ?></p>
                            <p><strong>PHP:</strong> <?php echo phpversion(); ?></p>
                            <p><strong>Theme Path:</strong> <?php echo get_template_directory(); ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <?php if (have_posts()) : ?>
                <div class="mt-4">
                    <h3>Recent Posts</h3>
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                                <p class="card-text"><?php the_excerpt(); ?></p>
                                <small class="text-muted"><?php the_date(); ?></small>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>