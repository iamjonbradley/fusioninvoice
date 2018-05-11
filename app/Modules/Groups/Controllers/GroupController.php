<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Groups\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Groups\GroupOptions;
use FI\Modules\Groups\Repositories\GroupRepository;
use FI\Modules\Groups\Validators\GroupValidator;
use FI\Traits\ReturnUrl;

class GroupController extends Controller
{
    use ReturnUrl;

    private $groupOptions;
    private $groupRepository;
    private $groupValidator;

    public function __construct(
        GroupOptions $groupOptions,
        GroupRepository $groupRepository,
        GroupValidator $groupValidator)
    {
        $this->groupOptions    = $groupOptions;
        $this->groupRepository = $groupRepository;
        $this->groupValidator  = $groupValidator;
    }

    public function index()
    {
        $this->setReturnUrl();

        $groups = $this->groupRepository->paginate();

        return view('groups.index')
            ->with('groups', $groups)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function create()
    {
        return view('groups.form')
            ->with('editMode', false)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function store()
    {
        $input = request()->all();

        $validator = $this->groupValidator->getValidator($input);

        if ($validator->fails())
        {
            return redirect()->route('groups.create')
                ->with('editMode', false)
                ->withErrors($validator)
                ->withInput();
        }

        $this->groupRepository->create($input);

        return redirect($this->getReturnUrl())
            ->with('alertSuccess', trans('fi.record_successfully_created'));
    }

    public function edit($id)
    {
        $group = $this->groupRepository->find($id);

        return view('groups.form')
            ->with('editMode', true)
            ->with('group', $group)
            ->with('resetNumberOptions', $this->groupOptions->resetNumberOptions());
    }

    public function update($id)
    {
        $input = request()->all();

        $validator = $this->groupValidator->getValidator($input);

        if ($validator->fails())
        {
            return redirect()->route('groups.edit', [$id])
                ->with('editMode', true)
                ->withErrors($validator)
                ->withInput();
        }

        $this->groupRepository->update($input, $id);

        return redirect($this->getReturnUrl())
            ->with('alertInfo', trans('fi.record_successfully_updated'));
    }

    public function delete($id)
    {
        $this->groupRepository->delete($id);

        return redirect()->route('groups.index')
            ->with('alert', trans('fi.record_successfully_deleted'));
    }
}