<div>
    <div id="profile_picture" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel">Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h5 class="text-center">Upload Your New Profile Picture...</h5>
                    <p class="text-center">Max File Size 1MB. Allowed File Types: JPEG and JPG.</p>
                    <form method="post" class="dropzone" enctype='multipart/form-data'>
                        <div class="dz-message needsclick">
                            <div class="mb-3">
                                <i class="display-4 text-muted bx bx-cloud-upload"></i>
                            </div>
                            <h6>Drop your image below or click to upload.</h6>
                        </div>
                        <div class="fallback">
                            <input name="team_profilepicture" type="file">
                        </div>
                        <button type="submit" name="team_profilepictureupdate" value="<?php echo current_user_displayid(); ?>" class="btn btn-primary waves-effect waves-light document-upload-button">Update Profile</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary waves-effect" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
