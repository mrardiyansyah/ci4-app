<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Intl Tel Input -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/css/intlTelInput.css" integrity="sha512-gxWow8Mo6q6pLa1XH/CcH8JyiSDEtiwJV78E+D+QP0EVasFs8wKXq16G8CLD4CJ2SnonHr4Lm/yY2fSI2+cbmw==" crossorigin="anonymous" />

<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 text-gray-800"><?= $title; ?></h1><br>
    <div class="row">
        <div class="col-lg">

            <div class="row">
                <div class="col-lg-4">
                    <?= session()->get('message'); ?>
                </div>
            </div>

            <div class="card ">
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

                <form action="<?= base_url('account-executive/rejuvenate/' . $customer['id_customer']); ?>" method="post" id="form-rejuvenate">
                    <?= csrf_field(); ?>
                    <!-- Tab Panes -->
                    <div class="card-body tab-content col-lg-12">
                        <!-- Tab Pane Customer's Profile -->
                        <div class="tab-pane active" id="updateCustomerProfile" name="updateCustomerProfile">
                            <h5 class="text-dark text-center">Customer's Profile</h5><br>
                            <div class="form-group row">
                                <label for="cust-name" class="col-sm-2 col-form-label-sm">Customer</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm" name="cust-name" id="cust-name" value="<?= $customer['name_customer']; ?>" readonly>

                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="cust-address" class="col-sm-2 col-form-label-sm">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('address_customer') ? 'is-invalid' : ''; ?>" name="cust-address" id="cust-address" cols="30" rows="4" placeholder="Address" value="<?= set_value('cust-address'); ?>"><?= $customer['address_customer']; ?></textarea>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('address_customer'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="tariff" class="col-sm-2 col-form-label col-form-label-sm">Tarif *</label>
                                <div class="col-sm-3">
                                    <select id="tariff" name="tariff" class="form-control custom-select-sm <?php if (isset($validation)) echo $validation->hasError('tariff') ? 'is-invalid' : ''; ?>">
                                        <?php foreach ($tariff as $tarif) { ?>
                                            <option value="<?= $tarif['id_tariff'] ?>" <?= set_select('tariff', $tarif['id_tariff']); ?> <?= ($customer['tariff'] == $tarif['tariff']) ? 'selected' : ''; ?>><?= $tarif['tariff'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('tariff'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="power" class="col-sm-2 col-form-label-sm">Daya</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('power') ? 'is-invalid' : ''; ?>" id="power" name="power" value="<?= $customer['power']; ?>" name="power" id="power" value="<?= $customer['power']; ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('power'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="recommend-service" class="col-sm-2 col-form-label-sm">Service</label>
                                <div class="col-sm-3">
                                    <select id="recommend-service" name="recommend-service" class="form-control custom-select-sm <?php if (isset($validation)) echo $validation->hasError('recommend-service') ? 'is-invalid' : ''; ?>">
                                        <option></option>
                                        <?php foreach ($service as $s) { ?>
                                            <option value="<?= $s['id_type_of_service'] ?>" <?= ($customer['type_of_service'] == $s['type_of_service']) ? 'selected' : ''; ?> <?= set_select('recommend-service', $s['id_type_of_service']); ?>><?= $s['type_of_service'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('recommend-service'); ?>
                                        </div>
                                    <?php endif; ?>
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
                            <h5 class="text-dark text-center">Company's Profile</h5><br>
                            <div class="form-group row">
                                <label for="company-name" class="col-sm-2 col-form-label-sm">Company</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('company-name') ? 'is-invalid' : ''; ?>" name="company-name" id="company-name" placeholder="Company's Name" value="<?= set_value('company-name'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('company-name'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address-company" class="col-sm-2 col-form-label-sm">Address</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('address-company') ? 'is-invalid' : ''; ?>" name="address-company" id="address-company" cols="30" rows="4" placeholder="Address Company" value="<?= set_value('address-company'); ?>"><?= set_value('address-company'); ?></textarea>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('address-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                                <div class="col-sm phone">
                                    <input type="tel" class="form-control form-control-sm phone_flag <?php if (isset($validation)) echo $validation->hasError('phone-company.full') ? 'is-invalid' : ''; ?> " name="phone-company[main]" value="<?= set_value('phone-company[main]'); ?>">
                                    <span class="valid-msg hide">✓ Valid</span>
                                    <span class="error-msg hide"></span>
                                    <?php if (isset($validation)) : ?>
                                        <div class="error-msg pt-1" style="font-size: 80%;">
                                            <?= $validation->getError('phone-company.full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="facsimile" class="col-sm-2 col-form-label-sm">Facsimile</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('facsimile') ? 'is-invalid' : ''; ?>" name="facsimile" id="facsimile" value="<?= set_value('facsimile'); ?>" placeholder="Facsimile">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('facsimile'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-company" class="col-sm-2 col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('email-company') ? 'is-invalid' : ''; ?>" name="email-company" id="email-company" value="<?= set_value('email-company'); ?>" placeholder="Company's Email">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="establishment" class="col-sm-2 col-form-label-sm">Establishment</label>
                                <div class="col-sm-4">
                                    <div class="input-group date" id="datetimepicker-establishment" data-target-input="nearest">
                                        <input type="text" class="form-control form-control-sm datepicker datetimepicker-input <?php if (isset($validation)) echo $validation->hasError('establishment') ? 'is-invalid' : ''; ?>" data-toggle="datetimepicker" data-target="#datetimepicker-establishment" name="establishment" id="establishment" value="<?= set_value('establishment'); ?>" placeholder="DD-MM-YYYY" />
                                        <div class="input-group-append" data-target="#datetimepicker-establishment" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fas fa-calendar"></i></div>
                                        </div>
                                        <?php if (isset($validation)) : ?>
                                            <div class="invalid-feedback">
                                                <?= $validation->getError('establishment'); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
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
                            <h5 class="text-dark text-center">Chief of The Company</h5><br>
                            <div class="form-group row">
                                <label for="company-leader-name" class="col-sm-2 col-form-label-sm">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('company-leader-name') ? 'is-invalid' : ''; ?>" name="company-leader-name" id="company-leader-name" placeholder="Leader's Name" value="<?= set_value('company-leader-name'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('company-leader-name'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="leader-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('leader-position-company') ? 'is-invalid' : ''; ?>" name="leader-position-company" id="leader-position-company" placeholder="Leader's Position" value="<?= set_value('leader-position-company'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('leader-position-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone-leader-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                                <div class="col-sm-10 phone">
                                    <input type="tel" class="form-control form-control-sm phone_flag <?php if (isset($validation)) echo $validation->hasError('phone-leader-company.full') ? 'is-invalid' : ''; ?>" name="phone-leader-company[main]" value="<?= set_value('phone-leader-company[main]'); ?>">
                                    <span class="valid-msg hide">✓ Valid</span>
                                    <span class="error-msg hide"></span>
                                    <?php if (isset($validation)) : ?>
                                        <div class="error-msg pt-1" style="font-size: 80%;">
                                            <?= $validation->getError('phone-leader-company.full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-leader-company" class="col-sm-2 col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('email-leader-company') ? 'is-invalid' : ''; ?>" name="email-leader-company" id="email-leader-company" value="<?= set_value('email-leader-company'); ?>" placeholder="Leader's Email">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email-leader-company'); ?>
                                        </div>
                                    <?php endif; ?>
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
                            <h5 class="text-dark text-center">Finance of The Company<br><small class="text-secondary">(Optional)</small></h5>
                            <br>
                            <div class="form-group row">
                                <label for="company-finance-name" class="col-sm-2 col-form-label-sm">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('company-finance-name') ? 'is-invalid' : ''; ?>" name="company-finance-name" id="company-finance-name" placeholder="Finance's Name" value="<?= set_value('company-finance-name'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('company-finance-name'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="finance-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('finance-position-company') ? 'is-invalid' : ''; ?>" name="finance-position-company" id="finance-position-company" placeholder="Finance's Position" value="<?= set_value('finance-position-company'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('finance-position-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone-finance-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                                <div class="col-sm-10 phone">
                                    <input type="tel" class="form-control form-control-sm phone_flag <?php if (isset($validation)) echo $validation->hasError('phone-finance-company.full') ? 'is-invalid' : ''; ?>" name="phone-finance-company[main]" value="<?= set_value('phone-finance-company[main]'); ?>">
                                    <span class="valid-msg hide">✓ Valid</span>
                                    <span class="error-msg hide"></span>
                                    <?php if (isset($validation)) : ?>
                                        <div class="error-msg pt-1" style="font-size: 80%;">
                                            <?= $validation->getError('phone-finance-company.full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-finance-company" class="col-sm-2 col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('email-finance-company') ? 'is-invalid' : ''; ?>" name="email-finance-company" id="email-finance-company" value="<?= set_value('email-finance-company'); ?>" placeholder="Finance's Email">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email-finance-company'); ?>
                                        </div>
                                    <?php endif; ?>
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
                            <h5 class="text-dark text-center">Engineering of The Company<br><small class="text-secondary">(Optional)</small></h5><br>
                            <div class="form-group row">
                                <label for="company-engineering-name" class="col-sm-2 col-form-label-sm">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('company-engineering-name') ? 'is-invalid' : ''; ?>" name="company-engineering-name" id="company-engineering-name" placeholder="Engineer's Name" value="<?= set_value('company-engineering-name'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('company-engineering-name'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="engineering-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                                <div class="col-sm-10">
                                    <input class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('engineering-position-company') ? 'is-invalid' : ''; ?>" name="engineering-position-company" id="engineering-position-company" placeholder="Engineer's Position" value="<?= set_value('engineering-position-company'); ?>">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('engineering-position-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone-engineering-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                                <div class="col-sm-10 phone">
                                    <input type="tel" class="form-control form-control-sm phone_flag <?php if (isset($validation)) echo $validation->hasError('phone-engineering-company.full') ? 'is-invalid' : ''; ?>" name="phone-engineering-company[main]" value="<?= set_value('phone-engineering-company[main]'); ?>">
                                    <span class="valid-msg hide">✓ Valid</span>
                                    <span class="error-msg hide"></span>
                                    <?php if (isset($validation)) : ?>
                                        <div class="error-msg pt-1" style="font-size: 80%;">
                                            <?= $validation->getError('phone-engineering-company.full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-engineering-company" class="col-sm-2 col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('email-engineering-company') ? 'is-invalid' : ''; ?>" name="email-engineering-company" id="email-engineering-company" value="<?= set_value('email-engineering-company'); ?>" placeholder="Engineer's Email">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email-engineering-company'); ?>
                                        </div>
                                    <?php endif; ?>
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
                            <h5 class="text-dark text-center">General Affairs of The Company<br><small class="text-secondary">(Optional)</small></h5><br>
                            <div class="form-group row">
                                <label for="company-general-name" class="col-sm-2 col-form-label-sm">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('company-general-name') ? 'is-invalid' : ''; ?>" name="company-general-name" id="company-general-name" value="<?= set_value('company-general-name'); ?>" placeholder="General Affairs Name">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('company-general-name'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="general-position-company" class="col-sm-2 col-form-label-sm">Position</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('general-position-company') ? 'is-invalid' : ''; ?>" name="general-position-company" id="general-position-company" value="<?= set_value('general-position-company'); ?>" placeholder="General Affairs Position">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('general-position-company'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="phone-general-company" class="col-sm-2 col-form-label-sm">Phone Number</label>
                                <div class="col-sm-10 phone">
                                    <input type="tel" class="form-control form-control-sm phone_flag <?php if (isset($validation)) echo $validation->hasError('phone-general-company.full') ? 'is-invalid' : ''; ?>" name="phone-general-company[main]" value="<?= set_value('phone-general-company[main]'); ?>">
                                    <span class="valid-msg hide">✓ Valid</span>
                                    <span class="error-msg hide"></span>
                                    <?php if (isset($validation)) : ?>
                                        <div class="error-msg pt-1" style="font-size: 80%;">
                                            <?= $validation->getError('phone-general-company.full'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="email-general-company" class="col-sm-2 col-form-label-sm">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('email-general-company') ? 'is-invalid' : ''; ?>" name="email-general-company" id="email-general-company" value="<?= set_value('email-general-company'); ?>" placeholder="General Affairs Email">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('email-general-company'); ?>
                                        </div>
                                    <?php endif; ?>
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
                            <h5 class="text-dark text-center">Technical Specification</h5><br>
                            <div class="form-group row">
                                <label for="captive-power" class="col-sm-2 col-form-label-sm">Captive Power</label>
                                <div class="col-sm-4">
                                    <input type="number" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('captive-power') ? 'is-invalid' : ''; ?>" name="captive-power" id="captive-power" value="<?= set_value('captive-power'); ?>" placeholder="Total Captive Power">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('captive-power'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="amount-of-power" class="col-sm-2 col-form-label-sm">Amount of Power</label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('amount-of-power') ? 'is-invalid' : ''; ?>" name="amount-of-power" id="amount-of-power" value="<?= set_value('amount-of-power'); ?>" placeholder="Amount of Power (Captive Power)">
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('amount-of-power'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="suggestion" class="col-sm-2 col-form-label-sm">Suggestion</label>
                                <div class="col-sm-10">
                                    <textarea type="text" class="form-control form-control-sm <?php if (isset($validation)) echo $validation->hasError('suggestion') ? 'is-invalid' : ''; ?>" name="suggestion" id="suggestion" cols="30" rows="4" value="<?= set_value('suggestion'); ?>" placeholder="Any suggestion.."><?= set_value('suggestion'); ?></textarea>
                                    <?php if (isset($validation)) : ?>
                                        <div class="invalid-feedback">
                                            <?= $validation->getError('suggestion'); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-10">
                                    <a class="btn btn-info btnPrevious text-white">Previous</a>
                                    <button class="btn btn-primary btn-rejuvenation" type="submit" data-customer="<?= $customer['name_customer']; ?>">
                                        Save
                                        <i class="fas fa-save ml-1 text-white"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Tab Panes -->
            </div>
            </form>
        </div>
    </div>
    <br>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script type="text/javascript">
    $('.btnNext').click(function() {
        $('.nav-pills > .nav-item > .active').parent().next('li').find('a').trigger('click');
    });

    $('.btnPrevious').click(function() {
        $('.nav-pills > .nav-item > .active').parent().prev('li').find('a').trigger('click');
    });
</script>

<script type="text/javascript">
    $(function() {
        var today = new Date();
        var year = today.getFullYear;

        $('#datetimepicker-establishment').datetimepicker({
            format: 'YYYY-MM-DD',
            todayHighlight: true,
            icons: {
                time: "fas fa-clock",
                date: "fas fa-calendar-alt",
                up: "fas fa-arrow-up",
                down: "fas fa-arrow-down",
                today: "fas fa-calendar-check",
                // clear: "fas fa-trash-alt"
            },
            buttons: {
                showToday: true,
            },
        });
    });
</script>

<!-- Intl Telephone Input -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.6/js/intlTelInput.min.js" integrity="sha512-p7KMhWOBzQOB7XHRi5pMula0Z4n8zxb09+ftlz+4lor1ZwmEp8SGi9Ki/JQ4VTrJEImAyrnw2vnE5faPPu3c0w==" crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/intlTelInput_lpremium.js'); ?>"></script>

<!-- Tail Select JS -->
<script type="text/javascript" src="<?= base_url('assets/js/tail.select-full.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/tail_lpremium.js'); ?>"></script>

<?= $this->endSection(); ?>