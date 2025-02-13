<?php
/**
 * Template Name: Home Template
 */

get_header(); // Include Astra header

$paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;
if (isset($_GET['paged'])) {
    $paged = absint($_GET['paged']);
}

// Define the custom query for Projects
$args = array(
    'post_type'      => 'project', // Custom post type
    'posts_per_page' => 6, // Number of projects per page
    'paged'          => $paged, // Ensure correct pagination
    'post_status'    => 'publish', // Show only published projects
    'tax_query'      => array(
        array(
            'taxonomy' => 'project_type', // Your custom taxonomy
            'field'    => 'slug', // You can use 'term_id' or 'slug'
            'terms'    => 'architecture', // The term you're filtering by
            'operator' => 'IN', // The operator to use, typically 'IN'
        ),
    ),
);

$project_query = new WP_Query($args);
?>

<div class="ast-container">
    <main class="site-main">
        <div class="ast-row">
            <div class="ast-main-content project-main-item row">
            <h2 class="mb-4 mt-2">
                Projects with Taxonomy "Architecture"
            </h2>
                <?php
                if ($project_query->have_posts()) :
                    while ($project_query->have_posts()) : $project_query->the_post();
                        ?>
                        <div class="project-item col-4 mb-4">
                            <h2 class="mt-2 mb-2"><a class="text-black" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="project-thumbnail">
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium'); ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    echo '<p>No projects found.</p>';
                endif;
                ?>
            </div>
            <!-- Simple Previous/Next Pagination -->
                    <div class="pagination d-flex justify-content-center">
                        <?php if ($paged > 1) : ?>
                            <div class="prev">
                                <a href="<?php echo esc_url(add_query_arg('paged', $paged - 1)); ?>">« Previous Projects</a>
                            </div>
                        <?php endif; ?>

                        <?php if ($paged < $project_query->max_num_pages) : ?>
                            <div class="next">
                                <a href="<?php echo esc_url(add_query_arg('paged', $paged + 1)); ?>">Next Projects »</a>
                            </div>
                        <?php endif; ?>
                    </div>
        </div>
    </main>
</div>
</div>
<div class="fs-5 container">
    <h2 class="mb-4 mt-4">
        Coffee image URL from API
    </h2>
    <?php
        echo hs_give_me_coffee();
    ?>
</div>
<h2 class="mb-4 mt-4 container">
    5 Random Kanye Quotes
</h2>
<div class="container" id="kanye-quotes"></div>

<?php get_footer(); // Include Astra footer ?>
