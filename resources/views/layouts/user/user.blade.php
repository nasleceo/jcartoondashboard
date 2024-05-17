@extends('app')

@section('title', 'المستخدمين')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/posts.css') }}">

@endsection



<main>




    <div class="content-table m-4 bg-white p-2">

        <table id="tvt" class="hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الإسم</th>
                    <th>نوع الحساب</th>
                    <th>موتوق</th>
                    <th>حالة الإعلانات</th>
                    <th>حساب بريموم</th>
                    <th>حظر</th>
                    <th>التعل</th>
                    <th>البوس</th>
                    <th>لايكات</th>
                    <th>متابعين</th>
                    <th>المتبعون</th>
                    <th>*</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($users as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td>{{ $item['name'] }}</td>
                        <td class="mytitle">{{ $item->account_type }}</td>
                        <td>{{ $item['isverified'] }}</td>
                        <td class="warning">{{ $item->noads }}</td>
                        <td class="warning">{{ $item->Subscription }}</td>
                        <td class="warning">{{ $item->banned }}</td>
                        <td class="warning">{{ count($item->user_comments) }}</td>
                        <td class="warning">{{ count($item->user_posts) }}</td>
                        <td class="warning">{{ $item->likes_count }}</td>
                        <td class="warning">{{ $item->followers_count }}</td>
                        <td class="warning">{{ $item->followings_count }}</td>

                        <td>
                            <div class="menu">
                                <i class='bx bx-dots-horizontal-rounded icon'></i>
                                <ul class="menu-link">
                                    @if ($item['banned'] == '0')
                                        <li><a href="/users/banne/{{ $item['id'] }}">حظر</a></li>
                                    @else
                                        <li><a href="/users/unbanne/{{ $item['id'] }}">إلغاء الحظر</a></li>
                                    @endif
                                    @if ($item['isverified'] == '0')
                                        <li><a href="/users/verefed/{{ $item['id'] }}">تفعيل الحساب</a></li>
                                    @else
                                        <li><a href="/users/unverife/{{ $item['id'] }}">إلغاء التفعيل</a></li>
                                    @endif
                                    @if ($item['noads'] == '0')
                                        <li><a href="/users/noads/{{ $item['id'] }}">إلغاء الإعلانات</a></li>
                                    @else
                                        <li><a href="/users/ads/{{ $item['id'] }}">تفعيل الإعلانات</a></li>
                                    @endif
                                    <li><a href="posts/edit/{{ $item['id'] }}">تعديل</a></li>
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
                        url: "/users/delete/" + id,
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
