<?php get_header(); ?>

<article class="single-post">
    <?php while (have_posts()) : the_post(); ?>
        <!-- Hero Section -->
        <section class="post-hero py-5" style="background: linear-gradient(135deg, var(--color-maroon) 0%, var(--color-maroon-dark) 100%);">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center text-white">
                        <!-- Post Meta -->
                        <div class="post-meta mb-3">
                            <span class="badge bg-light text-dark me-2">
                                <?php
                                $categories = get_the_category();
                                if ($categories) {
                                    echo $categories[0]->name;
                                }
                                ?>
                            </span>
                            <small class="opacity-75">
                                <i class="fas fa-calendar me-1"></i><?php echo get_the_date(); ?>
                                <i class="fas fa-user ms-3 me-1"></i><?php the_author(); ?>
                                <?php if (get_post_meta(get_the_ID(), '_reading_time', true)) : ?>
                                    <i class="fas fa-clock ms-3 me-1"></i><?php echo get_post_meta(get_the_ID(), '_reading_time', true); ?> min read
                                <?php endif; ?>
                            </small>
                        </div>

                        <!-- Post Title -->
                        <h1 class="display-4 fw-bold mb-3"><?php the_title(); ?></h1>

                        <!-- Post Excerpt -->
                        <?php if (has_excerpt()) : ?>
                            <p class="lead opacity-90"><?php the_excerpt(); ?></p>
                        <?php endif; ?>

                        <!-- Related Services Tags -->
                        <?php if (get_post_meta(get_the_ID(), '_related_services', true)) : ?>
                            <div class="related-services mt-3">
                                <small class="opacity-75">Related Services: </small>
                                <?php
                                $services = explode(',', get_post_meta(get_the_ID(), '_related_services', true));
                                foreach ($services as $service) {
                                    echo '<span class="badge bg-light text-dark me-1">' . trim($service) . '</span>';
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="post-content py-5">
            <div class="container">
                <div class="row">
                    <!-- Article Content -->
                    <div class="col-lg-8">
                        <!-- Featured Image -->
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="featured-image mb-5">
                                <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow-sm')); ?>
                                <?php if (get_the_post_thumbnail_caption()) : ?>
                                    <figcaption class="mt-2 small text-muted text-center">
                                        <?php echo get_the_post_thumbnail_caption(); ?>
                                    </figcaption>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <!-- Article Body -->
                        <div class="article-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Post Tags -->
                        <?php if (has_tag()) : ?>
                            <div class="post-tags mt-5 pt-4 border-top">
                                <h6 class="text-primary mb-3">
                                    <i class="fas fa-tags me-2"></i>Topics
                                </h6>
                                <div class="tags-list">
                                    <?php
                                    $tags = get_the_tags();
                                    foreach ($tags as $tag) {
                                        echo '<a href="' . get_tag_link($tag->term_id) . '" class="badge bg-light text-dark me-2 mb-2 text-decoration-none">' . $tag->name . '</a>';
                                    }
                                    ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Social Sharing -->
                        <div class="social-sharing mt-5 pt-4 border-top">
                            <?php echo bridgeland_social_sharing_buttons(); ?>
                        </div>

                        <!-- Author Bio -->
                        <div class="author-bio mt-5 pt-4 border-top">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <div class="author-avatar">
                                        <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-circle')); ?>
                                    </div>
                                </div>
                                <div class="col">
                                    <h6 class="author-name mb-1"><?php the_author(); ?></h6>
                                    <p class="author-title small text-muted mb-2">Financial Advisor & Valuation Expert</p>
                                    <p class="author-description mb-0">
                                        <?php
                                        // Use custom bio if available, otherwise default
                                        $custom_bio = get_post_meta(get_the_ID(), '_author_bio_override', true);
                                        echo $custom_bio ?: (get_the_author_meta('description') ?: '15+ years of experience in investment banking, corporate law, and financial advisory services. Expert in 409A valuations and strategic financial planning.');
                                        ?>
                                    </p>
                                    <div class="author-social mt-2">
                                        <a href="https://www.linkedin.com/in/eranbenavi/" target="_blank" class="text-decoration-none me-3">
                                            <i class="fab fa-linkedin"></i> LinkedIn
                                        </a>
                                        <a href="mailto:eran@bridgeland-advisors.com" class="text-decoration-none">
                                            <i class="fas fa-envelope"></i> Email
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Related Posts -->
                        <?php
                        $related_posts = bridgeland_get_related_posts(get_the_ID(), 3);
                        if ($related_posts) : ?>
                            <section class="related-posts mt-5 pt-5 border-top">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-lightbulb me-2"></i>Related Insights
                                </h4>
                                <div class="row g-4">
                                    <?php foreach ($related_posts as $post) : setup_postdata($post); ?>
                                        <div class="col-md-4">
                                            <article class="card h-100 shadow-sm related-post-card">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="card-img-wrapper">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('card-optimized', array('class' => 'card-img-top')); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="card-body d-flex flex-column">
                                                    <h6 class="card-title">
                                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                            <?php echo wp_trim_words(get_the_title(), 8); ?>
                                                        </a>
                                                    </h6>
                                                    <p class="card-text small flex-grow-1"><?php echo bridgeland_custom_excerpt(15); ?></p>
                                                    <small class="text-muted">
                                                        <i class="fas fa-calendar me-1"></i><?php echo get_the_date('M j'); ?>
                                                    </small>
                                                </div>
                                            </article>
                                        </div>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                </div>
                            </section>
                        <?php endif; ?>

                        <!-- Content Recommendations -->
                        <?php
                        $recommendations = bridgeland_content_recommendations(get_the_ID(), 4);
                        if ($recommendations) : ?>
                            <section class="content-recommendations mt-5 pt-5 border-top">
                                <h4 class="text-primary mb-4">
                                    <i class="fas fa-thumbs-up me-2"></i>Recommended for You
                                </h4>
                                <div class="row g-3">
                                    <?php foreach ($recommendations as $post) : setup_postdata($post); ?>
                                        <div class="col-md-6">
                                            <div class="recommendation-item d-flex">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <div class="recommendation-thumb me-3">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php the_post_thumbnail('thumbnail-optimized', array('class' => 'img-fluid rounded', 'style' => 'width: 80px; height: 80px; object-fit: cover;')); ?>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="recommendation-content">
                                                    <h6 class="small mb-1">
                                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                                            <?php echo wp_trim_words(get_the_title(), 10); ?>
                                                        </a>
                                                    </h6>
                                                    <small class="text-muted">
                                                        <?php echo get_the_date('M j, Y'); ?>
                                                        <?php if (get_post_meta(get_the_ID(), '_post_views', true)) : ?>
                                                            • <?php echo get_post_meta(get_the_ID(), '_post_views', true); ?> views
                                                        <?php endif; ?>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; wp_reset_postdata(); ?>
                                </div>
                            </section>
                        <?php endif; ?>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-4">
                        <aside class="post-sidebar">
                            <!-- Table of Contents (if long article) -->
                            <div class="toc-widget card mb-4 sticky-top" style="top: 2rem;">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-list me-2"></i>In This Article
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div id="table-of-contents">
                                        <!-- Generated by JavaScript -->
                                        <p class="small text-muted">Loading table of contents...</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Quick Actions -->
                            <div class="quick-actions card mb-4">
                                <div class="card-header">
                                    <h6 class="mb-0">
                                        <i class="fas fa-bolt me-2"></i>Quick Actions
                                    </h6>
                                </div>
                                <div class="card-body">
                                    <div class="d-grid gap-2">
                                        <a href="<?php echo home_url('/calculators/'); ?>" class="btn btn-primary btn-sm">
                                            <i class="fas fa-calculator me-2"></i>Try Our Calculators
                                        </a>
                                        <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-comments me-2"></i>Get Expert Consultation
                                        </a>
                                        <button class="btn btn-outline-secondary btn-sm" onclick="window.print()">
                                            <i class="fas fa-print me-2"></i>Print Article
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <!-- Reading Progress -->
                            <div class="reading-progress card mb-4">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">Reading Progress</small>
                                        <small class="text-muted" id="progress-percent">0%</small>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        <div class="progress-bar bg-primary" id="reading-progress-bar" style="width: 0%;"></div>
                                    </div>
                                </div>
                            </div>

                            <!-- CTA Widget -->
                            <div class="cta-widget card bg-light mb-4">
                                <div class="card-body text-center">
                                    <h6 class="text-primary">Need Professional Valuation?</h6>
                                    <p class="small mb-3">Get expert 409A valuations and financial advisory services.</p>
                                    <a href="<?php echo home_url('/contact/'); ?>" class="btn btn-primary btn-sm">
                                        Get Started <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>
            </div>
        </section>

        <!-- Post Navigation -->
        <section class="post-navigation py-4 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <?php
                        $prev_post = get_previous_post();
                        if ($prev_post) : ?>
                            <a href="<?php echo get_permalink($prev_post->ID); ?>" class="text-decoration-none">
                                <div class="nav-post prev-post">
                                    <small class="text-muted">
                                        <i class="fas fa-chevron-left me-1"></i>Previous
                                    </small>
                                    <h6 class="small mb-0"><?php echo wp_trim_words($prev_post->post_title, 8); ?></h6>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                    <div class="col-6 text-end">
                        <?php
                        $next_post = get_next_post();
                        if ($next_post) : ?>
                            <a href="<?php echo get_permalink($next_post->ID); ?>" class="text-decoration-none">
                                <div class="nav-post next-post">
                                    <small class="text-muted">
                                        Next <i class="fas fa-chevron-right ms-1"></i>
                                    </small>
                                    <h6 class="small mb-0"><?php echo wp_trim_words($next_post->post_title, 8); ?></h6>
                                </div>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</article>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate Table of Contents
    generateTableOfContents();

    // Reading Progress Indicator
    updateReadingProgress();
    window.addEventListener('scroll', updateReadingProgress);

    function generateTableOfContents() {
        const headings = document.querySelectorAll('.article-content h2, .article-content h3, .article-content h4');
        const tocContainer = document.getElementById('table-of-contents');

        if (headings.length === 0) {
            tocContainer.innerHTML = '<p class="small text-muted">No headings found</p>';
            return;
        }

        let tocHTML = '<ul class="list-unstyled">';
        headings.forEach((heading, index) => {
            const id = `heading-${index}`;
            heading.id = id;

            const level = parseInt(heading.tagName.substring(1));
            const indent = level > 2 ? 'ms-3' : '';

            tocHTML += `<li class="${indent} mb-1">`;
            tocHTML += `<a href="#${id}" class="text-decoration-none small toc-link">${heading.textContent}</a>`;
            tocHTML += '</li>';
        });
        tocHTML += '</ul>';

        tocContainer.innerHTML = tocHTML;

        // Smooth scroll for TOC links
        document.querySelectorAll('.toc-link').forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });
    }

    function updateReadingProgress() {
        const article = document.querySelector('.article-content');
        if (!article) return;

        const articleTop = article.offsetTop;
        const articleHeight = article.offsetHeight;
        const windowHeight = window.innerHeight;
        const scrollTop = window.pageYOffset;

        const articleBottom = articleTop + articleHeight;
        const windowBottom = scrollTop + windowHeight;

        let progress = 0;
        if (scrollTop >= articleTop && scrollTop <= articleBottom) {
            progress = ((scrollTop - articleTop) / (articleHeight - windowHeight)) * 100;
            progress = Math.max(0, Math.min(100, progress));
        } else if (windowBottom >= articleBottom) {
            progress = 100;
        }

        const progressBar = document.getElementById('reading-progress-bar');
        const progressPercent = document.getElementById('progress-percent');

        if (progressBar && progressPercent) {
            progressBar.style.width = progress + '%';
            progressPercent.textContent = Math.round(progress) + '%';
        }
    }
});
</script>

