<?php

 namespace App\Providers;

 use Illuminate\Auth\Events\Registered;
 use Illuminate\Auth\Events\Login;
 use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
 use App\Listeners\AssignViewerRole;
 use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

 class EventServiceProvider extends ServiceProvider
 {
     protected $listen = [
         Registered::class => [
             SendEmailVerificationNotification::class,
         ],
         Login::class => [
             AssignViewerRole::class,
         ],
     ];

     public function boot(): void
     {
         //
     }

     public function shouldDiscoverEvents(): bool
     {
         return false;
     }
 }
