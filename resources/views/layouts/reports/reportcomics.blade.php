@extends('app')

@section('title', 'البلاغات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/tv.css') }}">

@endsection



<main>


    <div class="content-table m-4 bg-white p-2">

        <table id="tvt" class="hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>الغلاف</th>
                    <th>إسم الكوميكس</th>
                    <th>السبب</th>
                    <th>اعدادات</th>

                </tr>
            </thead>
            <tbody>

                @foreach ($reports as $item)
                    <tr>
                        <td>{{ $item['id'] }}</td>
                        <td><img style="width: 117px;height:171px" src="{{ $item->comics->poster  }}" alt=""></td>
                        <td class="mytitle">{{ $item->comics->title }}</td>
                        <td class="warning">{{ $item->text }}</td>
                        <td>
                            <div class="menu">
                                <i class='bx bx-dots-horizontal-rounded icon'></i>
                                <ul class="menu-link">

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
                text: "ستتمكن من حدف البلاغ إدا ضغطت علي زر حدف",
                icon: "warning",
                buttons: true,
                buttons: ["إلغاء", "! حدف"],
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {

                    $.ajax({
                        type: "GET",
                        url: "/reportcartoon/delet/" + id,
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
