<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title')</title>
    <link rel="icon" type="image/svg+xml" href="{{asset('rebirth/assets/icons/favicon.png')}}" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap"
      rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('rebirth/assets/fontawesome/css/all.min.css')}}" />
    <link rel="stylesheet" href="{{asset('rebirth/assets/fontawesome/css/all.css')}}" />
    <link rel="stylesheet" href="{{asset('rebirth/src/output.css')}}" />
    
	  <link rel="stylesheet" type="text/css" href="{{ asset('dashboard/src/plugins/sweetalert2/sweetalert2.css')}}">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="{{asset('rebirth/src/dashboard.js')}}" defer></script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-119386393-1');
    </script>
    <script>
      @if(isset($filePath))
        var file_name = "{{$filePath}}";
      @endif
      @isset($slug)
        var slug = "{{$slug}}";
      @endisset
      @if(isset($contact))
        var contact = <?=json_encode($contact)?>;
      @endif
        var url = "{{ url('/') }}";
        var universal_token = "{{ csrf_token() }}"
      </script>
  </head>
  <body class="bg-gray-100 antialiased flex text-skz-200 h-screen">
    @include('layouts.dashboard.rebirth.sidebar')

    <div class="flex-1 flex flex-col overflow-hidden">
      @include('layouts.dashboard.rebirth.navbar')

      <main class="flex-1 mobilemd:p-6 p-5 overflow-y-auto">
        @include('layouts.shared.rebirth.alert')
        @yield('content')
      </main>
    </div>
    <script src="{{ asset('dashboard/src/plugins/sweetalert2/sweet-alert.init.js')}}"></script> 
	  <script src="{{ asset('dashboard/src/plugins/sweetalert2/sweetalert2.all.js')}}"></script> 
    
  </body>
</html>
