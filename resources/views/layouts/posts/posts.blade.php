@extends('app')

@section('title', 'المنشورات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/posts.css') }}">

@endsection



<main>

    <div class="ads">
        <div class="wrapper">
            <a href="/posts/addpost" class="btn-addpost ">إضافة منشور</a>
            <a href="#" class=" mt-3" style="display: flex;
            justify-content: center">المنشورات التي تحتاج موافقة ({{count($posts_unaproved)}})</a>
        </div>
    </div>



    <div class="content-table m-4 bg-white p-2">

        <table id="tvt" class="hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الغلاف</th>
                    <th>الإسم</th>
                    <th>النص</th>
                    <th>الحالة</th>
                    <th>عدد تعلي</th>
                    <th>عدد الجيجي</th>
                    <th>المشاهدات</th>
                    <th>اعدادات</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($posts as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>

                        <td>
                            @if (@isset($item['poster']))
                            <img style="width: 117px;height:171px" src="{{ $item['poster'] }}" alt="">

                            @endif

                        </td>
                        <td class="mytitle" >{{ $item->poste_user->name }}</td>
                        <td>{{ $item['text'] }}</td>
                        <td class="warning">{{ $item->state }}</td>
                        <td class="warning">{{ count($item->poste_comments) }}</td>
                        <td class="warning">{{ $item->totalLikers }}</td>
                        <td class="warning">{{ $item->visit_count_total }}</td>

                        <td>
                            <div class="menu">
                                <i class='bx bx-dots-horizontal-rounded icon'></i>
                                <ul class="menu-link">
                                    @if ($item['state'] === 'Unpublished')
                                    <form id="ssform" enctype="multipart/form-data"  action="{{route('acceptpost',$item->id)}}" method="post">
                                        @csrf
                                        <li><a href="javascript:{}" onclick="document.getElementById('ssform').submit();">موافقة</a></li>
                                    </form>
                                    @endif
                                    <li><a href="posts/edit/{{$item['id']}}">تعديل</a></li>
                                    <li><a href="posts/comments/{{$item['id']}}">التعليقات</a></li>
                                    <li><a onclick="Deletvid(event,{{ $item['id'] }})">حدف</a></li>
                                </ul>
                            </div>
                        </td>


                    </tr>
                @endforeach

            </tbody>

        </table>


    </div>








</main>






<script>


function Deletvid(e, id) {
        e.preventDefault();


        console.log(id);

        swal({
                title: "هل انت متأكد",
                text: "ستتمكن من حدف المنشور إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/posts/delet/" + id,
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
                            swal({
    title: "هناك خطأ",
    text: errr.responseJSON.message,
    icon: "warning",
    buttons: false,
    dangerMode: true,
})
                        }
                    });





                } else {
                    swal("تم إلغاء الحدف");
                }
            });



    }




    // MENU
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
        $('#tvt').DataTable();



    });

</script>


@endsection
