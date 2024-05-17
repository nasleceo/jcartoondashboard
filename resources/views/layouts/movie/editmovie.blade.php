@extends('app')

@section('title', 'تعديل الفيلم')


@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/addtv.css') }}">

@endsection

@section('contant')





    <main>


        <div class="container card">


            <div class="top">

                <div class="fetch">

                    <form id="fetchimdbform" enctype="multipart/form-data" onsubmit="getDatafromimdb(event)" method="POST">
                        @csrf
                        <div class="form-group">
                            <input id="tmdbid" value="{{$tv->tmdb_id}}" name="tmdbid" type="text" placeholder="ادخل رمز">
                        </div>


                        <span class="text-danger tmdbid_err"></span>

                        <div class="wrapper">
                            <button class="btn-fetch" type="submit">سحب</button>

                        </div>

                    </form>

                </div>

                {{-- <h4 class="textsucc">Data <b>imported</b> successfully.</h4> --}}
                @if ($errors->any())
                    <div class="col-12">
                        @foreach ($errors->all() as $error)
                            <h6 class="textsucc">{{ $error }}</h4>
                        @endforeach
                    </div>

                @endif



            </div>


            <hr>

            <form id="addnewtvform" enctype="multipart/form-data" onsubmit="Edittv(event)" method="POST">
                @csrf
                <div>



                    <div class="addinfo">
                        <div class="form-group-info">
                            <select name="agerate">

                                @foreach (json_decode('{"12":"+12","13":"+13","14":"+14","15":"+15","16":"+16","17":"+17","18":"+18","20":"+20"}', true) as $optionKey => $optionValu)
                                    <option value="{{ $optionKey }}">{{ $optionValu }}</option>
                                @endforeach

                            </select>
                            <h6 class="m-4"> العمر المناسب</h6>



                        </div>

                        <div class="form-group-info">

                            <input class="nameinp" value="{{$tv->title}}" name="title" required type="text" placeholder="العنوان">
                            <h6 class=" m-4"> العنوان</h6>

                        </div>


                    </div>


                    <div class="Movie-Info-2">

                        <div class="m-title">

                            <div class="img-poster">
                                <img id="poster"
                                    src="{{$tv->poster}}"
                                    alt="">


                            </div>
                            <div class="fetch">

                                <div class="form-group-info">

                                    <input type="text" name="poster" value="{{$tv->poster}}" required id="posterlink" placeholder="البوتسر"
                                        class="record-poster">


                                </div>


                                <div class="input-box button">

                                    <input id="setposter" class="btn-fetch" type="button" value="غير">

                                </div>
                            </div>


                            <div class="img-poster">
                                <img class="cover" id="cover"
                                    src="{{$tv->cover}}"
                                    alt="">



                            </div>
                            <div class="fetch">

                                <div class="form-group-info">

                                    <input type="text" value="{{$tv->cover}}" name="cover" required id="coverlink" placeholder="الغلاف"
                                        class="record-poster">


                                </div>


                                <div class="input-box button">
                                    <input id="setcover" class="btn-fetch" type="button" value="غير">

                                </div>

                            </div>


                        </div>

                    </div>
                    <h3 class="kisatitle"><b>القصة</b></h2>
                        <div class="m-title mb-3">


                            <div class="form-group-info">

                                <textarea  name="story" required id="text-desc" rows="5" value="ddd">{{$tv->story}}</textarea>
                                <p class="counter" id="result"></p>

                            </div>


                        </div>

                        <div class="addinfo">

                            <div class="form-group-info">

                                <input id="year" value="{{$tv->year}}" required name="year" type="number" placeholder="السنة">
                                <h6 class="m-4"> السنة</h6>

                            </div>
                            <div class="form-group-info">

                                <input id="genreInputs" value="{{$tv->gener}}" required type="text" name="gener" placeholder="التصنيف">
                                <h6 class="m-4"> التصنيف</h6>

                            </div>


                        </div>

                        <div class="form-group-info mt-4 mb-4">
                            <select name="status">

                                @foreach (json_decode('{"Published":"نشر","Unpublished":"غير منشور"}', true) as $optionKey => $optionValu)
                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                    </option>
                                @endforeach

                            </select>
                            <h6> الحالة</h6>



                        </div>


                        <div class="top">

                            <div class="fetch">




                                <div class="wrapper">
                                    <button class="btn-fetch" type="submit">تعديل</button>

                                </div>



                            </div>





                        </div>


                </div>

            </form>

        </div>


        </div>










    </main>






    <script>
           function getDatafromimdb(e) {
            e.preventDefault();


            var contactform = $('#fetchimdbform')[0];
            var contactformData = new FormData(contactform);


            $.ajax({
                type: "POST",
                url: "{{ route('getmovieFromTMDB') }}",
                data: contactformData,
                processData: false,
                contentType: false,
                success: function(response) {


                    console.log(response);

                    const obj = JSON.parse(response);

                    $(".nameinp").val(obj.original_title);




                    var poster = "https://www.themoviedb.org/t/p/w600_and_h900_face" + obj.poster_path;
                    var cover = "https://www.themoviedb.org/t/p/w600_and_h900_face" + obj.backdrop_path;

                    $("#poster").attr("src", poster);
                    $("#cover").attr("src", cover);


                    $("#posterlink").val(poster);
                    $("#coverlink").val(cover);


                    $("#text-desc").val(obj.overview);

                    const genreNames = obj.genres.map(genre => genre.name).join(', ');

                    $("#genreInputs").val(genreNames);

                    const dateString = obj.release_date;
                    const date = new Date(dateString);
                    const year = date.getFullYear();
                    $("#year").val(year);




                },
                error: function(errr) {

                    $('.tmdbid_err').html('');


                    var myeror = errr.responseJSON.errors;

                    console.log(errr);

                    for (var er in myeror) {
                        $('.' + er + '_err').html(myeror[er][0]);
                    }

                }
            });

        }


        function Edittv(e) {
            e.preventDefault();


            var contactform = $('#addnewtvform')[0];
            var contactformData = new FormData(contactform);

            var tmdb = $("#tmdbid").val();

            if (tmdb) {
                contactformData.append('tmdbid', tmdb);

            } else {
                $('.tmdbid_err').html('يجب إدخال الرمز أولا');
            }


            $.ajax({
                type: "POST",
                url: "{{route('Editmovie',$tv->id)}}",
                data: contactformData,
                processData: false,
                contentType: false,
                success: function(response) {


                    swal({
                        title: "تم الأمر بنجاح",
                        text: "تم تعديل الفيلم",
                        icon: "success",
                        buttons: false,
                    })

                    setTimeout(() => {
                        window.location.replace('/movie');
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


        $(document).ready(function() {
            $('#tvt').DataTable({
                info: false
            });


            const setposter = document.getElementById('setposter');
            var posterlink = document.getElementById('posterlink');
            var poster = document.getElementById('poster');

            const setcover = document.getElementById('setcover');
            var coverlink = document.getElementById('coverlink');
            var cover = document.getElementById('cover');



            setposter.addEventListener('click', () => {

                poster.src = posterlink.value;

            });


            setcover.addEventListener('click', () => {

                cover.src = coverlink.value;

            });

        });
    </script>


@endsection
