@extends('app')

@section('title', 'الشخصيات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

@endsection


<div class="create-movie card m-4">



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
                            <h3> تعديل شخصية </h3>
                            <hr>




                        </div>


                        <div class="mt-3">
                            <h6>  رابط صورة</h6>

                            <input required type="text" name="poster" class="record-tmdb_id"
                                value="{{ $cast->poster }}">

                        </div>

                        <div class="mt-3">
                            <h6>  إسم الشخصية </h6>

                            <input required type="text" name="title" class="record-tmdb_id"
                                value="{{$cast->title }}">

                        </div>

                        <div class="mt-3">
                            <h6>   الكرتون المنتمية له</h6>

                            <select name="comic_id">

                                @foreach ($allcartoons as $cartoon )
                                    <option value="{{ $cartoon->id }}">{{ $cartoon->title }}
                                    </option>
                                @endforeach

                            </select>

                        </div>

                        <div class="mt-3">
                            <h6>هل الشخصية منتمية إلي عالم الكوميكس</h6>


                            <select name="typeiscomicornot">

                                @foreach (json_decode('{"no":"لا","yes":"نعم"}', true) as $optionKey => $optionValu)
                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                    </option>
                                @endforeach

                            </select>

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

                            <button class="fetch-btn">تعديل شخصية</button>

                        </div>



                    </div>

                </div>


        </div>
        <form>







</main>
</div>
</div>









</div>






<script>
    function addnewvideo(e) {
        e.preventDefault();


        var percent = $('.percent');
        var rafachapter = $('.rafachapter');


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('editcasts',$cast->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل الشخصية",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/casts');
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr.responseJSON.message);

                swal({
                    title: "هناك خطأ في إضافة المنشور",
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
