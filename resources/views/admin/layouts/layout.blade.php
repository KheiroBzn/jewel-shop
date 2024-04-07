@auth
        @if (auth()->user()->role === 0)
                @include('admin.partials.header')
                @include('admin.partials.nav')
                {{-------------------------------------------------------------------------------------}}
                {{-------------------------------------------------------------------------------------}}
                        @yield('content')
                {{-------------------------------------------------------------------------------------}}
                {{-------------------------------------------------------------------------------------}}
                @include('admin.partials.footer')
        @else
                <script>window.location = "{{ route('home.index') }}";</script>
        @endif
@endauth
@guest
        <script>window.location = "{{ route('home.index') }}";</script>
@endguest