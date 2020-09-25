<?php

namespace Config;

class Validation
{
	//--------------------------------------------------------------------
	// Setup
	//--------------------------------------------------------------------

	/**
	 * Stores the classes that contain the
	 * rules that are available.
	 *
	 * @var array
	 */
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
		\App\Validations\AuthRules::class,
		// \App\Validations\FileRules::class,
	];

	public $transaction = [
		'file_excel' => 'uploaded[file_excel]|ext_in[file_excel,xls,xlsx]|max_size[file_excel,2048]',
	];

	public $transaction_errors = [
		'file_excel' => [
			'ext_in'    => 'File Excel hanya boleh diisi dengan extension .xls atau .xlsx',
			'max_size'  => 'File Excel maksimal 2MB',
			'uploaded'  => 'File Excel wajib diisi'
		]
	];

	/**
	 * Specifies the views that are used to display the
	 * errors.
	 *
	 * @var array
	 */
	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	//--------------------------------------------------------------------
	// Rules
	//--------------------------------------------------------------------
}
