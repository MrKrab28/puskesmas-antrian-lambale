<?php

namespace App\Providers;

use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AppServiceProvider::class, function ($app) {
            return new AppServiceProvider($app);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $umum =  Antrian::where('jenis_antrian', 'umum')->whereDate('created_at', Carbon::today())->get()->count();
        $kia =  Antrian::where('jenis_antrian', 'kia')->whereDate('created_at', Carbon::today())->get()->count();
        $gigi =  Antrian::where('jenis_antrian', 'gigi')->whereDate('created_at', Carbon::today())->get()->count();

        View::share('kuota', [
            'umum' => 30 - $umum,
            'kia' => 30 - $kia,
            'gigi' => 30 - $gigi,
        ]);
    }
    public function getKuotaAntrian(): array
    {
        $umum = Antrian::where('jenis_antrian', 'umum')->whereDate('created_at', Carbon::today())->get()->count();
        $kia = Antrian::where('jenis_antrian', 'kia')->whereDate('created_at', Carbon::today())->get()->count();
        $gigi = Antrian::where('jenis_antrian', 'gigi')->whereDate('created_at', Carbon::today())->get()->count();

        return [
            'umum' => 30 - $umum,
            'kia' => 30 - $kia,
            'gigi' => 30 - $gigi,
        ];
    }
}
