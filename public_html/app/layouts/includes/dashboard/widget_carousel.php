<?php
?>

<div class="col-xl-12 col-md-12">
    <div id="carouselExampleCaptions" class="carousel slide text-center widget-carousel" data-bs-ride="carousel">
        <div class="carousel-inner">

            <div class="carousel-item active" style="background-size:cover; background-image:url(/wp-content/uploads/2023/04/2.jpg);">
                <div class="text-center p-4" style="padding: 120px !important;">
                    <div class="avatar-md m-auto">
                        <span class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                            <i class="mdi mdi-face-agent"></i>
                        </span>
                    </div>
                    <h4 class="mt-3 lh-base fw-normal text-white">Welcome to the <b>Cooper Handling Portal.</b></h4>
                    <p class="text-white font-size-13" style="max-width: 400px;margin:20px auto;display:block;">Hi <?= current_user_fullname() ?>, Welcome to the Cooper Handling Portal, if you need any help or advice please don't hesitate getting in touch. Alternatively, visit the portals FAQ.</p>
                    <a href="page_faq.php" class="btn btn-light btn-sm">View FAQ's <i class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
            </div>

            <div class="carousel-item" style="background-size:cover; background-image:url(/wp-content/uploads/2023/04/1.jpg);">
                <div class="text-center p-4" style="padding: 120px !important;">
                    <div class="avatar-md m-auto">
                        <span class="avatar-title rounded-circle bg-light-subtle text-white font-size-24">
                            <i class="mdi mdi-magnify"></i>
                        </span>
                    </div>
                    <h4 class="mt-3 lh-base fw-normal text-white">The Perfect Equipment <b>For Every Application.</b></h4>
                    <p class="text-white font-size-13" style="max-width: 400px;margin:20px auto;display:block;">Unsure what is the right product for a new application? Use our product selector tool now and get a better understanding of what equipment could work for you.</p>
                    <a target="_blank" href="https://cooperhandling.com/product-selector/" class="btn btn-light btn-sm">Try Now! <i class="mdi mdi-arrow-right ms-1"></i></a>
                </div>
            </div>

        </div>
        <!-- end carousel-inner -->

        <div class="carousel-indicators carousel-indicators-rounded">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" aria-label="Slide 1" class="active" aria-current="true"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class=""></button>
        </div>
        <!-- end carousel-indicators -->
    </div>
</div>