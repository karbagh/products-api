<?php

namespace App\Providers;

use App\Events\Auth\UserRegisteredEvent;
use App\Events\Mailing\MailingEvent;
use App\Events\Order\OrderCanceledEvent;
use App\Events\Order\OrderCompleatedEvent;
use App\Events\Order\OrderCreatedEvent;
use App\Events\Order\OrderPayment\OrderPaymentStatusEvent;
use App\Events\Order\OrderShippedEvent;
use App\Events\Order\Reverse\OrderReverseApprovedEvent;
use App\Listeners\Auth\UserRegisterListener;
use App\Listeners\EHDMManageListener;
use App\Listeners\Mailing\MailingListener;
use App\Listeners\Order\OrderCancelCreditCardListener;
use App\Listeners\Order\OrderCreateInOnesListener;
use App\Listeners\Order\OrderPayment\OneSOrderPaymentStatusUpdateListener;
use App\Listeners\Order\OrderShippedListener;
use App\Listeners\Order\Reverse\OrderReverseInCreditCardListener;
use App\Listeners\Order\Reverse\OrderReverseInEHDMListener;
use App\Listeners\Order\Reverse\OrderReverseRecalculateListener;
use App\Listeners\PartnerBonusesRecalculateListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MailingEvent::class => [
            MailingListener::class,
        ],
        UserRegisteredEvent::class => [
            UserRegisterListener::class,
        ],
        OrderShippedEvent::class => [
            OrderShippedListener::class,
            OrderCreateInOnesListener::class,
        ],
        OrderCompleatedEvent::class => [
//            EHDMManageListener::class,
            PartnerBonusesRecalculateListener::class,
        ],
        OrderCreatedEvent::class => [
        ],
        OrderPaymentStatusEvent::class => [
            OneSOrderPaymentStatusUpdateListener::class,
        ],
        OrderReverseApprovedEvent::class => [
//            OrderReverseInEHDMListener::class,
            OrderReverseRecalculateListener::class,
            OrderReverseInCreditCardListener::class,
        ],
        OrderCanceledEvent::class => [
            OrderCancelCreditCardListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
