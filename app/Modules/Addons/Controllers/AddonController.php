<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Addons\Controllers;

use FI\Http\Controllers\Controller;
use FI\Modules\Addons\Repositories\AddonRepository;
use FI\Support\Migrations;

class AddonController extends Controller
{
    private $addonRepository;
    private $migrations;

    public function __construct(AddonRepository $addonRepository, Migrations $migrations)
    {
        $this->addonRepository = $addonRepository;
        $this->migrations      = $migrations;
    }

    public function index()
    {
        $this->addonRepository->refreshList();

        return view('addons.index')
            ->with('addons', $this->addonRepository->get());
    }

    public function install($id)
    {
        $this->addonRepository->install($id);

        return redirect()->route('addons.index');
    }

    public function upgrade($id)
    {
        $addon = $this->addonRepository->find($id);

        $this->migrations->runMigrations(addon_path($addon->path . '/Migrations'));

        return redirect()->route('addons.index');
    }

    public function uninstall($id)
    {
        $this->addonRepository->uninstall($id);

        return redirect()->route('addons.index');
    }
}