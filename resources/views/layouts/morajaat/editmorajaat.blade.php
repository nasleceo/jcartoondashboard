@extends('app')

@section('title', 'تعديل')

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
                                            <h3>تعديل نضرية</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6> الكود الخاص بالكرتون أو الكوميكس المرتبط بالنضرية</h6>

                                            <input type="text" name="tv_id" class="record-tmdb_id"
                                                value="{{ $nadaria->tv_id }}">

                                        </div>


                                        <div class="mt-3">
                                            <h6>أكتب المنشور</h6>

                                            <textarea class="record-tmdb_id" name="text" required id="text-desc" rows="5">{{$nadaria->text}}</textarea>

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

                                            <button class="rafachapter fetch-btn">تعديل نضرية</button>

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







<script>
    function addnewvideo(e) {
        e.preventDefault();


        var percent = $('.percent');
        var rafachapter = $('.rafachapter');


        var contactform = $('#addnewtvform')[0];
        var contactformData = new FormData(contactform);


        $.ajax({
            type: "POST",
            url: "{{ route('editnadariat.post',$nadaria->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة المنشور",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/nadariat');
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
