@extends('app')

@section('title', 'الفيديوهات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

@endsection



<div class="create-movie card m-4">

    @if ($errors->any())
        <div class="col-12">
            @foreach ($errors->all() as $error)
                <h4 class="textsucc">{{ $error }}</h4>
            @endforeach
        </div>

    @endif




    <div class="importdata">



        <div class="meddle">
            <div class="container-movies-2">
                <main>

                    <form id="addnewtvform" enctype="multipart/form-data" onsubmit="addnewvideo(event)" method="POST">
                        @csrf

                        <div class="all-movies">


                            <section class="movie-section">


                                <div class="king-info">

                                    <div class="fetch">
                                        <div class="Movie-Info">
                                            <h3>({{ $tv->title }}) إضافة فيديو للفيلم</h3>
                                            <hr>


                                            <div class="mt-3">
                                            <h6>العنوان</h6>


                                            <select name="title">

                                               
                                                <option value="مترجم" selected="">مترجم </option>
                                                <option value="مدبلج">مدبلج </option>

                                            </select>

                                        </div>

                                        </div>
                                        <div class="mt-3">
                                            <h6>المصدر</h6>


                                            <select name="source">

                                               <option value="Youtube">Youtube</option>
                                                <option value="JCARTOON" selected="">سيرفر جي كرتون</option>
                                                <option value="vidpro">Vidpro</option>
                                                <option value="Streamwish">Streamwish</option>
                                                <option value="Mkv">Mkv From Url</option>
                                                <option value="M3u8">M3u8 From Url</option>
                                                <option value="Dash">Dash From Url</option>
                                                <option value="Embed">Embed Url</option>
                                                <option value="Dailymotion">Dailymotion</option>
                                                <option value="DoodStream">DoodStream</option>
                                                <option value="Dropbox">Dropbox</option>
                                                <option value="Fembed">Fembed</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="GogoAnime">GogoAnime</option>
                                                <option value="GoogleDrive">GoogleDrive</option>
                                                <option value="MediaShore">MediaShore</option>
                                                <option value="MixDrop">MixDrop</option>
                                                <option value="Onedrive">Onedrive</option>
                                                <option value="OKru">OK.ru</option>
                                                <option value="StreamTape">StreamTape</option>
                                                <option value="StreamSB">StreamSB</option>
                                                <option value="Streamhide">Streamhide</option>
                                                <option value="Twitter">Twitter</option>
                                                <option value="Voesx">Voesx</option>
                                                <option value="VK">VK</option>
                                                <option value="Voot">Voot</option>
                                                <option value="Vudeo">vudeo</option>
                                                <option value="Vimeo">Vimeo</option>
                                                <option value="Yandex">Yandex</option>
                                                <option value="Torrent">Torrent</option>
                                                

                                            </select>

                                        </div>

                                        <div class="mt-3">
                                            <h6>رابط الحلقة المترجمة</h6>

                                            <input required type="text" name="url" class="record-tmdb_id"
                                                value="{{ old('url') }}">

                                        </div>



                                        <div class="mt-3">
                                            <h6>رسالة تنبيهية</h6>

                                            <input  placeholder="ضع شي بسيط متل الحلقة فيها بعض الشدود أو الحلقة بها مخدرات" type="text" name="message" class="record-tmdb_id"
                                                value="{{ old('message') }}">

                                        </div>

                                        <div>
                                            <h6>الحالة</h6>


                                            <select name="status">

                                                @foreach (json_decode('{"Published":"يظهر في التطبيق","Unpublished":"لا يظهر في التطبيق"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">إضافة الفيديو</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>
                            
                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>المترجم</th>
                                            <th>المصدر</th>
                                            <th>الرسالة</th>
                                            <th>إعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($video as $item)
                                            <tr>
                                                <td ><div class="urldialvideo">{{ $item['url'] }}</div></td>
                                                <td class="warning">{{ $item['source'] }}</td>
                                                <td class="warning">{{ $item['message'] }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                    href="/movie/videos/edit/{{ $item['id'] }}">تعديل</a>
                                                            </li>
                                                            <li><a
                                                                href="/tv/season/videos/servers/{{ $item['id'] }}">السيرفرات</a>
                                                        </li>
                                                            <li>

                                                                    <div class="deletvid">
                                                                        <a onclick="Deletvid(event,{{ $item['id'] }})"
                                                                            >حدف</a>
                                                                    </div>




                                                            </li>
                                                        </ul>
                                                    </div>
                                                </td>


                                            </tr>
                                        @endforeach

                                    </tbody>

                                </table>


                            </div>


                            </section>





            </div>



            </main>


        </div>
    </div>



</div>








</div>




<script>
    function addnewvideo(e) {
        e.preventDefault();


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('postvideo', $tv->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة الفيديو",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/movie/videos/' + "{{ $tv->id }}");
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr);
                swal({
    title: "هناك خطأ",
    text: errr.responseJSON.message,
    icon: "warning",
    buttons: false,
    dangerMode: true,
})
            }
        });

    }

    function Deletvid(e, id) {
        e.preventDefault();


        console.log(id);

        swal({
                title: "هل انت متأكد",
                text: "ستتمكن من حدف الفيديو إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
            type: "GET",
            url: "/movie/videos/delet/"+id,
            processData: false,
            contentType: false,
            success: function(response) {


                swal("تم الحدف بنجاح", {
                        icon: "success",
                    });

                setTimeout(() => {
                    window.location.reload();
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr);

            }
        });





                } else {
                    swal("تم إلغاء الحدف");
                }
            });



    }


    const allMenu = document.querySelectorAll('.menu');

    allMenu.forEach(item => {
        const icon = item.querySelector('.icon');
        const menuLink = item.querySelector('.menu-link');

        icon.addEventListener('click', function() {
            menuLink.classList.toggle('show');
        })
    })



    window.addEventListener('click', function(e) {


        allMenu.forEach(item => {
            const icon = item.querySelector('.icon');
            const menuLink = item.querySelector('.menu-link');

            if (e.target !== icon) {
                if (e.target !== menuLink) {
                    if (menuLink.classList.contains('show')) {
                        menuLink.classList.remove('show')
                    }
                }
            }
        })
    })

    $(document).ready(function() {
        $('#tvt').DataTable({
            searching: false,
            paging: false,
            info: false
        });



    });
</script>




@endsection
