@extends('layouts.app')
@section('content')
  <div class="flex items-center">
      <div class="md:w-1/2 md:mx-auto">
      <h2 class="text-2xl mb-6 text-gray-800">Orders</h2>

        @forelse ($orders as $order)
          <div class="flex break-words bg-white border border-2 rounded shadow-md p-4 items-center mb-2">
            <div class="mr-auto">
              <a href="{{ $order->path() }}" class="text-sm mb-2 font-mono text-gray-600 hover:text-indigo-600">{{ $order->order }}</a>
              <h4 class="text-2xl {{ $order->completed_at ? 'text-green-300' : '' }}">{{ $order->completed_at ? 'COMPLETED' : 'PENDING' }}</h4>
            </div>
            @if (! $order->completed_at)
            <a href="{{ route('checkout.process', $order)}}" class="font-mono text-indigo-700 text-2xl mr-4">PAY</a>
            @endif
          </div>

          @empty
            <h1 class="text-gray-400 text-lg text-gray-600 tracking-wide">😢 Your cart is empty</h1>
          @endforelse
      </div>
  </div>
@endsection