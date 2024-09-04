<?php session_start();

// LOAD WORDPRESS
require("../wp-load.php");

// SECURITY
include 'layouts/security.php';

// HEADER
$page = 'Email Marketing Tool';
include 'layouts/header.php';
include 'layouts/page_title.php';

// IMPORT QUERIES
doif_cooperonly(true);

?>

<?php /* ---------------- START - PAGE ---------------- */ ?>

<!-- Instiller Scripts -->
<script type="text/javascript">
    !function(i, n, s, t, l, e, r) {if(i.ieq)return;
        l=i.ieq=function(){l.handleCommand?l.handleCommand(arguments):l.queue.push(arguments)};
        if(!i._ieq){i._ieq=l;i._ieqDomain=t;}l.queue=[];e=n.createElement(s);e.async=1;e.src=t;
        r=n.getElementsByTagName(s)[0];r.parentNode.insertBefore(e,r)}
    (window,document,'script', 'https://a.trak.ee/js/1.0.0/engagement.min.js');
</script>
<script>
    ieq('init', 'IAT-62f27e32ec52a1-39580530');
    ieq('form-init', 'IFB-62f27e3840aa53-04162423', 'IFRAME');
</script>

<div class="row">

    <div class="col-xl-8 col-md-12">
        <div class="card card-top section-block-p0 mb-4">
            <div class="card-body faq-block" style="padding:0 !important;">
                <iframe referrerpolicy="no-referrer-when-downgrade" scrolling="no" loading="lazy" style="width: 100%; height: 1200px;" frameborder="0" src="https://api.trak.ee/engagement/form/iframe/IFB-62f27e3840aa53-04162423"></iframe>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-12">
        <div class="card card-top section-block-p0">
            <div class="card-header">
                <h4 class="card-title" style="color:#fff;">Your Templates</h4>
            </div>
            <div class="card-body faq-block">
                <label>Select a Category...</label>
                <select id="dropdown" class="form-control modal_input" data-trigger name="choices-single-default">
                    <option value="all">View All</option>
                    <option value="mantsinen">Mantsinen</option>
                    <option value="svetruck">Sve Truck</option>
                    <option value="movella">Movella</option>
                    <option value="tec">TEC Containers</option>
                    <option value="ram">RAM Spreaders</option>
                    <option value="telestack">Telestack</option>
                </select>
                <div class="team_member">
                    <a class="item email_block mantsinen" href="https://trim.ee/gCDTq" target="_blank" >Mantsinen Attachments</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/n3qJ3" target="_blank" >Mantsinen 60</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/k6ZG7" target="_blank" >Mantsinen 70</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/yTGFj" target="_blank" >Mantsinen 90</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/svR2O" target="_blank" >Mantsinen 95</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/rSSY3" target="_blank" >Mantsinen 120</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/j3Kk0" target="_blank" >Mantsinen 140</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/LNfDF" target="_blank" >Mantsinen 200</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/mOiPJ" target="_blank" >Mantsinen 300</a>
                    <a class="item email_block mantsinen" href="https://trim.ee/xs3Gb" target="_blank" >Mantsinen Semi-Automatic Operations</a>
                    <a class="item email_block sany" href="https://trim.ee/i6ubM" target="_blank" >SANY Material Handler</a>
                    <a class="item email_block sany" href="https://trim.ee/4roGG" target="_blank" >SANY Empty Container Handlers</a>
                    <a class="item email_block sany" href="https://trim.ee/pEsiO" target="_blank" >SANY Reachstacker</a>
                    <a class="item email_block sany" href="https://trim.ee/yw5Pk" target="_blank" >SANY H9 Hybrid Reachstacker</a>
                    <a class="item email_block svetruck" href="https://trim.ee/DIFA0" target="_blank" >Svetruck Heavy Duty Forklifts</a>
                    <a class="item email_block svetruck" href="https://trim.ee/keiQC" target="_blank" >Svetruck Log Handlers</a>
                    <a class="item email_block movella" href="https://trim.ee/2GJ1" target="_blank" >Movella Translifters</a>
                    <a class="item email_block tec ram" href="https://trim.ee/i2eVg" target="_blank" >Container Frames &amp; Spreaders</a>
                    <a class="item email_block telestack" href="https://trim.ee/y4rJH" target="_blank" >Telestack Mobile Port Equipment</a>
                    <a class="item email_block telestack" href="https://trim.ee/vpRSA" target="_blank" >Telestack LF520</a>
                    <a class="item email_block telestack" href="https://trim.ee/laYC7" target="_blank" >Telestack</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        const dropdown = document.getElementById('dropdown');
        const items = document.querySelectorAll('.item');
        dropdown.addEventListener('change', () => {
            const value = dropdown.value;
            items.forEach(item => {
                if (value === 'all') {
                    item.style.display = 'block';
                } else if (item.classList.contains(value)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    </script>

</div>

<?php /* ---------------- END - PAGE ---------------- */ ?>

<?php

// FOOTER
include 'layouts/footer.php';

?>
