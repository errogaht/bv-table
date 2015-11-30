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

        Contact::updating(function (Contact $contact) {
            if ($new_values = $contact->getDirty()) {
                if (isset($new_values['status'])) {
                    $message = \Lang::get('contact.status_update.'.$new_values['status']);

                    if ($contact->hasAttribute('change_status_comment')) {
                        if ($comment = $contact->getAttribute('change_status_comment')) {
                            $message .= PHP_EOL . $comment;
                        }
                        unset($contact->change_status_comment);
                    }

                } else {
                    $values = [];
                    $old_values = $contact->getOriginal();
                    foreach ($new_values as $key => $value) {
                        $values[] = [$key, $old_values[$key], $value];
                    }
                    $message = 'json:'.json_encode($values);
                }

                $log = new ContactLog;
                $log->contact_id = $contact->id;
                $log->user_id = \Auth::getUser()->id;
                $log->comment = $message;
                $log->save();
            }
        });
    }
}
