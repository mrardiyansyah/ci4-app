<?php if (sizeof($notif) != 0) { ?>
    <span class="badge badge-danger">
        <?php if (sizeof($notif) > 99) {
            echo '99+';
        } else {
            echo sizeof($notif);
        } ?>
    </span>
<?php } ?>