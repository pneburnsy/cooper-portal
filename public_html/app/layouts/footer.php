            <!-- CONTINUED... -->
            </div>

        </div>
        <!-- END layout-wrapper -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>
        <script src="assets/libs/feather-icons/feather.min.js"></script>
        <!-- PACE JS -->
        <script src="assets/libs/pace-js/pace.min.js"></script>
        <!-- APEXCHARTS JS -->
        <script src="assets/libs/apexcharts/apexcharts.min.js"></script>
        <!-- PLUGINS JS-->
        <script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
        <script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
        <!-- DASHBOARD INIT JS -->
        <script src="assets/js/pages/dashboard.init.js"></script>
        <!-- CHOICES JS -->
        <script src="assets/libs/choices.js/public/assets/scripts/choices.min.js"></script>
        <!-- COLOR PICKER JS -->
        <script src="assets/libs/@simonwep/pickr/pickr.min.js"></script>
        <script src="assets/libs/@simonwep/pickr/pickr.es5.min.js"></script>
        <!-- DATATABLES JS -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
        <script src="https://cdn.datatables.net/fixedheader/3.2.1/js/dataTables.fixedHeader.js"></script>
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/pages/datatable_accounts.js"></script>
        <script src="assets/js/pages/datatable_contacts.js"></script>
        <script src="assets/js/pages/datatable_rentals.js"></script>
        <script src="assets/js/pages/datatable_renewals.js"></script>
        <script src="assets/js/pages/datatable_exam.js"></script>
        <script src="assets/js/pages/datatable_maintenance.js"></script>
        <script src="assets/js/pages/datatable_service.js"></script>
        <script src="assets/js/pages/datatable_service_hours.js"></script>
        <script src="assets/js/pages/datatable_survey.js"></script>
        <!-- FILE UPLOAD CSS -->
        <script src="assets/libs/dropzone/min/dropzone.min.js"></script>
        <!-- WIZARD CSS -->
        <script src="assets/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js"></script>
        <script src="assets/libs/twitter-bootstrap-wizard/prettify.js"></script>
        <!-- INIT JS -->
        <script src="assets/js/pages/form-advanced.init.js"></script>
        <!-- APP JS -->
        <script src="assets/js/app.js"></script>
        <!-- FEATHER ICONS JS -->
        <script>feather.replace()</script>

        <?php include 'layouts/message.php'; ?>

        <?php // MAINTENANCE MODE WARNING
        if ($maintenancemode && current_user_can('administrator')) {
            echo '<span style="left: 0;bottom: 0px;width: 100% !important;border-radius: 0px;z-index: 3000;position: fixed;display: block;background-color: rgba(253,98,94,1); color: #701917;padding: 10px;text-align: center;"><strong>Important: Maintenance Mode Is Currently Switched On - Only Admins can access the portal.</strong></span>';
        } ?>

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            <script>document.write(new Date().getFullYear())</script> © <?php echo $site_title; ?>. (App Version: v2.1.0) <a href="/app/page_report_bug">Report a Bug?</a>  |  Web App Bespokely Developed & Maintained by <a href="https://www.tlhmarketing.co.uk/" target="_blank" class="text-decoration-underline">TLH Marketing.</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (doif_tlh_admin()) { ?>
                <?php
                $value = safestring(current_user_account());
                $footer_role = get_users(array(
                    'meta_key' => 'account',
                    'meta_compare'  =>  '!==',
                    'meta_value' => $value,
                ));
                //print_r($footer_role);
                ?>
                <div class="debug_footer">
                    <span><strong>User:</strong> <?= current_user_displayid(); ?></span>
                    <span><strong>Account:</strong> <?= current_user_account(); ?></span>
                    <span><strong>Role:</strong> <?= ucfirst(str_replace("_"," ",$footer_role[0]->roles[0]));  ?></span>
                    <span><strong>Fleet Manager:</strong> <?php if(current_user_fleet_manager(current_user_displayid(),current_user_account())){ echo 'Yes'; } else { echo 'No'; } ?></span>
                </div>
            <?php } ?>
        </footer>

        <?php include 'layouts/functions/notifications.php'; ?>
            
    </body>

</html>
