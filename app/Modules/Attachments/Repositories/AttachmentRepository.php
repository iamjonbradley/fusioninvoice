<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Attachments\Repositories;

use FI\Modules\Attachments\Models\Attachment;

class AttachmentRepository
{
    public function findByKey($urlKey)
    {
        return Attachment::where('url_key', $urlKey)->firstOrFail();
    }

    public function create($object, $file, $userId)
    {
        $object->attachments()->create([
            'user_id'  => $userId,
            'filename' => $file->getClientOriginalName(),
            'mimetype' => $file->getMimeType(),
            'size'     => $file->getSize(),
        ]);
    }

    public function get($module, $model, $id)
    {
        $model = 'FI\\Modules\\' . $module . '\\Models\\' . $model;

        return Attachment::where('attachable_type', $model)
            ->where('attachable_id', $id)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function delete($id)
    {
        Attachment::destroy($id);
    }

    public function updateClientVisibility($id, $clientVisibility)
    {
        $attachment = Attachment::find($id);

        $attachment->client_visibility = $clientVisibility;

        $attachment->save();
    }
}