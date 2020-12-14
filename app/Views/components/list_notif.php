<?php
$id = 0;

foreach ($notif as $notifs) : ?>
    <a class="dropdown-item d-flex align-items-center notifs" href="#" data-id="<?= $notifs['id_notification']; ?>" data-url="<?= base_url('read-notif'); ?>">
        <div class="mr-3">
            <div class="icon-circle <?= $notifs['bg_color']; ?>">
                <i class="<?= $notifs['icon']; ?> text-white"></i>
            </div>
        </div>
        <div>
            <div class="small text-gray-500"><?= date('d F Y H:i:s', strtotime($notifs['created_at'])); ?></div>
            <span class="font-weight-bold"><?= $notifs['title']; ?> : <?= $notifs['detail']; ?> </span>
        </div>
    </a>
<?php
    $id = $id + 1;
endforeach; ?>