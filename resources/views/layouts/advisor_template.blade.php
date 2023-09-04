<!DOCTYPE html>
<html lang="en">

<head>
    @include('includes.tutor_head')
</head>

<body>
    @include('includes.advisor_menu')
    <div style="padding-top:60px">
        @yield('content')
    </div>
    @include('includes.foot')
</body>

</html>
