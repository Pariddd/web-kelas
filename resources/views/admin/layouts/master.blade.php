@include('admin.layouts.__header')
<body class="bg-[#0f172a] text-gray-200 flex h-screen min-h-screen antialiased">
    @include('admin.layouts.__sidebar')
      @yield('content')
      @yield('script')
</body>
</html>
