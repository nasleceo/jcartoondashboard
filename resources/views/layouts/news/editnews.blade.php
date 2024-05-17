s
@extends('app')

@section('title', ' الأخبار')

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
                                            <h3> تعديل خبر </h3>
                                            <hr>




                                        </div>


                                        <div class="mt-3">
                                            <h6>  عنوان الخبر</h6>

                                            <input required type="text" name="title" class="record-tmdb_id"
                                                value="{{ $news->title }}">

                                        </div>

                                        <div class="mt-3">
                                            <h6>  نص الخبر الخبر</h6>


                                                <textarea class="record-tmdb_id" name="text" required id="text-desc" rows="5">{{$news->text}}</textarea>

                                        </div>


                                        <div class="mt-3">
                                            <h6>  صورة الخبر</h6>
                                            <input required type="text" name="image" class="record-tmdb_id"
                                            value="{{ $news->image }}">


                                        </div>



                                        <div class="mt-3">
                                            <h6> { إختياري } رمز المسلسل أو الكرتون أو الكوميكس</h6>
                                            <input  type="text" name="tv_id" class="record-tmdb_id"
                                            value="{{ $news->tv_id }}">


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

                                            <button class="fetch-btn">تعديل الخبر</button>

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


        $.ajax({
            type: "POST",
            url: "{{ route('editnews',$news->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل الخبر",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/news');
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




</script>




@endsection
