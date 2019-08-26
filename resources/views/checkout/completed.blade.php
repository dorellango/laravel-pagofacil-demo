@extends('layouts.app')
@section('content')

<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">
      <h2 class="text-2xl mb-6 text-gray-800">Order completed ✅</h2>
      <p class="text-gray-700">Your payment for order <span class="font-mono font-bold">{{ $order->order }}</span> was accepted.</p>
    </div>
</div>

@endsection