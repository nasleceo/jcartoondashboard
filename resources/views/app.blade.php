<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.13.0/moment.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('assets/home/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/home/css/datatable.css') }}">

    @yield('scripte')

    <script src="https://code.jquery.com/jquery-3.1.1.min.js">
        // < script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.10.0/js/bootstrap-datepicker.min.js" >




        <
        script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js" >
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <script
        src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js">
    </script>



    <title>@yield('title')</title>
</head>

<body>

    <!-- SIDEBAR -->
    <section id="sidebar" class="hide">
        <a href="#" class="brand"><i class='bx bxs-smile icon'></i> جي كرتون</a>
        <ul class="side-menu">
            
            
            
             <div id="cartoon">
            <li><a href="{{ route('dash') }}" class="{{ request()->is('/') ? 'active' : '' }}"><i
                        class='bx bxs-dashboard icon'></i> لوحة التحكم</a></li>

            <li class="divider" data-text="كرتون">كرتون</li>
            <li><a href="{{ route('movie') }}" class="{{ request()->is('movie*') ? 'active' : '' }}"><i
                        class='bx bxs-movie icon'></i> الأفلام</a></li>
            <li><a href="{{ route('tv') }}" class="{{ request()->is('tv*') ? 'active' : '' }}"><i
                        class='bx bxs-tv icon'></i> المسلسلات</a></li>
            <li><a href="{{ route('reportcartoon') }}" class="{{ request()->is('reportcartoon*') ? 'active' : '' }}"><i
                        class='bx bx-error-circle icon'></i> البلاغات</a></li>
            
            <li><a href="{{ route('showcast') }}" class="{{ request()->is('casts*') ? 'active' : '' }}"><i
                            class='bx bxs-group icon'></i> الشخصيات</a></li>
             </div>
            <div id="comics">

                <li class="divider" data-text="كوميكس">كوميكس</li>
                <li><a href="{{ route('comic') }}" class="{{ request()->is('comic*') ? 'active' : '' }}"><i
                            class='bx bxs-book icon'></i> الكوميكس</a></li>
                <li><a href="{{ route('reportcomics') }}"
                        class="{{ request()->is('reportcomics*') ? 'active' : '' }}"><i
                            class='bx bx-error-circle icon'></i> البلاغات</a></li>


            </div>

            <div id="mojtamaa">

                <li class="divider" style="display=none" data-text="مجتمع">مجتمع</li>
                <li><a href="{{ route('mowajaha') }}" class="{{ request()->is('mowajaha*') ? 'active' : '' }}"><i
                            class='bx bx-run icon'></i> المواجهات</a></li>
                <li><a href="{{ route('rates') }}" class="{{ request()->is('rates*') ? 'active' : '' }}"><i
                            class='bx bxs-user-voice icon'></i> التقيمات</a></li>
                <li><a href="{{ route('tawsiat') }}" class="{{ request()->is('tawsiat*') ? 'active' : '' }}"><i
                            class='bx bxs-extension icon'></i> التوصية</a></li>
                <li><a href="{{ route('showcast') }}" class="{{ request()->is('casts*') ? 'active' : '' }}"><i
                            class='bx bxs-group icon'></i> الشخصيات</a></li>
                <li><a href="{{ route('comments') }}" class="{{ request()->is('comments*') ? 'active' : '' }}"><i
                            class='bx bxs-message icon'></i> التعليقات</a></li>
                <li><a href="{{ route('posts') }}" class="{{ request()->is('posts*') ? 'active' : '' }}"><i
                            class='bx bxs-conversation icon'></i> المنشورات</a></li>
                <li><a href="{{ route('reviews') }}" class="{{ request()->is('reviews*') ? 'active' : '' }}"><i
                            class='bx bxs-star icon'></i> المراجعات</a></li>
                <li><a href="{{ route('nadariat') }}" class="{{ request()->is('nadariat*') ? 'active' : '' }}"><i
                            class='bx bxs-blanket icon'></i> النظريات</a></li>
                            <li><a href="{{ route('roomcartoon') }}" class="{{ request()->is('roomcartoon*') ? 'active' : '' }}"><i
                        class='bx bxs-message-square-dots icon'></i> الغراف</a></li>
                <li><a href="{{ route('news') }}" class="{{ request()->is('news*') ? 'active' : '' }}"><i
                            class='bx bxs-news icon'></i> الأخبار</a></li>
                <li><a href="{{ route('reportmojama') }}"
                        class="{{ request()->is('reportmojama*') ? 'active' : '' }}"><i
                            class='bx bx-error-circle icon'></i> البلاغات</a></li>


            </div>

            <div id="sittings">

                <li class="divider" data-text="الإشتراك">الإشتراك</li>
                <li><a href="#"><i class='bx bxs-book icon'></i>المشتركون</a></li>
                <li><a href="#"><i class='bx bxs-cog icon'></i>خطة الإشتراك</a></li>

                <li class="divider" data-text="الإعلانات">الإعلانات</li>
                <li><a href="{{ route('adsview') }}" class="{{ request()->is('adsshow*') ? 'active' : '' }}"><i
                            class='bx bxs-cog icon'></i>إعدادات الإعلانات</a></li>
                <li><a href="{{ route('jcartoonads') }}"
                        class="{{ request()->is('jcartoonads*') ? 'active' : '' }}"><i
                            class='bx bxs-cog icon'></i>مركز
                        الإعلانات</a></li>
                <li><a href="{{ route('jcartoonadsadvert') }}"
                        class="{{ request()->is('jcartoonadsadvert*') ? 'active' : '' }}"><i
                            class='bx bxs-cog icon'></i>المعلينين</a></li>

                <li class="divider" data-text="حسابي">حسابي</li>
                <li><a href="{{ route('users') }}" class="{{ request()->is('users*') ? 'active' : '' }}"><i
                            class='bx bxs-book icon'></i> المستخدمين</a></li>
                <li><a href="{{ route('appupdate') }}" class="{{ request()->is('appupdate*') ? 'active' : '' }}"><i
                            class='bx bxs-cloud-download icon'></i> تحديث التطبيق</a></li>
                <li><a href="{{ route('urlandapi') }}" class="{{ request()->is('urlandapi*') ? 'active' : '' }}"><i
                            class='bx bxs-cog icon'></i> الإعدادات</a></li>
                <li><a href="{{ route('skipg') }}" class="{{ request()->is('skipgoogle*') ? 'active' : '' }}"><i
                            class='bx bxs-ghost icon'></i> تخطي جوجل</a></li>
                <li><a href="{{ route('notification') }}"
                        class="{{ request()->is('notification*') ? 'active' : '' }}"><i
                            class='bx bxs-bell-ring icon'></i> الإشعارات</a></li>

            </div>
        </ul>
        {{-- <div class="ads">
			<div class="wrapper">
				<a href="#" class="btn-upgrade">Upgrade</a>
				<p>Become a <span>PRO</span> member and enjoy <span>All Features</span></p>
			</div>
		</div> --}}
    </section>
    <!-- SIDEBAR -->

    <!-- NAVBAR -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu toggle-sidebar'></i>
            <form action="#">
                <div hidden class="form-group">
                    <input type="text" placeholder="....البحث">
                    <i class='bx bx-search icon'></i>
                </div>
            </form>

            <span class="divider"></span>
            <div class="profile">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60"
                    alt="">
                <ul class="profile-link">
                    <li><a href="#"><i class='bx bxs-user-circle icon'></i> حسابي</a></li>
                    <li><a href="#"><i class='bx bxs-cog'></i> الإعدادت</a></li>
                    <li><a href="/logout"><i class='bx bxs-log-out-circle'></i> تسجيل الخروج</a></li>
                </ul>
            </div>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        @yield('contant')

        <!-- MAIN -->
    </section>
    <!-- NAVBAR -->

    {{-- <script src="//cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script src="{{ asset('assets/home/js/app.js') }}"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        var y = document.getElementById('sittings');
        var x = document.getElementById('mojtamaa');
        var c = document.getElementById('comics');
        var a = document.getElementById('cartoon');

        if ({{ session()->get('loginId') == 1 }}) {
            x.style.display = 'none';
            y.style.display = 'none';
        }
         
        
        
    </script>

</body>

</html>
