<form class="form-horizontal" id="adminForm">
    <div class="form-group">
        <label for="admin_first_name" class="control-label col-lg-4">First Name</label>
        <div class="col-lg-8">
            <input type="text" id="admin_first_name" name="admin_first_name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="admin_last_name" class="control-label col-lg-4">Last Name</label>
        <div class="col-lg-8">
            <input type="text" id="admin_last_name" name="admin_last_name" class="form-control">
        </div>
    </div>
    <div class="form-group">
        <label for="admin_email" class="control-label col-lg-4">Email</label>
        <div class="col-lg-8">
            <input type="text" id="admin_email" name="admin_email" class="form-control required2 email">
            <span></span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-lg-offset-4 col-lg-8">
            <div style="float: left;">
                <button type="button" class="btn btn-default" id="adminAddBtn">Submit</button>
            </div>
            <div style="float: left;padding-top: 4px">
                <span class="wait"></span>
            </div>
        </div>
    </div>

</form>