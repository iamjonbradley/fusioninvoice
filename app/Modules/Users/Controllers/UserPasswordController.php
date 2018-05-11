<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Users\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Users\Repositories\UserRepository;
use FI\Modules\Users\Validators\UserValidator;
use FI\Traits\ReturnUrl;

class UserPasswordController extends Controller
{
    use ReturnUrl;

    private $userRepository;
    private $userValidator;

    public function __construct(UserRepository $userRepository, UserValidator $userValidator)
    {
        $this->userRepository = $userRepository;
        $this->userValidator  = $userValidator;
    }

    public function edit($userId)
    {
        return view('users.password_form')
            ->with('user', $this->userRepository->find($userId));
    }

    public function update($userId)
    {
        $validator = $this->userValidator->getUpdatePasswordValidator(request()->all());

        if ($validator->fails())
        {
            return redirect()->route('users.password.edit', [$userId])
                ->withErrors($validator);
        }

        $this->userRepository->updatePassword(request('password'), $userId);

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('fi.password_successfully_reset'));
    }
}