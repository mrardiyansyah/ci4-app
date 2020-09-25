<?php

namespace App\Validations;

class FileRules
{
    public $transaction = [
        'trx_file' => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,2048]',
    ];

    public $transaction_errors = [
        'trx_file' => [
            'ext_in'    => 'File Excel hanya boleh diisi dengan xls atau xlsx.',
            'max_size'  => 'File Excel product maksimal 2mb',
            'uploaded'  => 'File Excel product wajib diisi'
        ]
    ];
}
