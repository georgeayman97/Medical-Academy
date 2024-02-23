<!DOCTYPE html>
<html lang="en">

<head>

    <!-- META ============================================= -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content=""/>
    <meta name="author" content=""/>
    <meta name="robots" content=""/>

    <!-- DESCRIPTION -->
    <meta name="description" content="EduChamp : Education HTML Template"/>

    <!-- OG -->
    <meta property="og:title" content="EduChamp : Education HTML Template"/>
    <meta property="og:description" content="EduChamp : Education HTML Template"/>
    <meta property="og:image" content=""/>
    <meta name="format-detection" content="telephone=no">

    <!-- FAVICONS ICON ============================================= -->
    <link rel="icon" href="../error-404.html" type="image/x-icon"/>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/admin/images/favicon.png') }}"/>

    <!-- PAGE TITLE HERE ============================================= -->
    <title> Medical Academy </title>

    <!-- MOBILE SPECIFIC ============================================= -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--[if lt IE 9]>
    <script src="assets/js/html5shiv.min.js"></script>
    <script src="assets/js/respond.min.js"></script>
    <![endif]-->

    <!-- All PLUGINS CSS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/assets.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/calendar/fullcalendar.css') }}">

    <!-- TYPOGRAPHY ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/typography.css') }}">

    <!-- SHORTCODES ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/shortcodes/shortcodes.css') }}">

    <!-- STYLESHEETS ============================================= -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/dashboard.css') }}">
    <link class="skin" rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/color/color-1.css') }}">


    <!-- CSS
============================================ -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/vendor/bootstrap.min.css') }}">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/vendor/font-awesome.css') }}">
    <!-- Fontawesome Star -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/vendor/fontawesome-stars.css') }}">
    <!-- Ion Icon -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/vendor/ion-fonts.css') }}">
    <!-- Slick CSS -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/plugins/slick.css') }}">
    <!-- Animation -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/plugins/animate.css') }}">
    <!-- jQuery Ui -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/plugins/jquery-ui.min.css') }}">
    <!-- Lightgallery -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/plugins/lightgallery.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/plugins/nice-select.css') }}">

    <!-- Vendor & Plugins CSS (Please remove the comment from below vendor.min.css & plugins.min.css for better website load performance and remove css files from the above) -->
    <!--
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>
    -->

    <!-- Main Style CSS (Please use minify version for better website load performance) -->
    <link rel="stylesheet" href="{{ asset('assets/admin/products_filter/css/style.css') }}">
    <!--<link rel="stylesheet" href="assets/css/style.min.css">-->


