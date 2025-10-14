<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Timeslot;
use Carbon\Carbon;

class ServiceTimeslotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 3 demo services
        $services = collect([
            ['name' => 'Haircut', 'price' => 20.00, 'duration' => 30],
            ['name' => 'Massage', 'price' => 50.00, 'duration' => 60],
            ['name' => 'Consultation', 'price' => 0.00, 'duration' => 45],
        ])->map(function ($s) {
            return Service::create($s);
        });

        // For each service, create 5 timeslots starting tomorrow 09:00
        $services->each(function (Service $service) {
            $start = Carbon::tomorrow()->setHour(9)->setMinute(0)->setSecond(0);
            for ($i = 0; $i < 5; $i++) {
                $slotStart = $start->copy()->addMinutes($i * $service->duration);
                Timeslot::create([
                    'service_id' => $service->id,
                    'start_time' => $slotStart,
                    'end_time' => $slotStart->copy()->addMinutes($service->duration),
                    'booked' => false,
                ]);
            }
        });
    }
}
