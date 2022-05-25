<div class="container-fluid main-container">
    <div class="row">
        <!-- Filter Goes Here -->
        <div class="col-md-4 filter-container">
            <div class="filter-wrapper">
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
                                    <?php echo $term->name ?> (<?php echo $term->count ?>)
                                </label>

                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <button class="submit-btn" type="submit">Apply Filter</button>
                    <input type="hidden" name="action" value="myfilter">
                </form>
            </div>
        </div>
        <!-- Posts Goes HERE -->
        <div class="col-md-7 posts-container">
            
            <div id="response"></div>
        </div>
    </div>
</div>