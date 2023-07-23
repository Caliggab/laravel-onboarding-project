<?php

namespace Database\Seeders;

use App\Models\OnboardingStep;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class OnboardingStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OnboardingStep::create([
            'title' => 'Welcome to Onboarding process for users!',
            'attach_to_selector' => '#nova > div:nth-child(1) > div > div > div.bg-white.dark\\:bg-gray-800.relative.flex-1.flex.flex-col.max-w-xxs.w-full > div.overflow-x-auto > div > div:nth-child(2) > div > div > a > span.sidebar-item-label.flex.items-center',
            'content' => 'Step 1 content goes here...',
        ]);

        OnboardingStep::create([
            'title' => 'Welcome to the Users View!',
            'attach_to_selector' => '#nova > div:nth-child(2) > div.p-4.md\\:py-8.md\\:px-12.lg\\:ml-60.space-y-8 > div.mt-8.leading-normal.text-xs.text-gray-500.space-y-1 > p:nth-child(1)',
            'content' => 'Step 2 content goes here...',
        ]);

        OnboardingStep::create([
            'title' => 'Finally you can create your user here!',
            'attach_to_selector' => '#nova > div:nth-child(2) > div.p-4.md\\:py-8.md\\:px-12.lg\\:ml-60.space-y-8 > div.mt-8.leading-normal.text-xs.text-gray-500.space-y-1 > p:nth-child(2)',
            'content' => 'Step 3 content goes here...',
        ]);
    }
}
