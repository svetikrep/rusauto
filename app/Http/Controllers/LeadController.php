<?php

namespace App\Http\Controllers;

use App\Events\LeadCreated;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $lead = Lead::create([
            'car_id'     => $validated['car_id'] ?? null,
            'name'       => $validated['name'],
            'phone'      => $validated['phone'],
            'message'    => $validated['message'] ?? null,
            'status'     => 'new',
            'ip_address' => $request->ip(),
        ]);

        LeadCreated::dispatch($lead);

        session()->flash('success', "Спасибо, {$lead->name}! Ваша заявка №{$lead->id} успешно принята. Наш менеджер свяжется с вами по номеру {$lead->phone}.");
        session()->put('client_name', $lead->name);
        session()->put('client_phone', $lead->phone);
        session()->put('last_lead_id', $lead->id);
        session()->increment('leads_submitted_count');

        return redirect()->to(url()->previous() . '#lead-form');
    }
}
