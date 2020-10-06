<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<link rel="stylesheet" href="<?= base_url('assets/vendor/intl-tel-input/build/css/intlTelInput.min.css'); ?>">

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1><br>
    <div class="row">
        <div class="col-lg">
            <?= form_open_multipart('accountexecutive/problemMapping/' . $customer['id_customer'], array('id' => 'addProblemMapping')); ?>

            <input type="hidden" name="id_karyawan" id="id_karyawan" value="<?php echo $user['id_user']; ?>">

            <div class="row">
                <div class="col-lg-4">
                    <?= session()->get('message'); ?>
                </div>
            </div>

            <div class="card text-left">
                <div class="card-header">
                    <!-- Nav Tabs -->
                    <ul class="nav nav-pills card-header-pills" role="tablist" id="myTab">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" role="tab" href="#updateCustomerProfile">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#updateCompanyProfile">Company Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#chiefInfo">Chief Info</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#financeAffairs">Finance Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#engineeringAffairs">Engineering Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#generalAffairs">General Affairs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" role="tab" href="#techSpecification">Technical Specification</a>
                        </li>
                    </ul>
                </div>
                <!-- End Nav Tabs -->

                <!-- Tab Panes -->
                <div class="card-body tab-content col-lg-9">

                    <!-- Tab Pane Customer's Profile -->
                    <div class="tab-pane active" id="updateCustomerProfile" name="updateCustomerProfile">
                        <h5 class="text-dark font-weight-light">Customer's Profile</h5><br>
                        <div class="form-group row">
                            <label for="cust-name" class="col-sm-2 col-form-label-sm">Customer</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="cust-name" id="cust-name" value="<?= $customer['name_customer']; ?>" readonly>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="cust-address" class="col-sm-2 col-form-label-sm">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm" name="cust-address" id="cust-address" cols="30" rows="4" placeholder="Address" value="<?= set_value('cust-address'); ?>"><?= $customer['address_customer']; ?></textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tariff" class="col-sm-2 col-form-label col-form-label-sm">Tarif *</label>
                            <div class="col-sm-3">
                                <select id="tariff" name="tariff" class="form-control custom-select-sm">
                                    <?php foreach ($tariff as $tarif) { ?>
                                        <option value="<?= $tarif['id_tariff'] ?>" <?php if ($customer['tariff'] == $tarif['tariff']) {
                                                                                        echo 'selected';
                                                                                    } ?>><?= $tarif['tariff'] ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="power" class="col-sm-2 col-form-label-sm">Daya</label>
                            <div class="col-sm-3">
                                <input type="number" class="form-control form-control-sm" name="power" id="power" value="<?= $customer['power']; ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="recommend-service" class="col-sm-2 col-form-label-sm">Service</label>
                            <div class="col-sm-3">
                                <select id="recommend-service" name="recommend-service" class="form-control custom-select-sm">
                                    <option></option>
                                    <?php foreach ($service as $s) { ?>
                                        <option value="<?= $s['id_type_of_service'] ?>" <?php if ($customer['type_of_service'] == $s['type_of_service']) {
                                                                                            echo 'selected';
                                                                                        } ?>><?= $s['type_of_service']; ?></option>
                                    <?php } ?>
                                </select>

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Company's Profile -->
                    <div class="tab-pane fade" id="updateCompanyProfile" name="updateCompanyProfile">
                        <h5 class="text-dark font-weight-light">Company's Profile</h5><br>
                        <div class="form-group row">
                            <label for="company-name" class="col-sm-2 col-form-label-sm">Company</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-name" id="company-name" placeholder="Company's Name" value="<?= set_value('company-name'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="address-company" class="col-sm-2 col-form-label-sm">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control form-control-sm" name="address-company" id="address-company" cols="30" rows="4" placeholder="Address Company" value="<?= set_value('address-company'); ?>"><?= set_value('address-company'); ?></textarea>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control form-control-sm" name="phone-company" id="phone" value="<?= set_value('phone-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="facsimile" class="col-sm-2 col-form-label-sm">Facsimile</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="facsimile" id="facsimile" value="<?= set_value('facsimile'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-company" id="email-company" value="<?= set_value('email-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="establishment" class="col-sm-2 col-form-label-sm">Establishment</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control form-control-sm" name="establishment" id="establishment" value="<?= set_value('establishment'); ?>">

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Chief Info -->
                    <div class="tab-pane fade" id="chiefInfo" name="chiefInfo">
                        <h5 class="text-dark font-weight-light">Chief of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-leader-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-leader-name" id="company-leader-name" placeholder="Leader's Name" value="<?= set_value('company-leader-name'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="leader-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="leader-position-company" id="leader-position-company" placeholder="Leader's Position" value="<?= set_value('leader-position-company'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-leader-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control form-control-sm" name="phone-leader-company" id="phone" value="<?= set_value('phone-leader-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-leader-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-leader-company" id="email-leader-company" value="<?= set_value('email-leader-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Finance Affairs -->
                    <div class="tab-pane fade" id="financeAffairs" name="financeAffairs">
                        <h5 class="text-dark font-weight-light">Finance of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-finance-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-finance-name" id="company-finance-name" placeholder="Finance's Name" value="<?= set_value('company-finance-name'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="finance-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="finance-position-company" id="finance-position-company" placeholder="Finance's Position" value="<?= set_value('finance-position-company'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-finance-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-finance-company" id="phone" value="<?= set_value('phone-finance-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-finance-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-finance-company" id="email-finance-company" value="<?= set_value('email-finance-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Engineering Affairs -->
                    <div class="tab-pane fade" id="engineeringAffairs" name="engineeringAffairs">
                        <h5 class="text-dark font-weight-light">Engineering of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-engineering-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-engineering-name" id="company-engineering-name" placeholder="Engineer's Name" value="<?= set_value('company-engineering-name'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="engineering-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input class="form-control form-control-sm" name="engineering-position-company" id="engineering-position-company" placeholder="Engineer's Position" value="<?= set_value('engineering-position-company'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-engineering-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-engineering-company" id="phone" value="<?= set_value('phone-engineering-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-engineering-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-engineering-company" id="email-engineering-company" value="<?= set_value('email-engineering-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane General Affairs -->
                    <div class="tab-pane fade" id="generalAffairs" name="generalAffairs">
                        <h5 class="text-dark font-weight-light">General Affairs of The Company</h5><br>
                        <div class="form-group row">
                            <label for="company-general-name" class="col-sm-2 col-form-label-sm">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="company-general-name" id="company-general-name" value="<?= set_value('company-general-name'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="general-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="general-position-company" id="general-position-company" value="<?= set_value('general-position-company'); ?>" required>

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone-general-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control form-control-sm" name="phone-general-company" id="phone" value="<?= set_value('phone-general-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email-general-company" class="col-sm-2 col-form-label-sm">Email</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control form-control-sm" name="email-general-company" id="email-general-company" value="<?= set_value('email-general-company'); ?>">

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <a class="btn btn-info btnNext text-white">Next</a>
                            </div>
                        </div>
                    </div>

                    <!-- Tab Pane Technical Specification -->
                    <div class="tab-pane fade" id="techSpecification" name="techSpecification">
                        <h5 class="text-dark font-weight-light">Technical Specification</h5><br>
                        <div class="form-group row">
                            <label for="captive-power" class="col-sm-2 col-form-label-sm">Captive Power</label>
                            <div class="col-sm-2">
                                <input type="number" class="form-control form-control-sm" name="captive-power" id="captive-power" value="<?= set_value('captive-power'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="amount-of-power" class="col-sm-2 col-form-label-sm">Amount of Power</label>
                            <div class="col-sm-3">
                                <input type="text" class="form-control form-control-sm" name="amount-of-power" id="amount-of-power" value="<?= set_value('amount-of-power'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="next-meeting" class="col-sm-2 col-form-label-sm">Next Meeting</label>
                            <div class="col-sm-3">
                                <input type="date" class="form-control form-control-sm" name="next-meeting" id="next-meeting" min="<?= date("Y-m-d"); ?>" max="<?= date("Y-m-d", strtotime('12/31')); ?>" value="<?= set_value('next-meeting'); ?>">

                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="suggestion" class="col-sm-2 col-form-label-sm">Suggestion</label>
                            <div class="col-sm-10">
                                <textarea type="text" class="form-control form-control-sm" name="suggestion" id="suggestion" cols="30" rows="4" value="<?= set_value('suggestion'); ?>"><?= set_value('suggestion'); ?></textarea>

                            </div>
                        </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-10">
                                <a class="btn btn-info btnPrevious text-white">Previous</a>
                                <button class="btn btn-primary" type="button" name="save" id="save" data-toggle="modal" data-target="#modalRejuvenateData">
                                    Save
                                    <i class="fas fa-save ml-1 text-white"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Tab Panes -->
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Central Modal Medium Info -->
<div class="modal fade" id="modalRejuvenateData" name="modalRejuvenateData" tabindex="-1" role="dialog" aria-labelledby="modalRejuvenateData" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header bg-gradient-primary">
                <h5 class="modal-title lead text-white" id="modalRejuvenateDataLabel" name="modalRejuvenateDataLabel">Add Rejuvenate Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <!--Body-->
            <div class="modal-body">
                <div class="text-center">
                    <i class="fas fa-question fa-4x mb-3 animated tada infinite" style="color:#007bff;"></i>
                    <p class="font-weight-bold text-dark">Are you sure you want to add the following data? If this is correct, click the save button.
                        If not, click the cancel button</p>
                </div>
            </div>

            <!--Footer-->
            <div class="modal-footer justify-content-center">
                <!-- <a type="button" class="btn btn-info text-white">Yes, sure. <i class="fas fa-save ml-1 text-white"></i></a>
                <a type="button" class="btn btn-outline-secondary" data-dismiss="modal">Not sure</a> -->
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary animated lightSpeedIn" id="confirm-submit-probing" name="confirm-submit-probing">Save data <i class="fas fa-save ml-1 text-white"></i></button>


            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<script type="text/javascript">
    $('.btnNext').click(function() {
        $('.nav-pills > .nav-item > .active').parent().next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function() {
        $('.nav-pills > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    });

    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        let numFiles = $("input:file")[0].files.length;

        if (numFiles > 1) {
            $(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(numFiles + " Files selected");
        } else if (numFiles == 1) {
            $(this).next('.custom-file-label').addClass("selected alert-info").removeClass("alert-danger").html(fileName);
        } else {
            $(this).next('.custom-file-label').addClass("selected alert-danger").html('No File Selected');
        }

    });
</script>

<!-- Intl Telephone Input -->
<script src="<?= base_url('assets/vendor/intl-tel-input/build/js/intlTelInput.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/intlTelInput_lpremium.js'); ?>"></script>

<!-- Tail Select JS -->
<script type="text/javascript" src="<?= base_url('assets/js/tail.select-full.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/tail_lpremium.js'); ?>"></script>

<?= $this->endSection(); ?>