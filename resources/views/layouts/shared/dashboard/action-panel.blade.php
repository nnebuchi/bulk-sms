<div class="pd-20 row">
    <div class="col-sm-6">
        <h4 class="text-blue h4">@yield('title')</h4>
    </div>
    <div class="col-sm-6 text-sm-right">
        @hasSection('actionText') 
        <a href="@yield('actionLink')" class="btn btn-primary btn-sm">@yield('actionText') @hasSection('actionIcon') @yield('actionIcon') @endif</a>
        @endif
    </div>
    {{-- <br class="d-md-none"> --}}
    
</div>