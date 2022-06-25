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
                <td>{{ $result->temperature}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
