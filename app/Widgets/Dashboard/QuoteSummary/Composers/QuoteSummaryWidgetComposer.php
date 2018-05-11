<?php

namespace FI\Widgets\Dashboard\QuoteSummary\Composers;

use FI\Widgets\Dashboard\QuoteSummary\Repositories\QuoteSummaryWidgetRepository;

class QuoteSummaryWidgetComposer
{
    public function __construct(QuoteSummaryWidgetRepository $quoteSummaryWidgetRepository)
    {
        $this->quoteSummaryWidgetRepository = $quoteSummaryWidgetRepository;
    }

    public function compose($view)
    {
        $view->with('quotesTotalDraft', $this->quoteSummaryWidgetRepository->getQuoteTotalDraft())
            ->with('quotesTotalSent', $this->quoteSummaryWidgetRepository->getQuoteTotalSent())
            ->with('quotesTotalApproved', $this->quoteSummaryWidgetRepository->getQuoteTotalApproved())
            ->with('quotesTotalRejected', $this->quoteSummaryWidgetRepository->getQuoteTotalRejected())
            ->with('quoteDashboardTotalOptions', periods());
    }
}