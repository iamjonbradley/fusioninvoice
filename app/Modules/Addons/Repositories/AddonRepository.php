<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Addons\Repositories;

use FI\Modules\Addons\Models\Addon;
use FI\Support\Directory;

class AddonRepository
{
    public function find($id)
    {
        return Addon::find($id);
    }

    public function get()
    {
        return Addon::orderBy('name')->get();
    }

    public function getEnabled()
    {
        return Addon::where('enabled', 1)->orderBy('name')->get();
    }

    public function findByName($name)
    {
        return Addon::where('name', $name)->first();
    }

    public function create($input)
    {
        return Addon::create($input);
    }

    public function update($input, $id)
    {
        $addon = Addon::find($id);

        $addon->fill($input);

        $addon->save();

        return $addon;
    }

    public function delete($id)
    {
        Addon::destroy($id);
    }

    public function refreshList()
    {
        $addons = Directory::listDirectories(addon_path());

        foreach ($addons as $addon)
        {
            $setupClass = 'Addons\\' . $addon . '\Setup';

            $setupClass = new $setupClass;

            $addonRecord = $setupClass->properties;

            if (!Addon::where('name', $addonRecord['name'])->count())
            {
                $addonRecord['path'] = $addon;

                Addon::create($addonRecord);
            }
        }
    }

    public function install($id)
    {
        $addon = Addon::find($id);

        $migrator = app('migrator');

        $migrator->run(addon_path($addon->path . '/Migrations'));

        $addon->enabled = 1;

        $addon->save();
    }

    public function uninstall($id)
    {
        $addon = Addon::find($id);

        // Get the migrator.
        $migrator = app('migrator');

        // Get the migration repository.
        $migrationRepository = app('migration.repository');

        // Get the list of addon migration files.
        $migrations = $migrator->getMigrationFiles(addon_path($addon->path . '/Migrations'));

        // Only keep migrations which have actually been run.
        $migrations = array_intersect($migrations, $migrationRepository->getRan());

        // Sort them in reverse.
        rsort($migrations);

        // Require the migration files so classes can be resolved.
        $migrator->requireFiles(addon_path($addon->path . '/Migrations'), $migrations);

        // Resolve the migration class, run the down method and delete from the migrations table.
        foreach ($migrations as $migration)
        {
            $instance = $migrator->resolve($migration);

            $instance->down();

            $migrationRepository->delete((object)['migration' => $migration]);
        }

        $addon->delete();
    }
}