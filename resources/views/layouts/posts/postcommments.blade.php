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
                                            <h3> إضافة تعليق </h3>
                                            <hr>




                                        </div>


                                        <div class="mt-3">
                                            <h6>  التعليق</h6>

                                            <input required type="text" name="content" class="record-tmdb_id"
                                                value="{{ old('content') }}">

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

                                            <button class="fetch-btn">إضافة تعليق</button>

                                        </div>



                                    </div>

                                </div>


                        </div>
                        <form>

                            <div class="content-table m-4 bg-white p-2">

                                <table id="tvt" class="hover">
                                    <thead>
                                        <tr>
                                            <th>*</th>
                                            <th>التعليق</th>
                                            <th>هل فيه حرق</th>
                                            <th>الحالة</th>
                                            <th>إعدادات</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($comments as $item)
                                            <tr>
                                                <td ><div class="warning">{{ $item['id'] }}</div></td>
                                                <td  ><div class="urldialvideo">{{ $item['content'] }}</div></td>
                                                <td class="warning">{{ $item['ishark'] == '1' ? 'حرق' : 'لا' }}</td>
                                                <td class="warning">{{ $item['statu'] }}</td>
                                                <td>
                                                    <div class="menu">
                                                        <i class='bx bx-dots-horizontal-rounded icon'></i>
                                                        <ul class="menu-link">
                                                            <li><a
                                                                    href="/posts/comments/edit/{{ $item['id'] }}">تعديل</a>
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
            url: "{{ route('addcommentsofpost', $post->id) }}",
            data: contactformData,
            processData: false,
            contentType: false,
            success: function(response) {


                swal({
                    title: "تم الأمر بنجاح",
                    text: "تم إضاقة التعليق",
                    icon: "success",
                    buttons: false,
                })

                setTimeout(() => {
                    window.location.replace('/posts/comments/' + "{{ $post->id }}");
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
                text: "ستتمكن من حدف التعليق إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
            type: "GET",
            url: "/posts/comments/delet/"+id,
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