@extends('app')

@section('title', 'تخطي جوجل')

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

                                    <form method="post" action="{{ route('saveinfo') }}">
                                        @csrf

                                        @if (isset($data))
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Text</label>

                                                <textarea name="text" class="form-control" id="recipient-name" rows="5" value="{{ $data['text'] }}">{{ $data['text'] }}</textarea>

                                            </div>
                                            <div class="mb-3">
                                                <label for="ver-name" class="col-form-label">Version</label>
                                                <input type="number" value="{{ $data['version'] }}" class="form-control" id="ver-name"
                                                    name="version">
                                            </div>
                                            <div class="mb-3">
                                                <label for="order" class="col-form-label">Show Empty Screen On Start ?</label>

                                                <select name="status" >

                                                    @foreach (json_decode('{"true":"true","false":"false"}') as $optionKey => $optionValu)
                                                        <option class="form-control" value="{{ $optionKey }}">{{ $optionValu  }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <label for="recipient-name" class="col-form-label">Text</label>

                                                 <textarea name="text" class="form-control" id="recipient-name" rows="5" ></textarea>

                                            </div>
                                            <div class="mb-3">
                                                <label for="ver-name" class="col-form-label">Version</label>
                                                <input type="number"  class="form-control" id="ver-name"
                                                    name="version">
                                            </div>
                                            <div class="mb-3">
                                                <label for="order" class="col-form-label">Show Empty Screen On Start ?</label>

                                                <select name="status" >

                                                    @foreach (json_decode('{"true":"true","false":"false"}', true) as $optionKey => $optionValu)
                                                        <option class="form-control" value="{{ $optionKey }}">{{ $optionValu }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Save</button>
                                            </div>

                                        @endif
                                    </form>

                                </div>


                        </div>
                        <form>







                </main>
            </div>
        </div>









    </div>




    <script>
        function addnewtv(e) {
            e.preventDefault();


            var contactform = $('#addnewtvform')[0];
            var contactformData = new FormData(contactform);



            $.ajax({
                type: "POST",
                url: "{{ route('saveads') }}",
                data: contactformData,
                processData: false,
                contentType: false,
                success: function(response) {


                    swal({
                        title: "تم الأمر بنجاح",
                        text: "تم حفظ الإعلانات",
                        icon: "success",
                        buttons: false,
                    })

                    setTimeout(() => {
                        window.location.replace('/ads');
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
