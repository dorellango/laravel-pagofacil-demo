@extends('layouts.app')
@section('content')
  <div class="flex items-center">
      <div class="md:w-1/2 md:mx-auto">
      <h2 class="text-2xl mb-6 text-gray-800">Orders</h2>

        @forelse ($orders as $order)
          <div class="flex break-words bg-white border border-2 rounded shadow-md p-4 items-center mb-2">
            <div class="mr-auto">
              <p class="text-sm mb-2 font-mono text-gray-600">{{ $order->order }}</p>
              <h4 class="text-2xl {{ $order->completed_at ? 'text-green-300' : '' }}">{{ $order->completed_at ? 'COMPLETED' : 'PENDING' }}</h4>
            </div>
            @if (! $order->completed_at)
            <a href="{{ route('checkout.process', $order)}}" class="font-mono text-indigo-700 text-2xl mr-4">PAY</a>
            @endif
          </div>

          @empty

          <h1 class="text-gray-400 text-lg text-gray-600 tracking-wide">😢 Your cart is empty</h1>

          @endforelse

          @if($orders->count() > 0)
            <a
              class="bg-indigo-600 px-4 py-2 leading-normal text-lg font-mono mt-2 inline-block rounded text-indigo-200 hover:bg-indigo-500"
              href="{{ route('checkout.process')}}"> Process payment</a>
          @endif
      </div>
  </div>
@endsection