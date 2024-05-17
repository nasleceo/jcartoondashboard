@extends('app')

@section('title', 'الحلقات')

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
                                            <h3>({{ $seasons->name }})إضافة حلقات ل</h3>

                                            <hr>
                                            <div>
                                                <h6>رقم الحلقة</h6>


                                                <input required type="number" name="name" class="record-tmdb_id"
                                                    value="{{ old('name') }}">

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




                                        {{-- <div class="mt-3">
                                            <h6>رابط الحلقة المدبلجة</h6>

                                            <input required type="text" name="url_modablaj" class="record-tmdb_id">

                                        </div> --}}

                                        <div class="mt-3">
                                            <h6>رسالة تنبيهية</h6>

                                            <input required type="text" name="message" class="record-tmdb_id">

                                        </div>
                                        {{-- <div class="mt-3">
                                            <h6>إرفع الحلقة بدون رابط</h6>

                                            <input  type="file" name="video"
                                                class="record-tmdb_id pb-2  pt-2" value="{{ old('video') }}">


                                        </div> --}}

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


                                            <select name="skipablle">

                                                @foreach (json_decode('{"0":"ليست هناك","1":"هناك مقدمة , ضع وقتها"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                        <div class="mt-3">

                                            <h6 class="control-label">المقدمة تبدأ
                                                في</h6>

                                            <input type="text" id="edit_modal_intro_start" name="intro_start"
                                                class="form-control datetimepicker-input" data-provide="datepicker"
                                                data-target="#edit_modal_intro_start" placeholder="HH:MM:SS" />
                                        </div>

                                        <div class="mt-3">

                                            <h6 class="control-label">االمقدمة تنتهي
                                                في</h6>

                                                <input type="text" id="edit_modal_intro_end"
                                                class="form-control datetimepicker-input"
                                                name="intro_end" data-target="#edit_modal_intro_end"
                                                placeholder="HH:MM:SS" />
                                        </div>





                                            <div class="addmoviebtn mt-4 ">

                                                <button class="fetch-btn ">إضافة الحلقة</button>

                                            </div>
                                        </div>

                                    </div>


                                </div>
                                <form>
                                    <div id="deletallbtn" class="addmoviebtn mt-4 col-sm-2">

                                        <button class="fetch-btn bg-danger">حدف</button>

                                    </div>

                                    <div class="content-table mt-4 bg-white p-2">

                                        <table id="tvt" class="hover">
                                            <thead>
                                                <tr>
                                                    <th class="col-sm-1"><input type="checkbox" name="deletcheck"
                                                            id="selectall_ids"></th>

                                                    <th>رقم الحلقة</th>
                                                    <th>المترجم</th>
                                                    <th>المصدر</th>
                                                    <th>السيرفرات المتوفرة</th>
                                                    <th>إعدادات</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($episodes as $item)
                                                    <tr id="employee_ids{{ $item->id }}">
                                                        <td>

                                                            <input type="checkbox" value="{{ $item->id }}"
                                                                name="ids" class="checkbox_ids">



                                                        </td>
                                                        {{-- <td><img style="width: 200px;height:100px"
                                                        src="{{ $item['type'] == 'upload_video' ? ($item['imageofepe_url'] == null ? '' : url($item['imageofepe_url'])) : '' }}"
                                                        alt=""></td> --}}
                                                        <td class="mytitle">{{ $item['lebel'] }}</td>
                                                        <td>
                                                            <div class="urldialvideo">{{ $item['url'] }}</div>
                                                        </td>
                                                        {{-- <td>
                                                    <div class="urldialvideo">{{ $item['url_modablaj'] }}</div>
                                                </td> --}}
                                                        <td class="warning">{{ $item['source'] }}</td>
                                                        <td class="warning">
                                                            {{  count($item->video_quality)}}
                                                        </td>
                                                        <td>
                                                            <div class="menu">
                                                                <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                                <ul class="menu-link">
                                                                    <li><a
                                                                            href="/tv/season/videos/edit/{{ $item['id'] }}">تعديل</a>
                                                                    </li>
                                                                    <li><a
                                                                        href="/tv/season/videos/servers/{{ $item['id'] }}">السيرفرات</a>
                                                                </li>
                                                                    <li>

                                                                        <div class="deletvid">
                                                                            <a
                                                                                onclick="Deletvid(event,{{ $item['id'] }})">حدف</a>
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
        console.log('start');

        $.ajax({
            type: "POST",
            url: "/tv/seasons/videos/{{ $seasons->id }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {

                console.log(response);
                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة الحلقة",
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
                    text: errr,
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
                text: "ستتمكن من حدف الحلقة إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/tv/season/videos/delet/" + id,
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


    const spans = document.querySelectorAll(".urldialvideo");

    for (const span of spans) {
        span.onclick = function() {
            document.execCommand("copy");
        }

        span.addEventListener("copy", function(event) {
            event.preventDefault();
            if (event.clipboardData) {
                event.clipboardData.setData("text/plain", span.textContent);
                console.log(event.clipboardData.getData("text"))
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
        $("#deletallbtn").css('display', 'none');
        $("#selectall_ids").click(function() {
            // $("#deletallbtn").css('display', 'block');

            $(".checkbox_ids").prop('checked', $(this).prop('checked'))


            var $menu = $('#deletallbtn');
            if ($menu.is(':visible')) {
                // Slide away
                $("#deletallbtn").css('display', 'none');
            } else {
                // Slide in
                $("#deletallbtn").css('display', 'block');
            }

        });

        $("#deletallbtn").click(function(e) {
            e.preventDefault();
            var all_ids = [];
            $('input:checkbox[name=ids]:checked').each(function() {
                all_ids.push($(this).val())
            });

            $.ajax({
                type: "POST",
                url: "{{ route('DeletAllEpe') }}",
                data: {
                    ids: all_ids
                },
                success: function(response) {
                    $.each(all_ids, function(key, value) {
                        $('#employee_ids' + value).remove();
                    });


                }
            });




        });


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




    });
</script>




@endsection
