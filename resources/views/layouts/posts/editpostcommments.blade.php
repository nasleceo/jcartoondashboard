s
@extends('app')

@section('title', 'تعيقات علي المنشور')

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
                                            <h3> تعديل تعليق </h3>
                                            <hr>




                                        </div>


                                        <div class="mt-3">
                                            <h6>  التعليق</h6>

                                            <input required type="text" name="content" class="record-tmdb_id"
                                                value="{{ $comments->content }}">

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

                                            <button class="fetch-btn">تعديل تعليق</button>

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
            url: "{{ route('editcommentsofpost', $comments->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل التعليق",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/posts/comments/' + "{{ $comments->poste->id }}");
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
