@extends('app')

@section('title', 'تعديل الحلقة')

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
                                            <h3>({{ $episodes->lebel }})تعديل الحلقة رقم</h3>

                                            <hr>
                                            <div>
                                                <h6>رقم الحلقة</h6>


                                                <input required type="number" name="name" class="record-tmdb_id"
                                                    value="{{ $episodes->lebel }}">

                                            </div>



                                        </div>
                                        <div class="mt-3">
                                            <h6>المصدر</h6>


                                            <select name="source">
                                                    <option value="Youtube">Youtube</option>
                                                <option value="JCARTOON" selected="">سيرفر جي كرتون</option>
                                                <option value="Streamwish">Streamwish</option>
                                                <option value="vidpro">Vidpro</option>
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
                                                value="{{ $episodes->url }}">

                                        </div>

                                        <div class="mt-3">
                                            <h6>رابط الحلقة المدبلجة</h6>

                                            <input type="text" name="url_modablaj" class="record-tmdb_id"
                                                value="{{ $episodes->url_modablaj }}">

                                        </div>

                                        <div class="mt-3">
                                            <h6>رسالة تنبيهية</h6>

                                            <input type="text" name="message" class="record-tmdb_id"
                                                value="{{ $episodes->message }}">

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



                                        <div class="mt-4">
                                            <h6>هل هناك مقدمة ؟</h6>


                                            <select name="skipablle" id="skipp">

                                                @foreach (json_decode('{"0":"ليست هناك","1":"هناك مقدمة , ضع وقتها"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="mt-3">

                                            <h6 class="control-label">المقدمة تبدأ
                                                في</h6>

                                            <input value="{{ $episodes->intro_start }}" type="text"
                                                id="edit_modal_intro_start" name="intro_start"
                                                class="form-control datetimepicker-input" data-provide="datepicker"
                                                data-target="#edit_modal_intro_start" placeholder="HH:MM:SS" />
                                        </div>

                                        <div class="mt-3">

                                            <h6 class="control-label">االمقدمة تنتهي
                                                في</h6>

                                            <input value="{{ $episodes->intro_end }}" type="text"
                                                id="edit_modal_intro_end" class="form-control datetimepicker-input"
                                                name="intro_end" data-target="#edit_modal_intro_end"
                                                placeholder="HH:MM:SS" />
                                        </div>





                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">تعديل الحلقة</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

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


        var e = document.getElementById("skipp");

        //   Add add an EventListener and check the value in the target node...
        e.addEventListener("change", function(event) {
            console.log(event.target.value);
        });


        $.ajax({
            type: "POST",
            url: "/tv/season/videos/edit/{{ $episodes->id }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {

                console.log(response);
                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل الحلقة",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/tv/seasons/videos/' + "{{ $seasons->id }}");
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

    $(function() {

        $('#edit_modal_intro_start').datetimepicker({
            format: 'HH:mm:ss',
            allowInputToggle: true
        });
        $('#edit_modal_intro_end').datetimepicker({
            format: 'HH:mm:ss',
            allowInputToggle: true
        });
    });


    $(document).ready(function() {
        $('#tvt').DataTable({
            searching: false,
            paging: false,
            info: false
        });



    });
</script>




@endsection
