<div class="container">
    <div class="row" id="image-gallery">
        <?php
        $images = get_field('gallery_items');
        foreach ($images as $image) {
        ?>
            <div class="col-md-3">
                <a href="<?php echo $image['url']; ?>" data-lightbox="gallery" data-title="<?php echo $image['title']; ?>">
                    <img src="<?php echo $image['sizes']['medium']; ?>" data-src="<?php echo $image['sizes']['large']; ?>" class="lazyload" alt="<?php echo $image['alt']; ?>">
                </a>
            </div>
        <?php } ?>
    </div>
</div>