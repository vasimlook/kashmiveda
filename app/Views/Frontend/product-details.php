<?= $this->extend('Frontend/theme/default') ?>

<?= $this->section('title') ?>
Product Details
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="card card-bordered">
                        <div class="card-inner">
                            <div class="row pb-5">
                                <div class="col-lg-6">
                                    <div class="product-gallery me-xl-1 me-xxl-5">
                                        <div class="slider-init" id="sliderFor" data-slick='{"arrows": false, "fade": true, "asNavFor":"#sliderNav", "slidesToShow": 1, "slidesToScroll": 1}'>
                                            <?php
                                            foreach($productImage as $key => $value)
                                            {
                                            ?>
                                                <div class="slider-item rounded">
                                                    <img src="<?= base_url('uploads/'.$value['image_path']) ?>" class="rounded w-100" alt="">
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div><!-- .slider-init -->
                                        <div class="slider-init slider-nav" id="sliderNav" data-slick='{"arrows": false, "slidesToShow": 5, "slidesToScroll": 1, "asNavFor":"#sliderFor", "centerMode":true, "focusOnSelect": true, 
                                                "responsive":[ {"breakpoint": 1539,"settings":{"slidesToShow": 4}}, {"breakpoint": 768,"settings":{"slidesToShow": 3}}, {"breakpoint": 420,"settings":{"slidesToShow": 2}} ]
                                            }'>
                                            <?php
                                            foreach($productImage as $key => $value)
                                            {
                                            ?>
                                                <div class="slider-item">
                                                    <div class="thumb">
                                                        <img src="<?= base_url('uploads/'.$value['image_path']) ?>" class="rounded" alt="">
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="product-info mt-5 me-xxl-5">
                                        <h4 class="product-price text-primary">₹<?= $product['price'] ?></h4>
                                        <h2 class="product-title"><?= $product['name'] ?></h2>
                                        <div class="product-meta">
                                            <ul class="d-flex flex-wrap ailgn-center g-2 pt-1">
                                                <li>
                                                    <button class="btn btn-primary">Buy Now</button>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-excrept text-soft">
                                            <p class="lead"><?= $product['description'] ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>