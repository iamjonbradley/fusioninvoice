<?php

namespace FI\Widgets\Dashboard\ClientActivity\Composers;

use FI\Widgets\Dashboard\ClientActivity\Repositories\ClientActivityWidgetRepository;

class ClientActivityWidgetComposer
{
    public function __construct(ClientActivityWidgetRepository $clientActivityWidgetRepository)
    {
        $this->clientActivityWidgetRepository = $clientActivityWidgetRepository;
    }

    public function compose($view)
    {
        $view->with('recentClientActivity', $this->clientActivityWidgetRepository->getRecentClientActivity());
    }
}