@extends('app')

@section('title', 'الإعلانات')

@section('contant')

@section('scripte')

    <link rel="stylesheet" href="{{ asset('assets/home/css/videomovie.css') }}">

@endsection



<div class="create-movie card m-4">



    <div class="importdata">



        <div class="meddle">
            <div class="container-movies-2">
                <main>




                    <div class="all-movies">


                        <section class="movie-section">


                            <div class="king-info">

                                <div class="fetch">
                                    <div class="Movie-Info">
                                        <h3> إرسال إشعار </h3>
                                        <hr>

                                    </div>

                                    <div class="mt-3">
                                        <h6> الكرتون </h6>

                                        <select id="Movie_id" name="Movie_id">

                                            @foreach ($allcartoons as $cartoon)
                                                <option value="{{ $cartoon->id }}">{{ $cartoon->title }}
                                                </option>
                                            @endforeach

                                        </select>



                                    </div>
                                    <div class="mt-3">
                                        <h6> العنوان </h6>

                                        <input id="Heading" required type="text" name="Heading"
                                            class="record-tmdb_id" value="{{ old('Heading') }}">

                                    </div>

                                    <div class="mt-3">
                                        <h6>النص</h6>

                                        <textarea class="record-tmdb_id" name="Message" required id="Message" rows="5"></textarea>

                                    </div>


                                    <div class="mt-3">
                                        <h6> الصورة الصغيرة </h6>

                                        <input id="Large_Icon" required type="text" name="Large_Icon"
                                            class="record-tmdb_id" value="{{ old('Large_Icon') }}">

                                    </div>
                                    <div class="mt-3">
                                        <h6> الصورة الكبيرة </h6>

                                        <input id="Big_Picture" required type="text" name="Big_Picture"
                                            class="record-tmdb_id" value="{{ old('Big_Picture') }}">

                                    </div>




                                    <div class="addmoviebtn mt-4">

                                        <button onclick="Save_Onesignal_Data()" class="fetch-btn">إرسال</button>

                                    </div>



                                </div>

                            </div>


                    </div>












                </main>
            </div>
        </div>


        <script>
            var Onesignal_Api_Key = '1f193992-a632-4118-994d-16dead87d28d';
            var Onesignal_Appid = 'NzU2MTZhMjEtZDE5Ni00YmRmLTg3N2YtZDc0YmQyMTFmZGIy';



            $("#Movie_id").change(function() {
                var Movie_id = $("#Movie_id option:selected").val();
                var jsonObjects = {
                    movieID: Movie_id
                };


                if (Movie_id != '' && Movie_id != null) {

                    $.ajax({
                        type: "GET",
                        url: "/getnoticartoon/" + Movie_id,
                        data: jsonObjects,
                        processData: false,
                        contentType: false,

                        success: function(response) {
                            $("#Large_Icon").val(response.poster);
                            $("#Big_Picture").val(response.poster);
                            $("#Heading").val('Watch ' + response.title);
                            $("#Message").val(response.story);

                        },
                        error: function(errr) {

                            console.log(errr);


                        }
                    });



                }

            });


            function Save_Onesignal_Data() {
                var idd = $("#Movie_id option:selected").val();

                var Heading = document.getElementById("Heading").value;
                var Message = document.getElementById("Message").value;
                var Large_Icon = document.getElementById("Large_Icon").value;
                var Big_Picture = document.getElementById("Big_Picture").value;

                var Movie_id = $("#Movie_id option:selected").val();

                if (Heading != "" && Message != "") {
                    var jsonObjects = {

                        "included_segments": ["All"],
                        "app_id": Onesignal_Appid,
                        "contents": {
                            "en": Message
                        },
                        "headings": {
                            "en": Heading
                        },
                        "data": {
                            "Type": "Movie",
                            "Movie_id": idd
                        },
                        "big_picture": Big_Picture,
                        "large_icon": Large_Icon
                    };

                    $.ajax({
                        type: 'POST',
                        url: 'https://onesignal.com/api/v1/notifications',
                        headers: {
                            'Authorization': 'Basic ' + Onesignal_Api_Key,
                            'Content-Type': 'application/json',
                            'Access-Control-Allow-Headers': $('meta[name="csrf-token"]').attr('content')
                        },
                        contentType: 'application/json',

                        data: JSON.stringify(jsonObjects),
                        dataType: 'json',
                        success: function(response) {
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.success("Total Recipients= " + response.recipients, "Sended Successfully!");
                        },
                        error: function(response) {
                            toastr.options = {
                                "closeButton": false,
                                "debug": false,
                                "newestOnTop": true,
                                "progressBar": false,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "2000",
                                "timeOut": "2000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            };
                            toastr.error("Something Went Wrong!");
                        }
                    })
                } else {
                    toastr.options = {
                        "closeButton": false,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": false,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "300",
                        "hideDuration": "2000",
                        "timeOut": "2000",
                        "extendedTimeOut": "1000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                    };
                    toastr.warning("Fill All Details Correctly!");
                }
            }
        </script>

    @endsection
