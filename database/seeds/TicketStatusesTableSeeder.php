<?php

use Illuminate\Database\Seeder;

class TicketStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ticket_statuses')->insert(
            [
                'status' => 'in behandeling',
            ],
            [
                'status' => 'wachten op medewerker',
            ],
            [
                'status' => 'wachten op klant',
            ],
            [
                'status' => 'voltooid',
            ]
        );
    }
}
