<?php

namespace App\Providers;

use App\Repositories\FavoriteRepository;
use App\Repositories\FolderRepository;
use App\Repositories\Interfaces\FavoriteRepositoryInterface;
use App\Repositories\Interfaces\FolderRepositoryInterface;
use App\Repositories\Interfaces\NoteRepositoryInterface;
use App\Repositories\Interfaces\PaperRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\NoteRepository;
use App\Repositories\PaperRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use function Symfony\Component\String\u;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $interfaces = [
            UserRepositoryInterface::class,
            PaperRepositoryInterface::class,
            FolderRepositoryInterface::class,
            NoteRepositoryInterface::class,
            FavoriteRepositoryInterface::class,
        ];

        $implementations = [
            UserRepository::class,
            PaperRepository::class,
            FolderRepository::class,
            NoteRepository::class,
            FavoriteRepository::class,
        ];

        for ($i = 0; $i < count($interfaces); $i++) {
            $this->app->bind($interfaces[$i], $implementations[$i]);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
//        Booking::observe(BookingObserver::class);
//        Dailyexpense::observe(DailyexpenseObserver::class);
//        Delivery::observe(DeliveryObserver::class);
//        Employeeloan::observe(EmployeeloanObserver::class);
//        Employeesalary::observe(EmployeesalaryObserver::class);
//        Loandisbursement::observe(LoandisbursementObserver::class);
//        Loancollection::observe(LoancollectionObserver::class);
    }
}
