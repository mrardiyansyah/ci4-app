<?= $this->extend('layout/main'); ?>

<?= $this->section('content'); ?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-lg">
            <div class="col-lg">
                <?= session()->get('message'); ?>
            </div>

        </div>
    </div>
    <div class="row">
        <div class="col-sm">
            <table class="table table-responsive-sm table-borderless">
                <tbody>
                    <tr>
                        <th>File Name</th>
                        <th>:</th>
                        <td><?= renameFile($file['storage_file_name']); ?></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <th>:</th>
                        <td><?= $file['description']; ?></td>
                    </tr>
                    <tr>
                        <th>Size</th>
                        <th>:</th>
                        <td><?= bytesToHuman($file['size']); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm">
            <table class="table table-responsive-sm table-borderless">
                <tbody>
                    <tr>
                        <th>Upload Date</th>
                        <th>:</th>
                        <td><?= localizedTimestamp($file['created_at']); ?></td>
                    </tr>
                    <tr>
                        <th>Uploaded By</th>
                        <th>:</th>
                        <td><?= $file['name']; ?></td>
                    </tr>
                    <tr>
                        <th>Type</th>
                        <th>:</th>
                        <td><?= $file['mime_type'] ?? '-'; ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg text-center">
        <iframe id="pdfviewer" style="border:1px solid #666CCC" title="PDF in an i-Frame" src="<?= base_url($file['file_path']); ?>" frameborder="1" scrolling="auto" height="1100" width="850"></iframe>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
</script>

<?= $this->endSection(); ?>