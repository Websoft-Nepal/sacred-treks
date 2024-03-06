@include('layouts.header')
<div id="wrapper">
    @include('layouts.siderbar')
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">
            @include('layouts.navbar')
            @yield('main-section')
        </div>
    </div>


</div>
@include('layouts.footer')
