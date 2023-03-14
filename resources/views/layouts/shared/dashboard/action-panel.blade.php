<div class="pd-20 row">
    <div class="col-sm-6">
        <h4 class="text-blue h4">@yield('title')</h4>
    </div>
    <div class="col-sm-6 text-sm-right">
        <button class="btn btn-danger btn-sm delete-selected" data-toggle="modal" data-target="#@yield('deleteModal')" style="display: none;">Delete Selection</button>
        @hasSection('actionText') 
        <a href="@yield('actionLink')" class="btn btn-primary btn-sm">@yield('actionText') @hasSection('actionIcon') @yield('actionIcon') @endif</a>
        @endif
    </div>
    {{-- <br class="d-md-none"> --}}
    
</div>