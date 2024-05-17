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


                    <form id="addnewtvform" enctype="multipart/form-data" onsubmit="addnewtv(event)" method="POST">
                        @csrf

                        <div class="all-movies">


                            <section class="movie-section">


                                <div class="king-info">

                                    <div class="fetch">


                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Ads Network</label>
                                            <div class="col-sm-3 ">
                                                <select class="form-control form-select"
                                                    id="mobile_ads_network_Controll" name="ad_type">
                                                    <option value="0">Disable</option>
                                                    <option value="1">AdMob</option>
                                                    <option value="2">StartApp</option>
                                                    <option value="3">Facebook</option>
                                                    <option value="4">AdColony</option>
                                                    <option value="5">UnityAds</option>
                                                    <option value="6">CustomAds</option>
                                                    <option value="7">AppLovin</option>
                                                    <option value="8">IronSource</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <br>
                                        <strong>Admob</strong>
                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Admob Publisher ID</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="10"
                                                    id="admob_publisher_id" name="Admob_Publisher_ID" value="{{$ads->Admob_Publisher_ID}}"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Admob APP ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" id="admob_app_id"
                                                    name="Admob_APP_ID" class="form-control" value="{{$ads->Admob_APP_ID}}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Admob Banner Ad ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" value="{{$ads->adMob_Banner}}"
                                                    id="admob_banner_ads_id" name="adMob_Banner" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Admob Interstitial Ad ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" value="{{$ads->adMob_Interstitial}}"
                                                    id="admob_interstitial_ads_id" name="adMob_Interstitial"
                                                    class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Admob Native Ad ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" value="{{$ads->adMob_Native}}"
                                                    id="admob_native_ads_id" name="adMob_Native" class="form-control">
                                            </div>
                                        </div>


                                        <br>

                                        <br>
                                        <strong>Facebook</strong>
                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Facebook APP ID</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="10" id="facebook_app_id" value="{{$ads->facebook_app_id}}"
                                                    name="facebook_app_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Facebook Banner Ads Placement
                                                ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" value="{{$ads->facebook_banner_ads_placement_id}}"
                                                    id="facebook_banner_ads_placement_id"
                                                    name="facebook_banner_ads_placement_id" class="form-control">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Facebook Interstitial Ads Placement
                                                ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="10" value="{{$ads->facebook_interstitial_ads_placement_id}}"
                                                    id="facebook_interstitial_ads_placement_id"
                                                    name="facebook_interstitial_ads_placement_id" class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <strong>StartApp</strong>
                                        <hr>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">StartApp App ID</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="8" id="startapp_app_id" value="{{$ads->StartApp_App_ID}}"
                                                    name="StartApp_App_ID" class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <strong>AdColony</strong>
                                        <hr>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">AdColony App ID</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="8" id="AdColony_app_id" value="{{$ads->AdColony_app_id}}"
                                                    name="AdColony_app_id" class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Banner Zone ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->AdColony_BANNER_ZONE_ID}}"
                                                    id="AdColony_BANNER_ZONE_ID" name="AdColony_BANNER_ZONE_ID"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Interstitial Zone ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->AdColony_INTERSTITIAL_ZONE_ID}}"
                                                    id="AdColony_INTERSTITIAL_ZONE_ID"
                                                    name="AdColony_INTERSTITIAL_ZONE_ID" class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <strong>Unity Ads</strong>
                                        <hr>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">UnityAds Game ID</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->UnityAds_game_id}}"
                                                    id="UnityAds_game_id" name="UnityAds_game_id"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Banner Zone ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->UnityAds_BANNER_ID}}"
                                                    id="UnityAds_BANNER_ID" name="UnityAds_BANNER_ID"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Interstitial/Rewarded Zone ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->UnityAds_Interstitial_ID}}"
                                                    id="UnityAds_Interstitial_ID" name="UnityAds_Interstitial_ID"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <strong>Custom Ads</strong>
                                        <hr>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Banner Url</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->Custom_Banner_Url}}"
                                                    id="Custom_Banner_Url" name="Custom_Banner_Url"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Banner Click Url Type</label>
                                            <div class="col-sm-3 ">
                                                <select class="form-control form-select"
                                                    id="Custom_Banner_Click_Url_Type"
                                                    name="Custom_Banner_Click_Url_Type">
                                                    <option value="0">None</option>
                                                    <option value="1">External Browser</option>
                                                    <option value="2">Internal Browser</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Banner Click Url</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->Custom_Banner_Click_Url}}"
                                                    id="Custom_Banner_Click_Url" name="Custom_Banner_Click_Url"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Interstitial Url</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->Custom_Interstitial_Url}}"
                                                    id="Custom_Interstitial_Url" name="Custom_Interstitial_Url"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Interstitial Click Url
                                                Type</label>
                                            <div class="col-sm-3 ">
                                                <select class="form-control form-select"
                                                    id="Custom_Interstitial_Click_Url_Type"
                                                    name="Custom_Interstitial_Click_Url_Type">
                                                    <option value="0">None</option>
                                                    <option value="1">External Browser</option>
                                                    <option value="2">Internal Browser</option>
                                                </select>
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Custom Interstitial Click Url</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8"
                                                    id="Custom_Interstitial_Click_Url" value="{{$ads->Custom_Interstitial_Click_Url}}"
                                                    name="Custom_Interstitial_Click_Url" class="form-control">
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                        <strong>AppLovin Ads</strong>
                                        <hr>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Applovin Sdk Key</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->applovin_sdk_key}}"
                                                    id="applovin_sdk_key" name="applovin_sdk_key"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Applovin ApiKey</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" id="applovin_apiKey" value="{{$ads->applovin_apiKey}}"
                                                    name="applovin_apiKey" class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Applovin Banner ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->applovin_Banner_ID}}"
                                                    id="applovin_Banner_ID" name="applovin_Banner_ID"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>

                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">Applovin Interstitial ID</label>
                                            <div class="col-sm-6">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->applovin_Interstitial_ID}}"
                                                    id="applovin_Interstitial_ID" name="applovin_Interstitial_ID"
                                                    class="form-control">
                                            </div>
                                        </div>

                                        <br>
                                        <br>
                                        <strong>IronSource Ads</strong>
                                        <hr>
                                        <div class="form-group row mb-3">
                                            <label class="col-sm-3 control-label">IronSource App Key</label>
                                            <div class="col-sm-3">
                                                <input type="text" data-parsley-minlength="8" value="{{$ads->ironSource_app_key}}"
                                                    id="ironSource_app_key" name="ironSource_app_key"
                                                    class="form-control">
                                            </div>
                                        </div>


                                        <br>

                                        <div class="addmoviebtn mt-4">

                                            <button class="fetch-btn">حفظ الإعلانات</button>

                                        </div>



                                    </div>

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
                        window.location.replace('/adsshow');
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
            var ad_type = '{{ $ads->ad_type }}';
            if (ad_type == "0") {
                $("#mobile_ads_network_Controll").val("0");
            } else if (ad_type == "1") {
                $("#mobile_ads_network_Controll").val("1");
            } else if (ad_type == "2") {
                $("#mobile_ads_network_Controll").val("2");
            } else if (ad_type == "3") {
                $("#mobile_ads_network_Controll").val("3");
            } else if (ad_type == "4") {
                $("#mobile_ads_network_Controll").val("4");
            } else if (ad_type == "5") {
                $("#mobile_ads_network_Controll").val("5");
            } else if (ad_type == "6") {
                $("#mobile_ads_network_Controll").val("6");
            } else if (ad_type == "7") {
                $("#mobile_ads_network_Controll").val("7");
            } else if (ad_type == "8") {
                $("#mobile_ads_network_Controll").val("8");
            } else {
                $("#mobile_ads_network_Controll").val("0");
            }

            var Custom_Banner_Click_Url_Type_count = '{{$ads->custom_banner_click_url_type}}';
            if(Custom_Banner_Click_Url_Type_count == 0) {
                $("#Custom_Banner_Click_Url_Type").val("0");
            } else if(Custom_Banner_Click_Url_Type_count == 1) {
                $("#Custom_Banner_Click_Url_Type").val("1");
            } else if(Custom_Banner_Click_Url_Type_count == 2) {
                $("#Custom_Banner_Click_Url_Type").val("2");
            }

            var Custom_Interstitial_Click_Url_Type_count = '{{$ads->custom_interstitial_click_url_type}}';
            if(Custom_Interstitial_Click_Url_Type_count == 0) {
                $("#Custom_Interstitial_Click_Url_Type").val("0");
            } else if(Custom_Interstitial_Click_Url_Type_count == 1) {
                $("#Custom_Interstitial_Click_Url_Type").val("1");
            } else if(Custom_Interstitial_Click_Url_Type_count == 2) {
                $("#Custom_Interstitial_Click_Url_Type").val("2");
            }


        });
    </script>


@endsection
