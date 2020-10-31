<?php

namespace App\Validations;

use App\Models\M_Auth;

class AuthRules
{
    public function validateUser(string $str, string $fields, array $data)
    {
        $M_Auth = new M_Auth();
        $user = $M_Auth->where('email', $data['email'])
            ->first();

        if ($user) {
            if ($user['is_active'] == 1) {
                return password_verify($data['password'], $user['password']);
            }
        } else {
            return false;
        }
    }

    public function sameOldPassword(string $newPassword = null, string $email): bool
    {
        $M_Auth = new M_Auth();

        $user = $M_Auth->where('email', $email)->first();

        // Old Password Variable
        $oldPassword = $user['password'];

        // Verify with the Old Password
        return (password_verify($newPassword, $oldPassword)) ? false : true;
    }
}
