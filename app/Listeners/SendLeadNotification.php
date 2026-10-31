<?php

namespace App\Listeners;

use App\Events\LeadCreated;
use Illuminate\Support\Facades\Log;

class SendLeadNotification
{
    public function __construct()
    {
    }

    public function handle(LeadCreated $event): void
    {
        $lead = $event->lead;
        $carTitle = $lead->car ? $lead->car->title : 'Общая консультация';

        Log::info(" [Событие LeadCreated обработано слушателем SendLeadNotification]", [
            'lead_id'   => $lead->id,
            'client'    => $lead->name,
            'phone'     => $lead->phone,
            'interest'  => $carTitle,
            'created_at'=> $lead->created_at->toDateTimeString(),
        ]);
    }
}
