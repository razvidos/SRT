<?php

namespace App\Http\Controllers;

use App\Http\Requests\MicrowaveRequest;
use App\Models\MicrowaveConfig;
use App\Models\MicrowaveResult;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;

class MicrowaveController extends Controller
{
    private static float $watt_in_calories = 0.859845;

    public function index()
    {
        $microwave_configs = MicrowaveConfig::all();
        $products = Product::all();
        $microwave_results = MicrowaveResult::with('product')->get();

        $weight_unique = $microwave_results->pluck('weight')->unique()->sortDesc()->all();
        $totally_power_unique = $microwave_results->pluck('totally_power')->unique()->sort()->all();
        $xEnd = 15 + 55 * count($weight_unique);
        $yEnd = 140 + 140 * count($totally_power_unique);

        $microwave_results_diagram = (object)[
            'y' => collect(array_combine(range(15, $xEnd - 55, 55), $weight_unique)),
            'x' => collect(array_combine(range(140 + 1, $yEnd, 140), $totally_power_unique)),
            'xLabel' => 'TOTALLY POWER',
            'yLabel' => 'WEIGHT',
        ];
        $microwave_results_diagram->height = $xEnd;
        $microwave_results_diagram->height_xLabel = $xEnd + 30;
        $microwave_results_diagram->height_xLabelTitle = $xEnd + 30 + 40;

        $microwave_results_diagram->width = $yEnd;
        $microwave_results_diagram->width_yLabel = $yEnd + 140;
        $microwave_results_diagram->width_yLabelTitle = $yEnd + 140 + 60;

        return view('microwave')
            ->with('configs', $microwave_configs)
            ->with('products', $products)
            ->with('microwave_results', $microwave_results)
            ->with('mr_diagram', $microwave_results_diagram);
    }

    public function store(MicrowaveRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $power_generated = ($validated['power'] / 3600) * $validated['time'];
        $calories_generated = $power_generated * self::$watt_in_calories;
        $validated['temperature'] = $calories_generated / $validated['weight'];

        $model = new MicrowaveResult($validated);
        $model->save();

        return redirect()->back();
    }
}
