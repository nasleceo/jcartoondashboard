@extends('app')

@section('title', 'تعديل الفصل')

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
                                            <h3>({{ $comic->title }}) تعديل فصل للكوميكس</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6>رقم الفصل</h6>

                                            <input required type="number" name="title" class="record-tmdb_id"
                                                value="{{ $chapters->title }}">

                                        </div>

                                        <div class="mt-3">
                                            <h6>رابط التحميل </h6>

                                            <input required type="text" name="direct_link" class="record-tmdb_id"
                                                value="{{ $chapters->direct_link
                                            }}">

                                        </div>


                                        <div class="mt-3">
                                            <h6>
                                                <p>( يسمح فقط بملف zip )</p> إرفع الفصل علي شكل ملف مضغوط
                                            </h6>

                                            <input  type="file" name="chapters_folder_link"
                                                class="record-tmdb_id" value="{{ old('chapters_folder_link') }}">
                                            <i class="fas fa-cloud-upload-alt"></i>

                                            <div>
                                                <div class="percent"></div>
                                            </div>

                                        </div>



                                        <div class="mt-3">
                                            <h6>الحالة</h6>


                                            <select name="status">

                                                @foreach (json_decode('{"Published":"يظهر في التطبيق","Unpublished":"لا يظهر في التطبيق"}', true) as $optionKey => $optionValu)
                                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>
                                        <div class="addmoviebtn mt-4">

                                            <button class="rafachapter fetch-btn">تعديل الفصل</button>

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


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"
    integrity="sha384-qlmct0AOBiA2VPZkMY3+2WqkHtIQ9lSdAsAn5RUJD/3vA5MKDgSGcdmIv4ycVxyn" crossorigin="anonymous">
</script>




<script>
    function addnewvideo(e) {
        e.preventDefault();


        var percent = $('.percent');
        var rafachapter = $('.rafachapter');


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('editchapter', $chapters->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            beforeSend: function() {

                var percentVal = '....يرجى الإنتضار قليلا حتي يتم رفع الفصل';
                rafachapter.attr('disabled', true);
                rafachapter.html(percentVal);


            },
            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل الفصل",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/comic/chapters/' + "{{ $comic->id }}");
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr);

                swal({
                    title: "هناك خطأ في إضافة الفصل",
                    text: errr.responseJSON.message,
                    icon: "warning",
                    buttons: false,
                    dangerMode: true,
                })

            }
        });

    }





</script>




@endsection
