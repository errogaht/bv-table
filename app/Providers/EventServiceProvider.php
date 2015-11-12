<?php

namespace App\Providers;

use App\Contact;
use App\ContactLog;
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
        'App\Events\SomeEvent' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);

        Contact::updating(function ($contact) {
            if ($new_values = $contact->getDirty()) {
                $values = [];
                $old_values = $contact->getOriginal();
                foreach ($new_values as $key => $value) {
                    $values[] = [$key, $old_values[$key], $value];
                }
                $log = new ContactLog;
                $log->contact_id = $contact->id;
                $log->user_id = \Auth::getUser()->id;
                $log->comment = 'json:'.json_encode($values);
                $log->save();
            }
        });
    }
}
