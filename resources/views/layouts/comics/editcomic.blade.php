@extends('app')

@section('title', 'تعديل كوميكس')


@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/addtv.css') }}">

@endsection

@section('contant')





    <main>


        <div class="container card">


            <div class="top">


                {{-- <h4 class="textsucc">Data <b>imported</b> successfully.</h4> --}}
                @if ($errors->any())
                    <div class="col-12">
                        @foreach ($errors->all() as $error)
                            <h6 class="textsucc">{{ $error }}</h4>
                        @endforeach
                    </div>

                @endif



            </div>




            <form id="addnewtvform" enctype="multipart/form-data" onsubmit="addnewtv(event)" method="POST">
                @csrf
                <div>



                    <div class="addinfo">
                        <div class="form-group-info">
                            <select name="agerate">

                                @foreach (json_decode('{"12":"+12","13":"+13","14":"+14","15":"+15","16":"+16","17":"+17","18":"+18","20":"+20"}', true) as $optionKey => $optionValu)
                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                    </option>
                                @endforeach

                            </select>
                            <h6 class="m-4"> العمر المناسب</h6>



                        </div>

                        <div class="form-group-info">

                            <input class="nameinp" value="{{ $comics->title }}" name="title" required type="text"
                                placeholder="العنوان">
                            <h6 class=" m-4"> العنوان</h6>

                        </div>


                    </div>

                    <hr>
                    <div class="Movie-Info-2">

                        <div class="m-title">

                            <div class="img-poster">
                                <img id="poster" src="{{ $comics->poster }}" alt="">


                            </div>
                            <div class="fetch">

                                <div class="form-group-info">

                                    <input type="text" name="poster" value="{{ $comics->poster }}" required
                                        id="posterlink" placeholder="البوتسر" class="record-poster">


                                </div>


                                <div class="input-box button">

                                    <input id="setposter" class="btn-fetch" type="button" value="غير">

                                </div>
                            </div>


                            <div class="img-poster">
                                <img class="cover" id="cover" src="{{ $comics->cover }}" alt="">



                            </div>
                            <div class="fetch">

                                <div class="form-group-info">

                                    <input type="text" value="{{ $comics->cover }}" name="cover" required
                                        id="coverlink" placeholder="الغلاف" class="record-poster">


                                </div>


                                <div class="input-box button">
                                    <input id="setcover" class="btn-fetch" type="button" value="غير">

                                </div>

                            </div>


                        </div>




                    </div>
                    <hr>
                    <h3 class="kisatitle"><b>القصة</b></h2>
                        <div class="m-title mb-3">


                            <div class="form-group-info">

                                <textarea name="story" required id="text-desc" rows="5" value="ddd">{{ $comics->story }}</textarea>
                                <p class="counter" id="result"></p>

                            </div>


                        </div>

                        <h3 class="kisatitle"><b>كيف سأبدا القصة ؟ هل هناك أجزاء أخرى</b></h3>

                        <div class="m-title mb-3">


                            <div class="form-group-info">

                                <textarea name="whereistartcomics" required id="text-desc" rows="5" value="ddd">{{ $comics->whereistartcomics }}</textarea>
                                <p class="counter" id="result"></p>

                            </div>

                        </div>
                        <h3 class="kisatitle"><b>إختر الكوميكس المرتبطة بهدا الكوميكس</b></h3>

                        <div class=" mb-3">

                            <input type="hidden" name="mortabit_id" value="1">


                            @foreach ($allcomics as $item)
                                @if ($item->id != $comics->id)
                                    <div class="chekboxadcomics ml-4">

                                        <label>
                                            <input type="checkbox" name="mortabit[]" value="{{ $item->id }}">
                                            {{ $item->title }}
                                        </label>

                                    </div>
                                @endif
                            @endforeach

                        </div>
                        <hr>
                        <div class="addinfo">

                            <div class="form-group-info">

                                <input id="year" value="{{ $comics->year }}" required name="year" type="number"
                                    placeholder="السنة">
                                <h6 class="m-4"> السنة</h6>

                            </div>
                            <div class="form-group-info">

                                <input value="{{ $comics->gener }}" id="genreInputs" required type="text" name="gener"
                                    placeholder="أكشن,مغامرة,قوة...">
                                <h6 class="m-4"> التصنيف</h6>

                            </div>


                        </div>

                        <div class="form-group-info mt-4 mb-4">
                            <select name="status">

                                @foreach (json_decode('{"Published":"نشر","Unpublished":"غير منشور"}', true) as $optionKey => $optionValu)
                                    <option value="{{ $optionKey }}">{{ $optionValu }}
                                    </option>
                                @endforeach

                            </select>
                            <h6> الحالة</h6>



                        </div>


                        <div class="top">

                            <div class="fetch">




                                <div class="wrapper">
                                    <button class="btn-fetch" type="submit">تعديل</button>

                                </div>



                            </div>





                        </div>


                </div>

            </form>

        </div>


        </div>










    </main>






    <script>
        function addnewtv(e) {
            e.preventDefault();


            var contactform = $('#addnewtvform')[0];
            var contactformData = new FormData(contactform);



            $.ajax({
                type: "POST",
                url: "{{ route('editcomic', $comics->id) }}",
                data: contactformData,
                processData: false,
                contentType: false,
                success: function(response) {


                    swal({
                        title: "تم الأمر بنجاح",
                        text: "تم تعديل الكوميكس",
                        icon: "success",
                        buttons: false,
                    })

                    setTimeout(() => {
                        window.location.replace('/comic');
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


        $(document).ready(function() {
            $('#tvt').DataTable({
                info: false
            });


            const setposter = document.getElementById('setposter');
            var posterlink = document.getElementById('posterlink');
            var poster = document.getElementById('poster');

            const setcover = document.getElementById('setcover');
            var coverlink = document.getElementById('coverlink');
            var cover = document.getElementById('cover');



            setposter.addEventListener('click', () => {

                poster.src = posterlink.value;

            });


            setcover.addEventListener('click', () => {

                cover.src = coverlink.value;

            });

        });
    </script>


@endsection
