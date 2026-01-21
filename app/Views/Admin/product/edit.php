<?= $this->extend('Admin/theme/default') ?>

<?= $this->section('title') ?>
Edit Product
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="card card-bordered card-preview col-md-6 col-12">
                    <div class="card-inner">
                        <div class="card-head">
                            <h5 class="card-title">Edit Product</h5>
                        </div>
                        <?php if(session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="preview-block">
                            <form method="POST" action="<?= url_to('admin_product_edit',$product['id']) ?>" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="form-label">Main Image</label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" name="main_image" class="form-file-input" id="main_image" accept="image/*">
                                                <label class="form-file-label" for="main_image">Choose file</label>
                                            </div>
                                            <?php if (session('errors.main_image')) : ?>
                                                <span class="error text-danger">
                                                    <?= session('errors.main_image') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Product Gallery (Select multiple photos)</label>
                                        <div class="form-control-wrap">
                                            <div class="form-file">
                                                <input type="file" name="images[]" class="form-file-input" multiple accept="image/*" id="images">
                                                <label class="form-file-label" for="images">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">Name</label>
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control" id="name" placeholder="Enter Your Name" name="name" value="<?= old('name',$product['name'])?>">
                                            <?php if (session('errors.name')) : ?>
                                                <span class="error">
                                                    <?= session('errors.name') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">Price</label>
                                        <div class="form-control-wrap">
                                            <input type="number" name="price" step="0.01" class="form-control" placeholder="Enter Your Price" value="<?= old('price',$product['price'])?>">
                                            <?php if (session('errors.price')) : ?>
                                                <span class="error">
                                                    <?= session('errors.price') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Level 1 Commission</label>
                                        <div class="input-group">
                                            <input type="number" name="level_1_commission" step="0.01" class="form-control" placeholder="0.00" value="<?= old('level_1_commission',$product['level_1_commission'])?>">
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                        <?php if (session('errors.level_1_commission')) : ?>
                                            <span class="error">
                                                <?= session('errors.level_1_commission') ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Level 2 Commission</label>
                                        <div class="input-group">
                                            <input type="number" name="level_2_commission" step="0.01" class="form-control" placeholder="0.00" value="<?= old('level_2_commission',$product['level_2_commission'])?>">
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                        <?php if (session('errors.level_2_commission')) : ?>
                                            <span class="error">
                                                <?= session('errors.level_2_commission') ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Level 3 Commission</label>
                                        <div class="input-group">
                                            <input type="number" name="level_3_commission" step="0.01" class="form-control" placeholder="0.00" value="<?= old('level_3_commission',$product['level_3_commission'])?>">
                                            <div class="input-group-append"><span class="input-group-text">%</span></div>
                                        </div>
                                        <?php if (session('errors.level_3_commission')) : ?>
                                            <span class="error">
                                                <?= session('errors.level_3_commission') ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="name">Description</label>
                                        <div class="form-control-wrap">
                                            <textarea name="description" class="form-control"><?= old('description',$product['description']) ?></textarea>
                                            <?php if (session('errors.description')) : ?>
                                                <span class="error">
                                                    <?= session('errors.description') ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="status">Status</label>
                                        <div class="form-group">
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Active" name="status" class="custom-control-input" value="active" <?= old('status',$product['status']) == 'active' ? 'checked' : 'checked' ?>/>
                                                <label class="custom-control-label" for="Active">Active</label>
                                            </div>
                                            &nbsp;&nbsp;
                                            <div class="custom-control custom-radio">
                                                <input type="radio" id="Inactive" name="status" class="custom-control-input" value="inactive" <?= old('status',$product['status']) == 'inactive' ? 'checked' : '' ?>/>
                                                <label class="custom-control-label" for="Inactive">Inactive</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-lg btn-primary">
                                                Update
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>