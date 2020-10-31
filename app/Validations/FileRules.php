<?php

namespace App\Validations;

class FileRules
{
    public $transaction = [
        'file_excel' => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]|max_size[file_excel,2048]',
    ];

    public $transaction_errors = [
        'file_excel' => [
            'ext_in'    => 'Hanya ekstensi XLS atau XLSX yang diperbolehkan',
            'max_size'  => 'Maksimal Ukuran File adalah 2MB',
            'uploaded'  => 'File tidak terupload. Silahkan pilih file.'
        ]
    ];
}
