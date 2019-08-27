@extends('layouts.app')
@section('content')

<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">

      <div class="break-words bg-white border border-2 rounded shadow-md p-4 items-center mb-2">
        <h2 class="text-2xl mb-6 text-gray-800">Order {{ $order->order }}</h2>
        @foreach ($order->products as $product)
      <div class="flex break-words pb-4 items-center mb-2 {{ $loop->last ? '' : 'border-b'}}">
            <div class="mr-auto">
              <p class="text-sm mb-2 font-mono text-gray-600">{{ $product->id }}</p>
              <h4 class="text-2xl">{{ $product->name }}</h4>
            </div>
            <p class="font-mono text-indigo-700 text-2xl mr-4">${{ $product->pivot->price }} ({{ $product->pivot->quantity }})</p>
          </div>
        @endforeach
      </div>

      <a
        class="bg-indigo-600 px-4 py-2 leading-normal text-lg font-mono mt-2 inline-block rounded text-indigo-200 hover:bg-indigo-500"
        href="{{ route('checkout.process', $order)}}">
          Process payment
      </a>
    </div>
</div>

@endsection