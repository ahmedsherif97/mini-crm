<?php

namespace App\Http\Services;

use App\Models\Unit;

class CalcCalorieService
{
    public function calculate($age, $gender, $height, $weight, $activityLevel, $goal): array
    {
        $bmr = $this->calculateBMR($gender, $weight, $height, $age);
        $tdee = $this->applyActivityLevel($bmr, $activityLevel);
        $finalCalories = $this->applyGoalModification($tdee, $goal);
        $finalCalories = round($finalCalories);

        $macronutrients = $this->calculateMacronutrients($finalCalories);

        return [
            'calories' => $finalCalories,
            'protein' => ceil($macronutrients['protein']).' '.Unit::query()->where('name_en', 'gm')->first()->name,
            'carbs' => ceil($macronutrients['carbs']).' '.Unit::query()->where('name_en', 'gm')->first()->name,
            'fats' => ceil($macronutrients['fats']).' '.Unit::query()->where('name_en', 'gm')->first()->name
        ];
    }

    private function calculateBMR($gender, $weight, $height, $age): float
    {
        if ($gender == 'male') {
            return 10 * $weight + 6.25 * $height - 5 * $age + 5;
        } else {
            return 10 * $weight + 6.25 * $height - 5 * $age - 161;
        }
    }

    private function applyActivityLevel($bmr, $activityLevel): float
    {
        $activityMultipliers = [
            'sedentary' => 1.2,
            'light' => 1.375,
            'moderate' => 1.55,
            'active' => 1.725,
            'very_active' => 1.9
        ];

        return $bmr * ($activityMultipliers[$activityLevel] ?? 1.2);
    }

    private function applyGoalModification($tdee, $goal): float
    {
        return match ($goal) {
            'weight_loss' => $tdee * 0.8,
            'weight_gain' => $tdee * 1.2,
            default => $tdee,
        };
    }

    private function calculateMacronutrients($calories): array
    {
        $proteinPercentage = 0.20;
        $carbsPercentage = 0.50;
        $fatsPercentage = 0.30;

        $protein = ($calories * $proteinPercentage) / 4; // 4 calories per gram of protein
        $carbs = ($calories * $carbsPercentage) / 4;     // 4 calories per gram of carbs
        $fats = ($calories * $fatsPercentage) / 9;       // 9 calories per gram of fat

        return [
            'protein' => round($protein, 2),
            'carbs' => round($carbs, 2),
            'fats' => round($fats, 2)
        ];
    }
}
