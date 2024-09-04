<style>
    .inactive_account_inner {
        width: fit-content;
        height: fit-content;
        vertical-align: middle;
        display: grid;
        margin: auto;
    }
    .inactive_account h3 {
        text-align: center;
        margin: auto;
        width: 300px;
        font-size: 20px;
        line-height: 30px;
        font-family: sans-serif;
        margin-bottom: 10px;
    }
    .inactive_account p {
        text-align: center;
        margin: auto;
        width: 300px;
        font-size: 16px;
        line-height: 24px;
        font-family: sans-serif;
    }
    .inactive_account .image {
        width: 200px;
        margin: auto;
        display: block;
        text-align: center;
        margin-bottom: 30px;
    }
</style>

<div class="card card-top section-block-mb2 section-block-p0 mb-4">
    <div class="card-body ">
        <div class="row">
            <div class="col-sm-12">
                <div class="inactive_account">
                    <div class="inactive_account_inner">
                        <h4 style="margin-top:30px; margin-bottom:0;text-align:center">Records Not Found.</h4>
                        <div class='cooper_access_denied'><span>No records for this page have been found. This page doesn't exist or you aren't allowed to access it, sorry about that. If you believe this is a mistake please contact <?= $adminall ?>.</span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>