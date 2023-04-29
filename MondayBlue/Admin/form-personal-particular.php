<?php
require_once('Member/edit-member-form.php');
?>
<div>
    <!-- Personal Details -->
    <div class="card">
        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
            <h3>Personal Details</h3>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Salutation</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>First Name</label>
                        <?php
                            $full_name = (isset($full_name))? $full_name : '';
                            htmlInputType('text', 'full_name', 'Name', $full_name, 'form-control', '255')
                        ?>
                    </div>



                    <div class="form-group">
                        <label>Gender</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>IC</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Passport</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Nationality</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Marital Status</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Education Level</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label>Email Address</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>House Telephone Number</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label><i class="text-red mr-1">*</i>Mobile Number</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                    <div class="form-group">
                        <label>Residential Address</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Year Of Staying</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Residential Status</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mailing Address</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END OF Personal Details -->

    <!-- Employment Details -->
    <div class="card">
        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
            <h3>Employment Details</h3>
        </div>
        <div class="card-body collapse">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Working Period</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Name Of Employer</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Address Of Employer</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nature of Business</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Company Telephone Number</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF Employment Details -->

    <!-- Spouse Details -->
    <div class="card">
        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
            <h3>Spouse Details</h3>
        </div>
        <div class="card-body collapse">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name of Spouse</label>
                       <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Occupation</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Working Period</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name of Employer</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address Of Employer</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Nature Of Business</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Company Phone No.</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END OF Spouse Details -->

    <!-- Emergency Contact -->
    <div class="card">
        <div class="card-header" data-card-widget="collapse" style="cursor: pointer">
            <h3>Emergency Contact (Except Spouse)</h3>
        </div>
        <div  class="card-body collapse">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Relationship</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Mobile No</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" name="" id="" class="form-control">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END OF Emergency Contact -->
</div>

<script>


</script>