<?php

namespace FI\Events\Listeners;

use FI\Events\CheckAttachment;
use FI\Modules\Attachments\Repositories\AttachmentRepository;

class CheckAttachmentListener
{
    public function __construct(AttachmentRepository $attachmentRepository)
    {
        $this->attachmentRepository = $attachmentRepository;
    }

    public function handle(CheckAttachment $event)
    {
        if (request()->hasFile('attachments'))
        {
            foreach (request()->file('attachments') as $attachment)
            {
                if ($attachment)
                {
                    $this->attachmentRepository->create($event->object, $attachment, auth()->user()->id);

                    $attachment->move($event->object->attachment_path, $attachment->getClientOriginalName());
                }

            }
        }
    }
}
