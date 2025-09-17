<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8">
            <div class="blog-header mb-5">
                <?php if (is_category()) : ?>
                    <h1 class="display-5 fw-bold text-primary">Category: <?php single_cat_title(); ?></h1>
                    <p class="lead"><?php echo category_description(); ?></p>
                <?php elseif (is_tag()) : ?>
                    <h1 class="display-5 fw-bold text-primary">Topic: <?php single_tag_title(); ?></h1>
                    <p class="lead"><?php echo tag_description(); ?></p>
                <?php elseif (is_author()) : ?>
                    <h1 class="display-5 fw-bold text-primary">Author: <?php echo get_the_author(); ?></h1>
                    <p class="lead"><?php echo get_the_author_meta('description'); ?></p>
                <?php elseif (is_date()) : ?>
                    <h1 class="display-5 fw-bold text-primary">Archive: <?php the_archive_title(); ?></h1>
                <?php else : ?>
                    <h1 class="display-5 fw-bold text-primary">Financial Insights & Resources</h1>
                    <p class="lead">Expert insights on valuation, finance, and business strategy from Bridgeland Advisors.</p>
                <?php endif; ?>

                <!-- Filter Options -->
                <div class="blog-filters mt-4">
                    <div class="row g-2 align-items-center">
                        <div class="col-md-6">
                            <div class="btn-group" role="group" aria-label="Content filters">
                                <a href="<?php echo get_post_type_archive_link('post'); ?>"
                                   class="btn <?php echo is_home() || is_category() || is_tag() ? 'btn-primary' : 'btn-outline-primary'; ?> btn-sm">
                                    Insights
                                </a>
                                <a href="<?php echo get_post_type_archive_link('financial_resource'); ?>"
                                   class="btn <?php echo is_post_type_archive('financial_resource') ? 'btn-primary' : 'btn-outline-primary'; ?> btn-sm">
                                    Resources
                                </a>
                                <a href="<?php echo get_post_type_archive_link('whitepaper'); ?>"
                                   class="btn <?php echo is_post_type_archive('whitepaper') ? 'btn-primary' : 'btn-outline-primary'; ?> btn-sm">
                                    White Papers
                                </a>
                                <a href="<?php echo get_post_type_archive_link('case_study'); ?>"
                                   class="btn <?php echo is_post_type_archive('case_study') ? 'btn-primary' : 'btn-outline-primary'; ?> btn-sm">
                                    Case Studies
                                </a>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <form class="d-flex" method="get" action="<?php echo home_url('/'); ?>">
                                <input class="form-control form-control-sm me-2" type="search" placeholder="Search insights..."
                                       name="s" value="<?php echo get_search_query(); ?>">
                                <button class="btn btn-outline-primary btn-sm" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Posts (if on main blog page) -->
            <?php if (is_home() && !is_paged()) :
                $featured_posts = get_posts(array(
                    'numberposts' => 2,
                    'meta_key' => '_featured_post',
                    'meta_value' => '1'
                ));
                if ($featured_posts) : ?>
                    <section class="featured-posts mb-5">
                        <h3 class="h4 mb-3 text-primary">
                            <i class="fas fa-star me-2"></i>Featured Insights
                        </h3>
                        <div class="row g-4">
                            <?php foreach ($featured_posts as $post) : setup_postdata($post); ?>
                                <div class="col-md-6">
                                    <article class="card h-100 shadow-sm featured-post-card">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="card-img-top-wrapper">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('card-optimized', array('class' => 'card-img-top')); ?>
                                                </a>
                                                <div class="featured-badge">
                                                    <i class="fas fa-star"></i> Featured
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column">
                                            <div class="post-meta mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i><?php echo get_the_date(); ?>
                                                    <?php if (get_post_meta(get_the_ID(), '_reading_time', true)) : ?>
                                                        <i class="fas fa-clock ms-3 me-1"></i><?php echo get_post_meta(get_the_ID(), '_reading_time', true); ?> min read
                                                    <?php endif; ?>
                                                </small>
                                            </div>
                                            <h4 class="card-title">
                                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h4>
                                            <p class="card-text flex-grow-1"><?php echo bridgeland_custom_excerpt(20); ?></p>
                                            <div class="post-categories mt-auto">
                                                <?php
                                                $categories = get_the_category();
                                                if ($categories) {
                                                    foreach (array_slice($categories, 0, 2) as $category) {
                                                        echo '<span class="badge bg-primary me-1">' . $category->name . '</span>';
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                            <?php endforeach; wp_reset_postdata(); ?>
                        </div>
                    </section>
                <?php endif;
            endif; ?>

            <!-- Regular Posts -->
            <section class="blog-posts">
                <?php if (have_posts()) : ?>
                    <div class="posts-grid">
                        <?php while (have_posts()) : the_post(); ?>
                            <article class="post-card card mb-4 shadow-sm">
                                <div class="row g-0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="col-md-4">
                                            <div class="post-thumbnail">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_post_thumbnail('card-optimized', array('class' => 'img-fluid rounded-start h-100 object-cover')); ?>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                    <?php else : ?>
                                        <div class="col-12">
                                    <?php endif; ?>
                                        <div class="card-body">
                                            <div class="post-meta mb-2">
                                                <small class="text-muted">
                                                    <i class="fas fa-calendar me-1"></i><?php echo get_the_date(); ?>
                                                    <i class="fas fa-user ms-3 me-1"></i><?php the_author(); ?>
                                                    <?php if (get_post_meta(get_the_ID(), '_reading_time', true)) : ?>
                                                        <i class="fas fa-clock ms-3 me-1"></i><?php echo get_post_meta(get_the_ID(), '_reading_time', true); ?> min read
                                                    <?php endif; ?>
                                                </small>
                                            </div>

                                            <h3 class="card-title h5">
                                                <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h3>

                                            <p class="card-text"><?php echo bridgeland_custom_excerpt(25); ?></p>

                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="post-categories">
                                                    <?php
                                                    $categories = get_the_category();
                                                    if ($categories) {
                                                        foreach (array_slice($categories, 0, 2) as $category) {
                                                            echo '<span class="badge bg-light text-dark me-1">' . $category->name . '</span>';
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                                <a href="<?php the_permalink(); ?>" class="btn btn-outline-primary btn-sm">
                                                    Read More <i class="fas fa-arrow-right ms-1"></i>
                                                </a>
                                            </div>

                                            <?php if (get_post_meta(get_the_ID(), '_related_services', true)) : ?>
                                                <div class="related-services mt-2">
                                                    <small class="text-muted">
                                                        <i class="fas fa-tags me-1"></i>
                                                        <?php echo get_post_meta(get_the_ID(), '_related_services', true); ?>
                                                    </small>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <nav aria-label="Blog pagination" class="mt-5">
                        <?php
                        echo paginate_links(array(
                            'prev_text' => '<i class="fas fa-chevron-left me-1"></i> Previous',
                            'next_text' => 'Next <i class="fas fa-chevron-right ms-1"></i>',
                            'class' => 'pagination justify-content-center'
                        ));
                        ?>
                    </nav>
                <?php else : ?>
                    <div class="no-posts text-center py-5">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <h3>No content found</h3>
                        <p class="text-muted">Try adjusting your search or browse our featured content below.</p>
                        <a href="<?php echo home_url('/'); ?>" class="btn btn-primary">
                            <i class="fas fa-home me-2"></i>Back to Homepage
                        </a>
                    </div>
                <?php endif; ?>
            </section>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="blog-sidebar">
                <!-- Newsletter Signup -->
                <div class="widget newsletter-widget card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">
                            <i class="fas fa-envelope me-2"></i>Financial Insights Newsletter
                        </h5>
                    </div>
                    <div class="card-body">
                        <p class="small">Get expert valuation insights and financial advisory tips delivered to your inbox.</p>
                        <form class="newsletter-form">
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your email address" required>
                            </div>
                            <button type="submit" class="btn btn-primary btn-sm w-100">
                                Subscribe <i class="fas fa-paper-plane ms-1"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Categories -->
                <div class="widget categories-widget card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-folder me-2"></i>Categories
                        </h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <?php
                            $categories = get_categories(array('hide_empty' => true));
                            foreach ($categories as $category) {
                                echo '<li class="mb-2">';
                                echo '<a href="' . get_category_link($category->term_id) . '" class="text-decoration-none d-flex justify-content-between">';
                                echo '<span>' . $category->name . '</span>';
                                echo '<span class="badge bg-light text-dark">' . $category->count . '</span>';
                                echo '</a>';
                                echo '</li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Popular Posts -->
                <div class="widget popular-posts-widget card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">
                            <i class="fas fa-fire me-2"></i>Popular Insights
                        </h5>
                    </div>
                    <div class="card-body">
                        <?php
                        $popular_posts = get_posts(array(
                            'numberposts' => 5,
                            'meta_key' => '_post_views',
                            'orderby' => 'meta_value_num',
                            'order' => 'DESC'
                        ));

                        if ($popular_posts) :
                            foreach ($popular_posts as $post) : setup_postdata($post); ?>
                                <div class="popular-post d-flex mb-3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="popular-post-thumb me-3">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php the_post_thumbnail('thumbnail-optimized', array('class' => 'img-fluid rounded', 'style' => 'width: 60px; height: 60px; object-fit: cover;')); ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                    <div class="popular-post-content">
                                        <h6 class="small mb-1">
                                            <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                <?php echo wp_trim_words(get_the_title(), 8); ?>
                                            </a>
                                        </h6>
                                        <small class="text-muted">
                                            <i class="fas fa-eye me-1"></i><?php echo get_post_meta(get_the_ID(), '_post_views', true) ?: '0'; ?> views
                                        </small>
                                    </div>
                                </div>
                            <?php endforeach; wp_reset_postdata();
                        endif; ?>
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="widget cta-widget card mb-4 bg-light">
                    <div class="card-body text-center">
                        <h5 class="text-primary">Need Expert Valuation Services?</h5>
                        <p class="small">Get professional 409A valuations and financial advisory services from experienced experts.</p>
                        <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary btn-sm">
                            <i class="fas fa-calculator me-2"></i>Get Quote
                        </a>
                        <a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-outline-primary btn-sm ms-2">
                            <i class="fas fa-tools me-2"></i>Try Calculators
                        </a>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</div>

<style>
.featured-post-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.featured-post-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}

.card-img-top-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 0.375rem 0.375rem 0 0;
}

.featured-badge {
    position: absolute;
    top: 10px;
    right: 10px;
    background: var(--color-maroon);
    color: white;
    padding: 5px 10px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 500;
}

.post-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.post-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
}

.object-cover {
    object-fit: cover;
}

.newsletter-form input:focus {
    border-color: var(--color-maroon);
    box-shadow: 0 0 0 0.2rem rgba(139, 0, 0, 0.25);
}

@media (max-width: 768px) {
    .post-card .row > div:first-child {
        max-height: 200px;
        overflow: hidden;
    }
}
</style>

<?php get_footer(); ?>