</head>
<body class="ttr-closed-sidebar ttr-pinned-sidebar">
<input type="hidden" name="url" value="Made by Eng.George Ayman & Eng.Zakaria Hamdan">
<!-- header start -->
<header class="ttr-header">
    <div class="ttr-header-wrapper">
        <!--sidebar menu toggler start -->
        <div class="ttr-toggle-sidebar ttr-material-button d-lg-none d-xl-none">
            <i class="ti-close ttr-open-icon"></i>
            <i class="ti-menu ttr-close-icon"></i>
        </div>
        <!--sidebar menu toggler end -->
        <!--logo start -->
        <div class="ttr-logo-box">
            <div>
                <a href="{{ route('dashboard.index') }}" class="ttr-logo">
                    <img class="ttr-logo-mobile" alt="" src="{{ asset('assets/home/images/7.png') }}" width="30"
                         height="30">
                    <img class="ttr-logo-desktop" alt="" src="{{ asset('assets/home/images/7.png') }}" width="160"
                         height="27">
                </a>
            </div>
        </div>
        <!--logo end -->
        <div class="ttr-header-menu">
            <!-- header left menu start -->
            <ul class="ttr-header-navigation">
                <li>
                    <a href="{{ route('dashboard.index') }}" class="ttr-material-button ttr-submenu-toggle">HOME</a>
                </li>
                @if(auth()->user()->role == 'admin')
                    <li class="ttr-hide-on-mobile">
                        <a href="javascript:;" class="ttr-material-button ttr-submenu-toggle">Faculty <i
                                class="fa fa-angle-down"></i></a>
                        <div class="ttr-header-submenu">
                            <ul class="sub-menu">
                                <li><a href="{{ route('faculty.index') }}">All Faculties</a></li>
                                <li><a href="{{ route('faculty.create') }}">Add Faculty</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="ttr-hide-on-mobile">
                        <a href="javascript:;" class="ttr-material-button ttr-submenu-toggle">SUBJECTS <i
                                class="fa fa-angle-down"></i></a>
                        <div class="ttr-header-submenu">
                            <ul class="sub-menu">
                                <li><a href="{{ route('subjects.index') }}">All Subjects</a></li>
                                <li><a href="{{ route('subjects.create') }}">Add Subject</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
                <li class="ttr-hide-on-mobile">
                    <a href="javascript:;" class="ttr-material-button ttr-submenu-toggle">COURSES <i
                            class="fa fa-angle-down"></i></a>
                    <div class="ttr-header-submenu">
                        <ul class="sub-menu">
                            <li><a href="{{ route('courses.index') }}">All Courses</a></li>
                            @if(auth()->user()->role == 'admin')
                                <li><a href="{{ route('courses.create') }}">Add Course</a></li>
                            @endif
                            <li><a href="{{ route('courses.disabled') }}">Courses Disabled</a></li>
                            <li><a href="{{ route('courses.active') }}">Courses Active</a></li>
                            <li><a href="{{ route('courseaccess.requests') }}">Courses Requests</a></li>
                        </ul>
                    </div>
                </li>
                <li class="ttr-hide-on-mobile">
                    <a href="#" class="ttr-material-button ttr-submenu-toggle">STUDENTS <i class="fa fa-angle-down"></i></a>
                    <div class="ttr-header-submenu">
                        <ul>
                            <li><a href="{{ route('accounts.index') }}">All Students</a></li>
                            @if(auth()->user()->role == 'admin')
                                <li><a href="{{ route('register') }}">add Student</a></li>
                            @endif
                            <li><a href="{{ route('accounts.active') }}">Students Active</a></li>
                            <li><a href="{{ route('req.index') }}">Students Requests</a></li>
                            <li><a href="{{ route('accounts.deleted') }}">Students Deleted</a></li>
                            <li><a href="{{ route('forget.pass') }}">Student Forget Password Requests</a></li>
                        </ul>
                    </div>
                </li>
                @if(auth()->user()->role == 'admin')
                    <li class="ttr-hide-on-mobile">
                        <a href="#" class="ttr-material-button ttr-submenu-toggle">DOCTORS <i
                                class="fa fa-angle-down"></i></a>
                        <div class="ttr-header-submenu">
                            <ul>
                                <li><a href="{{ route('doctors.index') }}">All Doctors</a></li>
                                <li><a href="{{ route('register-doctor') }}">Add Doctor</a></li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('admin.add') }}" class="ttr-material-button ttr-submenu-toggle">Add Admin</a>
                    </li>
                    <li>
                        <a href="{{ route('receptionist.add') }}" class="ttr-material-button ttr-submenu-toggle">Add
                            Receptionist</a>
                    </li>
                @endif
            </ul>
            <!-- header left menu end -->
        </div>
        <div class="ttr-header-right ttr-with-seperator">
            <!-- header right menu start -->
            <ul class="ttr-header-navigation">
                <li>
                    <a href="#" class="ttr-material-button ttr-search-toggle"><i class="fa fa-search"></i></a>
                </li>
                <li>
                    <a href="#" class="ttr-material-button ttr-submenu-toggle">
                        {{ Auth::user()->name; }}
                    </a>
                    <div class="ttr-header-submenu">
                        <ul>
                            <li><a href="user-profile.html">My profile</a></li>
                            <!-- <li><a href="list-view-calendar.html">Activity</a></li>
                            <li><a href="mailbox.html">Messages</a></li> -->
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')"
                                                     onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </li>

                        </ul>
                    </div>
                </li>
            </ul>
            <!-- header right menu end -->
        </div>
        <!--header search panel start -->
        <div class="ttr-search-bar">
            <form class="ttr-search-form" action="{{ route('search') }}">
                <div class="ttr-search-input-wrapper">
                    <input type="text" name="search" placeholder="search with Student or Doctor name or Course name"
                           class="ttr-search-input">
                    <button type="submit" class="ttr-search-submit"><i class="ti-arrow-right"></i></button>
                </div>
                <span class="ttr-search-close ttr-search-toggle">
						<i class="ti-close"></i>
					</span>
            </form>
        </div>
        <!--header search panel end -->
    </div>
