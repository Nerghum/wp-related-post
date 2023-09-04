function display_related_posts() {
    global $post;
    
    // Get the current post's categories
    $categories = wp_get_post_categories($post->ID);
    
    if ($categories) {
        // Query related posts based on the first category
        $related_query = new WP_Query(array(
            'category__in' => array($categories[0]),
            'post__not_in' => array($post->ID),
            'posts_per_page' => 3, // Number of related posts to display
            'orderby' => 'rand', // You can change the order if needed
        ));
        
        if ($related_query->have_posts()) {
            echo '<div class="related-posts">';
            echo '<h3>Related Posts</h3>';
            echo '<ul>';
            
            while ($related_query->have_posts()) {
                $related_query->the_post();
                echo '<li><a href="' . get_permalink() . '">' . get_the_title() . '</a></li>';
            }
            
            echo '</ul>';
            echo '</div>';
        }
        
        wp_reset_postdata();
    }
}

// use <?php display_related_posts(); ?> to show in single.php