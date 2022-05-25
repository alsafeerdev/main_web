<?php// Ajax Post Filter

add_action('wp_ajax_myfilter', 'ajax_filter_function'); // wp_ajax_{ACTION HERE} 
add_action('wp_ajax_nopriv_myfilter', 'ajax_filter_function');

function ajax_filter_function()
{
    $args = array(
        'post_type' => 'services',
        'orderby' => 'date', // we will sort posts by date
        'order'    => $_POST['date'] // ASC or DESC
    );

    // for taxonomies / categories
    if (isset($_POST['prod-category'])  )
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'product_categories',
                'field' => 'id',
                'terms' => $_POST['prod-category']
            )
        );

    // if you want to use multiple checkboxed, just duplicate the above 5 lines for each checkbox

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            echo '<h2>' . $query->post->post_title . '</h2>';
        endwhile;
        wp_reset_postdata();
    else :
        echo 'No posts found';
    endif;

    die();
}
?>
<form action="<?php echo admin_url('admin-ajax.php') ?>" method="POST" id="filter">
    <?php
    if ($terms = get_terms(array(
        'taxonomy' => 'product_categories',
        'orderby' => 'name'
    ))) : ?>
        <div class="category-list">
            <?php foreach ($terms as $term) : ?>
                <label for="<?php echo $term->term_id ?>">
                    <input type="radio" name="prod-category" id="<?php echo $term->term_id ?>" value="<?php echo $term->term_id ?>">
                    <?php echo $term->name ?>
                </label>

            <?php endforeach; ?>
        </div>
    <?php endif; ?>
    <button class="submit-btn" type="submit">Apply Filter</button>
    <input type="hidden" name="action" value="myfilter">
</form>
<div id="response"></div>

<!-- Query -->

