<?php

namespace Database\Seeders;

use App\Models\LeadSource;
use App\Models\LeadStatus;
use Illuminate\Database\Seeder;

class LeadManagementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Seed Lead Sources
        $sources = LeadSource::getDefaultSources();
        foreach ($sources as $source) {
            LeadSource::firstOrCreate(
                ['name' => $source['name']],
                $source
            );
        }

        // Seed Lead Statuses
        $statuses = LeadStatus::getDefaultStatuses();
        foreach ($statuses as $status) {
            LeadStatus::firstOrCreate(
                ['name' => $status['name']],
                $status
            );
        }

        $this->command->info('Lead management system seeded successfully!');
    }
}
