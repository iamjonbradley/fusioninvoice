<?php

namespace FI\Providers;

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'FI\Events\AttachmentCreating'      => [
            'FI\Events\Listeners\AttachmentCreatingListener',
        ],
        'FI\Events\AttachmentDeleted'       => [
            'FI\Events\Listeners\AttachmentDeletedListener',
        ],
        'FI\Events\CheckAttachment'         => [
            'FI\Events\Listeners\CheckAttachmentListener',
        ],
        'FI\Events\ClientCreated'           => [
            'FI\Events\Listeners\ClientCreatedListener',
        ],
        'FI\Events\ClientCreating'          => [
            'FI\Events\Listeners\ClientCreatingListener',
        ],
        'FI\Events\ClientDeleted'           => [
            'FI\Events\Listeners\ClientDeletedListener',
        ],
        'FI\Events\ClientSaving'            => [
            'FI\Events\Listeners\ClientSavingListener',
        ],
        'FI\Events\CompanyProfileSaving'    => [
            'FI\Events\Listeners\CompanyProfileSavingListener',
        ],
        'FI\Events\ExpenseDeleting'         => [
            'FI\Events\Listeners\ExpenseDeletingListener',
        ],
        'FI\Events\ExpenseSaved'            => [],
        'FI\Events\InvoiceCreated'          => [
            'FI\Events\Listeners\InvoiceCreatedListener',
        ],
        'FI\Events\InvoiceCreatedRecurring'        => [
            'FI\Events\Listeners\InvoiceCreatedRecurringListener',
        ],
        'FI\Events\InvoiceDeleted'          => [
            'FI\Events\Listeners\InvoiceDeletedListener',
        ],
        'FI\Events\InvoiceEmailed'          => [
            'FI\Events\Listeners\InvoiceEmailedListener',
        ],
        'FI\Events\InvoiceModified'         => [
            'FI\Events\Listeners\InvoiceModifiedListener',
        ],
        'FI\Events\InvoiceViewed'           => [
            'FI\Events\Listeners\InvoiceViewedListener',
        ],
        'FI\Events\NoteCreated'             => [
            'FI\Events\Listeners\NoteCreatedListener',
        ],
        'FI\Events\OverdueNoticeEmailed'    => [],
        'FI\Events\PaymentCreated'          => [
            'FI\Events\Listeners\PaymentCreatedListener',
        ],
        'FI\Events\QuoteCreated'            => [
            'FI\Events\Listeners\QuoteCreatedListener',
        ],
        'FI\Events\QuoteDeleted'            => [
            'FI\Events\Listeners\QuoteDeletedListener',
        ],
        'FI\Events\QuoteModified'           => [
            'FI\Events\Listeners\QuoteModifiedListener',
        ],
        'FI\Events\QuoteEmailed'            => [
            'FI\Events\Listeners\QuoteEmailedListener',
        ],
        'FI\Events\QuoteApproved'           => [
            'FI\Events\Listeners\QuoteApprovedListener',
        ],
        'FI\Events\QuoteRejected'           => [
            'FI\Events\Listeners\QuoteRejectedListener',
        ],
        'FI\Events\QuoteViewed'             => [
            'FI\Events\Listeners\QuoteViewedListener',
        ],
        'FI\Events\RecurringInvoiceCreated' => [
            'FI\Events\Listeners\RecurringInvoiceCreatedListener',
        ],
        'FI\Events\RecurringInvoiceDeleted' => [
            'FI\Events\Listeners\RecurringInvoiceDeletedListener',
        ],
        'FI\Events\RecurringInvoiceModified' => [
            'FI\Events\Listeners\RecurringInvoiceModifiedListener',
        ],
        'FI\Events\SettingSaving'           => [
            'FI\Events\Listeners\SettingSavingListener',
        ],
        'FI\Events\UserCreated'             => [
            'FI\Events\Listeners\UserCreatedListener',
        ],
        'FI\Events\UserDeleted'             => [
            'FI\Events\Listeners\UserDeletedListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        //
    }
}