</header>
<!-- header end -->
<!-- Left sidebar menu start -->
<div class="ttr-sidebar d-lg-none d-xl-none">
    <div class="ttr-sidebar-wrapper content-scroll">
        <!-- side menu logo start -->
        <div class="ttr-sidebar-logo">
            <!-- <a href="#"><img alt="" src="{{ asset('assets/home/images/7.png') }}" width="122" height="27"></a> -->
            <!-- <div class="ttr-sidebar-pin-button" title="Pin/Unpin Menu">
                <i class="material-icons ttr-fixed-icon">gps_fixed</i>
                <i class="material-icons ttr-not-fixed-icon">gps_not_fixed</i>
            </div> -->
            <div class="ttr-sidebar-toggle-button">
                <i class="ti-arrow-left"></i>
            </div>
        </div>
        <!-- side menu logo end -->
        <!-- sidebar menu start -->
        <nav class="ttr-sidebar-navi">
            <ul>
                <li>
                    <a href="{{ route('dashboard.index') }}" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-home"></i></span>
                        <span class="ttr-label">Dashborad</span>
                    </a>
                </li>
                @if(auth()->user()->role == 'admin')
                    <li>
                        <a href="#" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-id-badge"></i></span>
                            <span class="ttr-label">Faculty</span>
                            <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('faculty.index') }}" class="ttr-material-button"><span
                                        class="ttr-label">All Faculties</span></a>
                            </li>
                            <li>
                                <a href="{{ route('faculty.create') }}" class="ttr-material-button"><span
                                        class="ttr-label">Add Faculty</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-id-badge"></i></span>
                            <span class="ttr-label">SUBJECTS</span>
                            <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('subjects.index') }}" class="ttr-material-button"><span
                                        class="ttr-label">All Subjects</span></a>
                            </li>
                            <li>
                                <a href="{{ route('subjects.create') }}" class="ttr-material-button"><span
                                        class="ttr-label">Add Subject</span></a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-id-badge"></i></span>
                        <span class="ttr-label">COURSES</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('courses.index') }}" class="ttr-material-button"><span class="ttr-label">All Courses</span></a>
                        </li>
                        @if(auth()->user()->role == 'admin')
                            <li>
                                <a href="{{ route('courses.create') }}" class="ttr-material-button"><span
                                        class="ttr-label">Add Course</span></a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('courses.active') }}" class="ttr-material-button"><span class="ttr-label">Courses Active</span></a>
                        </li>
                        <li>
                            <a href="{{ route('courses.disabled') }}" class="ttr-material-button"><span class="ttr-label">Courses Disabled</span></a>
                        </li>
                        <li>
                            <a href="{{ route('courseaccess.requests') }}" class="ttr-material-button"><span
                                    class="ttr-label">Courses Requests</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="ttr-material-button">
                        <span class="ttr-icon"><i class="ti-id-badge"></i></span>
                        <span class="ttr-label">STUDENTS</span>
                        <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('accounts.index') }}" class="ttr-material-button"><span class="ttr-label">All Students</span></a>
                        </li>
                        @if(auth()->user()->role == 'admin')
                            <li>
                                <a href="{{ route('register') }}" class="ttr-material-button"><span
                                        class="ttr-label">Add Student</span></a>
                            </li>
                        @endif
                        <li>
                            <a href="{{ route('accounts.active') }}" class="ttr-material-button"><span class="ttr-label">Students Active</span></a>
                        </li>
                        <li>
                            <a href="{{ route('req.index') }}" class="ttr-material-button"><span
                                    class="ttr-label">Students Requests</span></a>
                        </li>
                        <li>
                            <a href="{{ route('accounts.deleted') }}" class="ttr-material-button"><span class="ttr-label">Students Deleted</span></a>
                        </li>
                        <li>
                            <a href="{{ route('forget.pass') }}" class="ttr-material-button"><span class="ttr-label">Student Forget Password Requests</span></a>
                        </li>
                    </ul>
                </li>
                @if(auth()->user()->role == 'admin')
                    <li>
                        <a href="#" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-id-badge"></i></span>
                            <span class="ttr-label">DOCTORS</span>
                            <span class="ttr-arrow-icon"><i class="fa fa-angle-down"></i></span>
                        </a>
                        <ul>
                            <li>
                                <a href="{{ route('doctors.index') }}" class="ttr-material-button"><span
                                        class="ttr-label">All Doctors</span></a>
                            </li>
                            <li>
                                <a href="{{ route('register-doctor') }}" class="ttr-material-button"><span
                                        class="ttr-label">Add Doctor</span></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.add') }}" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-user"></i></span>
                            <span class="ttr-label">Add Admin</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('receptionist.add') }}" class="ttr-material-button">
                            <span class="ttr-icon"><i class="ti-user"></i></span>
                            <span class="ttr-label">Add Receptionist</span>
                        </a>
                    </li>
                @endif
                <li class="ttr-seperate"></li>
            </ul>
            <!-- sidebar menu end -->
        </nav>
        <!-- sidebar menu end -->
    </div>
