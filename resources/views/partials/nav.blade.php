<nav class="bg-blue-900 shadow mb-8 py-6">
  <div class="container mx-auto px-6 md:px-0">
      <div class="flex items-center justify-center">
          <div class="ml-6">
              <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                  {{ config('app.name', 'Laravel') }}
              </a>
          </div>
          <div class="flex-1 text-right">
                <a href="{{ url('/') }}" class="no-underline hover:underline text-gray-300 text-sm p-3 mr-3 border-r-2 border-indigo-500">
                    Tienda
                </a>
              @guest
                  <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                  @if (Route::has('register'))
                      <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                  @endif
              @else
                  <span class="text-gray-300 text-sm pr-4">{{ Auth::user()->name }}</span>

                  <a href="{{ route('orders.index') }}"
                     class="no-underline hover:underline text-gray-300 text-sm p-3">{{ __('Orders') }}</a>
`
                  <a href="{{ route('logout') }}"
                     class="no-underline hover:underline text-gray-300 text-sm p-3"
                     onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                      {{ csrf_field() }}
                  </form>
              @endguest
                <a class="no-underline text-gray-300 text-sm p-3" href="{{ route('cart.show') }}">
                  {{ __('Cart') }}
                  <span class="ml-2 bg-indigo-500 text-indigo-100 px-2 py-1 text-sm rounded-full leading-normal font-mono">
                    {{ $cartCount }}
                  </span>
                </a>
          </div>
      </div>
  </div>
</nav>