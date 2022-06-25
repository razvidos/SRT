<?php

namespace App\Http\Controllers;

use App\Http\Requests\MicrowaveRequest;
use App\Models\MicrowaveConfig;
use App\Models\MicrowaveResult;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class MicrowaveController extends Controller
{
    private static float $watt_in_calories = 0.859845;

    public function index(Request $request)
    {
        $microwave_configs = MicrowaveConfig::all();
        $products = Product::all();
//        $microwave_results = DB::table('microwave_results')->crossJoin()->orderby('id', 'desc')->get()->all();
        $microwave_results = MicrowaveResult::with('product')->get();
        return view('microwave')
            ->with('configs', $microwave_configs)
            ->with('products', $products)
            ->with('microwave_results', $microwave_results);
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
