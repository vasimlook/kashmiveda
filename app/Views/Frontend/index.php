<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NAME ?></title>
    <link rel="shortcut icon" href="<?= base_url('assets/images/favicon.png') ?>">
    <link href="<?= base_url('frontend/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('frontend/css/customer.css') ?>" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="<?= url_to('home') ?>">MLM.</a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto fw-semibold">
                    <li class="nav-item"><a class="nav-link" href="#product">Product</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <section id="product" class="hero-gradient">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0 text-center text-lg-start">
                    <h1 class="display-3 fw-800 mb-4"><?= $product['name'] ?> <br><span style="color:var(--brand-accent)">Every
                            Detail.</span></h1>
                    <p class="lead text-secondary mb-5">Experience the world’s first carbon-fiber everyday tool. Built
                        for those who demand excellence without compromise.</p>
                    <div class="d-none d-lg-block">
                        <p class="small text-uppercase tracking-widest fw-bold text-muted">Trusted by 10k+ creators</p>
                    </div>
                </div>
                <div class="col-lg-6 text-center">
                    <img src="<?= base_url('uploads/' . $product['image']) ?>"
                        alt="Product" class="img-fluid rounded-5">
                </div>
            </div>
        </div>
    </section>

    <section id="about">
        <div class="container">
            <div class="about-box">
                <div class="about-circle"></div>
                <div class="row align-items-center position-relative">
                    <div class="col-lg-5 mb-4 mb-lg-0">
                        <img src="https://media.gettyimages.com/id/130199153/photo/anticipated-biography-of-steve-jobs-goes-on-sale.jpg?s=2048x2048&w=gi&k=20&c=m0rS3c-KzBazhOmCBJi3uyK4W5gzTWB0X2mk3qq0_dE="
                            class="img-fluid rounded-4 shadow" alt="Our Founder">
                    </div>
                    <div class="col-lg-7 ps-lg-5">
                        <h6 class="text-uppercase fw-bold mb-3"
                            style="color: var(--brand-accent); letter-spacing: 2px;">About Us</h6>
                        <h2 class="display-5 fw-bold mb-4">Crafting the Future.</h2>
                        <p class="lead opacity-75">Born in a small studio in 2024, Aurora was created to bridge the gap
                            between industrial strength and minimalist aesthetics.</p>
                        <p class="opacity-75">We don't believe in mass-market waste. Each product is numbered and
                            tracked to ensure the highest quality standards in the industry. Our mission is simple: One
                            product. Lifetime durability.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="bg-soft">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-5">
                    <h2 class="display-6 fw-bold mb-4">Let's Talk.</h2>
                    <p class="text-secondary mb-5">Have a question about your order or want to collaborate? Reach out
                        and our team will get back to you within 24 hours.</p>

                    <div class="d-flex mb-4">
                        <div class="fs-3 me-3 text-primary">📍</div>
                        <div>
                            <h6 class="fw-bold mb-0">Visit Us</h6>
                            <p class="text-muted">Design District, San Francisco, CA</p>
                        </div>
                    </div>
                    <div class="d-flex mb-4">
                        <div class="fs-3 me-3 text-primary">✉️</div>
                        <div>
                            <h6 class="fw-bold mb-0">Email Support</h6>
                            <p class="text-muted">hello@aurora-design.com</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-7">
                    <div class="contact-card bg-white">
                        <form id="contactForm">
                            <div class="mb-3">
                                <label class="small fw-bold text-uppercase mb-2">Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Your Name">
                                <div id="err_name" class="text-danger small mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-uppercase mb-2">Email</label>
                                <input type="email" name="email" class="form-control" placeholder="email@example.com">
                                <div id="err_email" class="text-danger small mt-1"></div>
                            </div>
                            <div class="mb-3">
                                <label class="small fw-bold text-uppercase mb-2">Message</label>
                                <textarea name="message" class="form-control" rows="5"
                                    placeholder="How can we help?"></textarea>
                                <div id="err_message" class="text-danger small mt-1"></div>
                            </div>
                            <div class="form-check mb-4 mt-2 text-start">
                                <input class="form-check-input" type="checkbox" id="agreeCheck" required>
                                <label class="form-check-label small text-muted" for="agreeCheck">
                                    I agree to the <a href="#" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
                                </label>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-brand w-100 py-3 mt-2">Send
                                Message</button>
                        </form>
                        <div id="successMsg" class="alert alert-success mt-3 d-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="py-5 text-center bg-white border-top mb-5 pb-5">
        <p class="text-muted small">&copy; <?= date('Y') ?> <?= APP_NAME ?>. All rights reserved.</p>
        <div class="small">
            <a href="#" class="text-secondary mx-2 text-decoration-none" data-bs-toggle="modal" data-bs-target="#privacyModal">Privacy Policy</a>
            <span class="text-muted">|</span>
            <a href="#" class="text-secondary mx-2 text-decoration-none" data-bs-toggle="modal" data-bs-target="#termsModal">Terms & Conditions</a>
        </div>
    </footer>

    <div class="purchase-bar">
        <div class="ps-2">
            <span class="fw-bold d-block">₹<?= number_format($product['price'], 2) ?></span>
            <span class="badge bg-light text-dark" style="font-size: 0.6rem;">FREE EXPRESS SHIPPING</span>
        </div>
        <a href="#contact" class="btn-brand">Buy Now</a>
    </div>

    <div class="modal fade" id="privacyModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold">Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <p class="text-muted small">Effective Date: January 1, 2026</p>
                    <h6 class="fw-bold mt-4">1. Information We Collect</h6>
                    <p>We collect information you provide directly to us through our contact forms, including your name and email address. We also collect device data and IP addresses automatically for security and analytics.</p>
                    
                    <h6 class="fw-bold mt-4">2. Use of Your Information</h6>
                    <p>We use your data to respond to inquiries, fulfill orders for the iPhone 17 Pro Max, and improve our website experience. We do not sell your personal data to third parties.</p>
                    
                    <h6 class="fw-bold mt-4">3. 3D & AR Experience</h6>
                    <p>Our AR features may request access to your camera. This access is only used locally on your device to project the 3D model; no video or images from your camera are stored or transmitted to our servers.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="termsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                <div class="modal-header border-0 px-4 pt-4">
                    <h5 class="modal-title fw-bold">Terms & Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4 pt-0">
                    <p class="text-muted small">Last Updated: January 1, 2026</p>
                    <h6 class="fw-bold mt-4">1. Use of Website</h6>
                    <p>By accessing AURORA, you agree to follow our rules. You may not use our 3D assets or branding for commercial purposes without explicit permission.</p>
                    
                    <h6 class="fw-bold mt-4">2. Product Pre-orders</h6>
                    <p>Filling out the contact form does not guarantee a reservation. Official pre-orders will be handled via verified email communication only.</p>
                    
                    <h6 class="fw-bold mt-4">3. Limitation of Liability</h6>
                    <p>We are not responsible for any inaccuracies in the 3D representation. The final iPhone 17 Pro Max hardware may vary slightly from this concept visualization.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="<?= base_url('frontend/js/bootstrap.bundle.min.js') ?>"></script>
    <script src="<?= base_url('frontend/js/jquery.min.js') ?>"></script>
</body>
<script>
    $('#contactForm').on('submit', function (e) {
        e.preventDefault();

        $('.text-danger').html('');
        $('#successMsg').addClass('d-none');
        let btn = $('#submitBtn');
        btn.html('Sending...').prop('disabled', true);

        $.ajax({
            url: '<?= url_to('contact_save') ?>',
            method: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function (res) {
                btn.html('Send Message').prop('disabled', false);
                $('#successMsg').removeClass('d-none').text(res.message);
                $('#contactForm')[0].reset();
            },
            error: function (xhr) {
                btn.html('Send Message').prop('disabled', false);
                if (xhr.status === 400) {
                    let errors = xhr.responseJSON.errors;
                    // Display specific errors under each field
                    if (errors.name) $('#err_name').text(errors.name);
                    if (errors.email) $('#err_email').text(errors.email);
                    if (errors.message) $('#err_message').text(errors.message);
                } else {
                    alert("Something went wrong. Please try again.");
                }
            }
    });
});
</script>

</html>