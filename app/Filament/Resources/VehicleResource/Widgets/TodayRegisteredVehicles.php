<?php

namespace App\Filament\Resources\VehicleResource\Widgets\TodayRegisteredVehiclesWidget;

use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Vehicle;
use Flowframe\Trend\Trend;

class TodayRegisteredVehiclesWidget extends BaseWidget
{
    protected static string $view = 'filament-widgets::stats-overview-widget';

    protected function getColumns(): int
    {
        return 2; // Adjust the number of columns as needed
    }

    protected function getStats(): array
    {
        // Query for today's registered vehicles
        $vehicleQuery = Vehicle::query();

        $trendc = Trend::query((clone $vehicleQuery))
            ->interval('day')
            ->dateColumn('created_at') // Assuming "registered_at" is the column for vehicle registration
            ->between(now()->subDays(30), now())
            ->count();

        return [
            Stat::make('Vehicles Registered Today', (clone $vehicleQuery)->whereDate('created_at', Carbon::today())->count())
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->value((clone $vehicleQuery)->whereDate('created_at', Carbon::today())->count())
                ->chart($trendc->pluck('aggregate')->toArray())
                ->color('primary')
                ->icon('heroicon-o-truck'),
        ];
    }
}
