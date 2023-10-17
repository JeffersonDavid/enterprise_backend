<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\Transaction;
use App\Models\CustomersLead;
use App\Models\MailNotifications;

use App\Observers\TransactionOberver;
use App\Observers\CustomersLeadobserver;
use App\Observers\MailNotificationObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Transaction::observe(TransactionOberver::class); 
        CustomersLead::observe(CustomersLeadobserver::class); 
        MailNotifications::observe(MailNotificationObserver::class);
        
    }
}