<style>
.post-hero {
    position: relative;
    overflow: hidden;
}

.post-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.1);
    z-index: 1;
}

.post-hero .container {
    position: relative;
    z-index: 2;
}

.article-content {
    font-size: 1.1rem;
    line-height: 1.8;
}

.article-content h2,
.article-content h3,
.article-content h4 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    color: var(--color-maroon);
}

.article-content p {
    margin-bottom: 1.5rem;
}

.article-content blockquote {
    border-left: 4px solid var(--color-maroon);
    background: var(--color-gray-50);
    padding: 1rem 2rem;
    margin: 2rem 0;
    font-style: italic;
}

.related-post-card,
.recommendation-item {
    transition: transform 0.2s ease;
}

.related-post-card:hover {
    transform: translateY(-3px);
}

.toc-link {
    transition: color 0.2s ease;
}

.toc-link:hover {
    color: var(--color-maroon) !important;
}

.nav-post {
    padding: 1rem;
    border-radius: 0.5rem;
    transition: background-color 0.2s ease;
}

.nav-post:hover {
    background-color: rgba(139, 0, 0, 0.05);
}

.social-sharing .sharing-buttons a {
    transition: transform 0.2s ease;
}

.social-sharing .sharing-buttons a:hover {
    transform: scale(1.1);
}

@media (max-width: 768px) {
    .post-hero {
        padding: 3rem 0 !important;
    }

    .post-hero .display-4 {
        font-size: 2rem;
    }

    .article-content {
        font-size: 1rem;
    }
}
</style>

<?php get_footer(); ?>