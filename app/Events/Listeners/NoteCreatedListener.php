<?php

namespace FI\Events\Listeners;

use FI\Events\NoteCreated;
use FI\Modules\MailQueue\Repositories\MailQueueRepository;
use FI\Modules\MailQueue\Support\MailQueue;

class NoteCreatedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(MailQueue $mailQueue, MailQueueRepository $mailQueueRepository)
    {
        $this->mailQueue           = $mailQueue;
        $this->mailQueueRepository = $mailQueueRepository;
    }

    /**
     * Handle the event.
     *
     * @param  NoteCreated $event
     * @return void
     */
    public function handle(NoteCreated $event)
    {
        $mail = $this->mailQueueRepository->create($event->note->notable, [
            'to'         => $event->note->notable->user->email,
            'cc'         => config('fi.mailDefaultCc'),
            'bcc'        => config('fi.mailDefaultBcc'),
            'subject'    => trans('fi.note_notification'),
            'body'       => $event->note->formatted_note,
            'attach_pdf' => config('fi.attachPdf')
        ]);

        $this->mailQueue->send($mail->id);
    }
}
