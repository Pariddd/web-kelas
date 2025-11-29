@include('members.layouts.__header')
<body class="bg-linear-to-br from-[#0F172A] to-[#1E293B] min-h-screen text-white">
   @include('members.layouts.__navbar')

   @yield('content')

   @include('members.layouts.__footer')

   <script src="{{ asset('assets/members/js/expanding-nav.js') }}"></script>
</body>
</html>