</div>
<!-- Left sidebar menu end -->

<!--Main container start -->
<main class="ttr-wrapper">
    <div class="container-fluid">
        @yield('content')


    </div>
</main>

<div class="ttr-overlay"></div>

<!-- External JavaScripts -->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/bootstrap-touchspin/jquery.bootstrap-touchspin.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/magnific-popup/magnific-popup.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/counter/waypoints-min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/counter/counterup.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/imagesloaded/imagesloaded.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/masonry/masonry.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/masonry/filter.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/scroll/scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/functions.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/chart/chart.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/admin.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/calendar/moment.min.js') }}"></script>
<script src="{{ asset('assets/admin/vendors/calendar/fullcalendar.js') }}"></script>
<!-- <script src="{{ asset('assets/admin/vendors/switcher/switcher.js') }}"></script> -->
<!-- <script>
  $(document).ready(function() {

    $('#calendar').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay,listWeek'
      },
      defaultDate: '2019-03-12',
      navLinks: true, // can click day/week names to navigate views

      weekNumbers: true,
      weekNumbersWithinDays: true,
      weekNumberCalculation: 'ISO',

      editable: true,
      eventLimit: true, // allow "more" link when too many events
      events: [
        {
          title: 'All Day Event',
          start: '2019-03-01'
        },
        {
          title: 'Long Event',
          start: '2019-03-07',
          end: '2019-03-10'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-09T16:00:00'
        },
        {
          id: 999,
          title: 'Repeating Event',
          start: '2019-03-16T16:00:00'
        },
        {
          title: 'Conference',
          start: '2019-03-11',
          end: '2019-03-13'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T10:30:00',
          end: '2019-03-12T12:30:00'
        },
        {
          title: 'Lunch',
          start: '2019-03-12T12:00:00'
        },
        {
          title: 'Meeting',
          start: '2019-03-12T14:30:00'
        },
        {
          title: 'Happy Hour',
          start: '2019-03-12T17:30:00'
        },
        {
          title: 'Dinner',
          start: '2019-03-12T20:00:00'
        },
        {
          title: 'Birthday Party',
          start: '2019-03-13T07:00:00'
        },
        {
          title: 'Click for Google',
          url: 'http://google.com/',
          start: '2019-03-28'
        }
      ]
    });

  });

</script> -->
<!-- <footer class="mt-auto py-3 text-center text-bottom">
				<i class="fa fa-code"></i> with <i class="fa fa-heart"></i> by
				<a class="badge badge-dark" rel="noopener" href="https://georgeayman97.github.io/portofolio/" aria-label="My GitHub">
					George Ayman</a> &copy; {{date("Y")}}</i>
</footer> -->


</body>


</html>
