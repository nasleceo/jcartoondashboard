@extends('app')

@section('title', 'تعديل منشور')

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
                                            <h3>تعديل منشور</h3>
                                            <hr>




                                        </div>
                                        <div class="mt-3">
                                            <h6>رابط الصورة</h6>

                                            <input  type="poster" name="poster" class="record-tmdb_id"
                                                value="{{ $post->poster }}">

                                        </div>


                                        <div class="mt-3">
                                            <h6>أكتب المنشور</h6>

                                            <textarea class="record-tmdb_id" name="text" required id="text-desc" rows="5">{{ $post->text }}</textarea>

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

                                            <button class="rafachapter fetch-btn">تعديل منشور</button>

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
            url: "{{ route('editpost.post',$post->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,

            success: function(response) {
                console.log(response);



                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم تعديل المنشور",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/posts');
                }, 1200);


                //


            },
            error: function(errr) {

                console.log(errr.responseJSON.message);

                swal({
                    title: "هناك خطأ في تعديل المنشور",
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

    $(document).ready(function() {
        $('#tvt').DataTable({
            searching: false,
            paging: false,
            info: false
        });









    });
</script>




@endsection
