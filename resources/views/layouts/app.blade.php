@include('layouts.header')
<div id="wrapper">
    @if (auth()->check())
        @include('layouts.siderbar')
    @endif
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @if (auth()->check())
                @include('layouts.navbar')
            @endif
            @yield('main-section')
        </div>
    </div>


</div>
@include('layouts.footer')
