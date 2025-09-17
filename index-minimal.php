<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php wp_title('|', true, 'right'); ?>Bridgeland Advisors</title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center text-primary mb-4">Bridgeland Advisors</h1>
            <div class="alert alert-success text-center">
                <h4>✅ THEME IS WORKING!</h4>
                <p>If you can see this message, the basic theme is loading correctly.</p>
            </div>

            <?php if (have_posts()) : ?>
                <?php while (have_posts()) : the_post(); ?>
                    <div class="card mb-4">
                        <div class="card-body">
                            <h2 class="card-title"><?php the_title(); ?></h2>
                            <div class="card-text"><?php the_content(); ?></div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="alert alert-info">
                    <h3>No content found</h3>
                    <p>Add some pages or posts to see content here.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>