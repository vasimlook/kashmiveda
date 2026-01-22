<?= $this->extend('Frontend/theme/default') ?>

<?= $this->section('title') ?>
Home
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-block">
    <div class="card card-bordered card-preview">
        <div class="card-inner">
            <div class="py-2">
                <div
                    class="slider-init"
                    data-slick='{"arrows": false, "dots": true,"autoplay": true,"autoplaySpeed": 2000, "slidesToShow": 1, "slidesToScroll": 1, "infinite":false, "responsive":[ {"breakpoint": 992,"settings":{"slidesToShow": 2}}, {"breakpoint": 768,"settings":{"slidesToShow": 1}} ]}'
                >
                    <div class="col">
                        <img src="<?= base_url('assets/images/stock/a.jpg') ?>" class="card-img-top" alt="" style="height: 200px;" />
                    </div>
                    <div class="col">
                        <img src="<?= base_url('assets/images/stock/b.jpg') ?>" class="card-img-top" alt="" style="height: 200px;" />
                    </div>
                    <div class="col">
                        <img src="<?= base_url('assets/images/stock/c.jpg') ?>" class="card-img-top" alt="" style="height: 200px;" />
                    </div>
                    <div class="col">
                        <img src="<?= base_url('assets/images/stock/d.jpg') ?>" class="card-img-top" alt="" style="height: 200px;" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="nk-content nk-content-fluid">
    <div class="container-xl wide-xl">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block">
                    <div class="row g-gs">
                        <?php
                        foreach($product as $key => $value)
                        {
                        ?>
                            <div class="col-xxl-3 col-lg-4 col-sm-6">
                                <div class="card card-bordered product-card">
                                    <div class="product-thumb">
                                        <a href="<?= url_to('product_details',$value['uuid']) ?>">
                                            <img class="card-img-top" src="<?= base_url('uploads/' . $value['image']) ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="card-inner text-center">
                                        <h5 class="product-title"><a href="<?= url_to('product_details',$value['uuid']) ?>"><?= $value['name'] ?></a></h5>
                                        <div class="product-price text-primary h5">₹<?= $value['price'] ?></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>