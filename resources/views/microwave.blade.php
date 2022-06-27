@extends('layers.html')


@section('title', 'Microwave')

@section('main-content')
    <h3>Microwave</h3>


    <form method="post" action="" enctype=multipart/form-data>
        @csrf
        <label for="email"></label>
        <div class="row">
            <div class="col-auto">
                <label for="power">Power</label>
                <select class="col-auto @error('power') is-invalid @enderror" id="power" name="power">
                    @foreach($configs as $config)
                        <option value="{{ $config->power }}">{{ $config->name }}</option>
                    @endforeach
                </select>
                @error('power')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-auto">
                <label for="time">Time</label>
                <input class="@error('time') is-invalid @enderror" type="number" id="time" name="time" min="0" step="5"
                       data-bind="value:replyNumber" required/>
                @error('time')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-auto">
                <label for="product_id">Product</label>
                <select class="col-auto @error('product_id') is-invalid @enderror" id="product_id" name="product_id">
                    @foreach($products as $product)
                        <option value="{{ $product->id }}">{{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-auto">
                <label for="weight">Weight</label>
                <input class="@error('weight') is-invalid @enderror" type="number" id="weight" name="weight" min="100"
                       step="100" data-bind="value:replyNumber" required/>
                @error('weight')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <button type="submit" class="btn btn-success mb-2">Start</button>

    </form>

    <h3>Results</h3>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Product</th>
            <th scope="col">Weight, Gram</th>
            <th scope="col">Power, Watt</th>
            <th scope="col">Time, Seconds</th>
            <th scope="col">Totally Power, Watt</th>
            <th scope="col">Temperature, *C</th>
        </tr>
        </thead>
        <tbody>
        @foreach($microwave_results as $result)
            <tr>
                <th scope="row">{{ $result->id }}</th>
                <td>{{ $result->product->name }}</td>
                <td>{{ $result->weight}}</td>
                <td>{{ $result->power }}</td>
                <td>{{ $result->time }}</td>
                <th>{{ $result->totally_power }}</th>
                <td>{{ $result->temperature }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>


    <svg version="1.2" xmlns="http://www.w3.org/2000/svg"
         class="graph mt-5" aria-labelledby="title" role="img">
        <title id="title">A line chart showing some information</title>
        {{--Y--}}
        <g class="grid x-grid" id="xGrid">
            <line x1="90" x2="90" y1="5" y2="{{ $mr_diagram->height }}"></line>
        </g>
        {{--X--}}
        <g class="grid y-grid" id="yGrid">
            <line x1="90" x2="{{ $mr_diagram->width }}" y1="{{ $mr_diagram->height }}"
                  y2="{{ $mr_diagram->height }}"></line>
        </g>


        {{--X Lables--}}
        <g class="labels x-labels">
            <text x="{{ $mr_diagram->width / 2 }}" y="{{ $mr_diagram->height_xLabelTitle }}" class="label-title">
                {{ $mr_diagram->xLabel }}
            </text>
            @foreach($mr_diagram->x as $x => $xPoint)
                <text x="{{ $x }}" y="{{ $mr_diagram->height_xLabel }}">{{ $xPoint }}</text>
            @endforeach
        </g>

        {{--Y Lables--}}
        <g class="labels y-labels">
            <text x="50" y="{{$mr_diagram->height / 2}}" class="label-title">{{ $mr_diagram->yLabel }}</text>
            @foreach($mr_diagram->y as $y => $yPoint)
                <text x="80" y="{{ $y }}">{{ $yPoint }}</text>
            @endforeach
            <text x="80" y="{{$y + 55}}">0</text>
        </g>
        {{--Data--}}
        <g class="data" data-setname="Our first data set">
            @foreach($microwave_results as $item)
                <circle
                    cx="{{ array_search($item->totally_power, $mr_diagram->x->all()) }}"
                    cy="{{ array_search($item->weight, $mr_diagram->y->all()) }}"
                    {{--                    data-value="7.2"--}}
                    r="2">
                </circle>
                <text class="text-danger"
                      x="{{ array_search($item->totally_power, $mr_diagram->x->all()) + 2 }}"
                      y="{{ array_search($item->weight, $mr_diagram->y->all()) - 2 }}"

                      data-id="{{ $item->product->id }}"
                      data-product-name="{{ $item->product->name }}"
                      data-weight="{{ $item->weight }}"
                      data-time="{{ $item->time }}"
                      data-totally-power="{{ $item->totally_power }}"
                      data-temperature="{{ $item->temperature }}"
                >
                    {{ $item->temperature }}
                </text>
            @endforeach

        </g>
    </svg>
@endsection
