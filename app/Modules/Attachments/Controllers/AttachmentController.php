<?php

/**
 * This file is part of FusionInvoice.
 *
 * (c) FusionInvoice, LLC <jessedterry@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FI\Modules\Attachments\Controllers;

use FI\Events\CheckAttachment;
use FI\Http\Controllers\Controller;
use FI\Modules\Attachments\Repositories\AttachmentRepository;

class AttachmentController extends Controller
{
    private $attachmentRepository;

    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function download($urlKey)
    {
        $attachment = $this->attachmentRepository->findByKey($urlKey);

        return response()->download($attachment->attachable->attachment_path . '/' . $attachment->filename);
    }

    public function ajaxList()
    {
        $model = request('model');

        $object = $model::find(request('model_id'));

        return view('attachments._table')
            ->with('model', request('model'))
            ->with('object', $object);
    }

    public function ajaxDelete()
    {
        $this->attachmentRepository->delete(request('attachment_id'));
    }

    public function ajaxModal()
    {
        return view('attachments._modal_attach_files')
            ->with('model', request('model'))
            ->with('modelId', request('model_id'));
    }

    public function ajaxUpload()
    {
        $model = request('model');

        $object = $model::find(request('model_id'));

        event(new CheckAttachment($object));
    }

    public function ajaxAccessUpdate()
    {
        $this->attachmentRepository->updateClientVisibility(request('attachment_id'), request('client_visibility'));
    }
}