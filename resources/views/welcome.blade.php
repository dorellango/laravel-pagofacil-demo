@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <div class="flex flex-wrap">
            @foreach ($products as $product)
                <div class="w-1/4 p-4">
                    <div class="bg-white shadow-lg rounded overflow-hidden">
                        <img class="opacity-75" src="{{ 'https://picsum.photos/id/' . $product->id .'/500/500/' }}" alt="{{ $product->name . '-thumb'}}">
                        <div class="p-4">
                            <h4 class="mb-4 text-xl font-bold">{{ $product->name }}</h4>
                            <p class="font-mono text-gray-600 text-lg">{{ '$' . $product->price }}</p>
                        </div>
                        <div class="p-4">
                            <a
                            class="px-3 py-2 bg-indigo-500 tracking-wide text-indigo-100 rounded font-bold text-center block hover:bg-indigo-300"
                            href="{{ route('cart.add', $product) }}">
                            {{ trans('add to cart') }}
                        </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
