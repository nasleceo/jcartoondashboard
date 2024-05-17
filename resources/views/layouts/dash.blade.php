@extends('app')

@section('title', 'الكوميكس')

@section('contant')

    <main>


        </ul>
        <div class="info-data">
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{ $moviecount }}</h2>
                        <p>الأفلام</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{ $tvcount }}</h2>
                        <p>المسلسلات</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{  $usercount }}</h2>
                        <p>المستخدمين</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{$postcount}}</h2>
                        <p>المنشورات</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{  $comicscount }}</h2>
                        <p>الكوميكس</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{  $chapterscount }}</h2>
                        <p>الفصول</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{$commentscount}}</h2>
                        <p>التعليقات</p>
                    </div>
                </div>

            </div>
            <div class="cards">
                <div class="head">
                    <div>
                        <h2>{{$totalvisit}}</h2>
                        <p>المشاهدات</p>
                    </div>
                </div>

            </div>
        </div>

        <div>
            <div class="cards">
                <div class="">
                    <div style="display:flex;justify-content:center;font-size:19px;margin-top:32px">
                        <p>أكثر المسلسلات مشاهدة اليوم</p>
                    </div>
                </div>

            </div>
            <div class="content-table mt-2 bg-white p-2">

                <table id="carnettable" class="hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>عدد المشاهدات</th>
                            <th>عدد الليكات</th>
                            <th>عدد التعليقات</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>

        </div>
        <div>
            <div class="cards">
                <div class="">
                    <div style="display:flex;justify-content:center;font-size:19px;margin-top:32px">
                        <p>أكثر الأفلام مشاهدة اليوم</p>
                    </div>
                </div>

            </div>
            <div class="content-table mt-2 bg-white p-2">

                <table id="mostvmtod" class="hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>عدد المشاهدات</th>
                            <th>عدد الليكات</th>
                            <th>عدد التعليقات</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>
        </div>

        <div>
            <div class="cards">
                <div class="">
                    <div style="display:flex;justify-content:center;font-size:19px;margin-top:32px">
                        <p>أكثر الأفلام مشاهدة</p>
                    </div>
                </div>

            </div>
            <div class="content-table mt-2 bg-white p-2">

                <table id="mostvm" class="hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>عدد المشاهدات</th>
                            <th>عدد الليكات</th>
                            <th>عدد التعليقات</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>
        </div>
        <div>
            <div class="cards">
                <div class="">
                    <div style="display:flex;justify-content:center;font-size:19px;margin-top:32px">
                        <p>أكثر المسلسلات مشاهدة</p>
                    </div>
                </div>

            </div>
            <div class="content-table mt-2 bg-white p-2">

                <table id="mostvtv" class="hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>عدد المشاهدات</th>
                            <th>عدد الليكات</th>
                            <th>عدد التعليقات</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>
        </div>

        <div>
            <div class="cards">
                <div class="">
                    <div style="display:flex;justify-content:center;font-size:19px;margin-top:32px">
                        <p>أكثر الكوميكس مشاهدة</p>
                    </div>
                </div>

            </div>
            <div class="content-table mt-2 bg-white p-2">

                <table id="mostvcomnics" class="hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>عدد المشاهدات</th>
                            <th>عدد الليكات</th>
                            <th>عدد التعليقات</th>

                        </tr>
                    </thead>
                    <tbody>

                    </tbody>

                </table>


            </div>
        </div>

        {{-- <div class="data">
    <div class="content-data">
        <div class="head">
            <h3>Sales Report</h3>
            <div class="menu">
                <i class='bx bx-dots-horizontal-rounded icon'></i>
                <ul class="menu-link">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Save</a></li>
                    <li><a href="#">Remove</a></li>
                </ul>
            </div>
        </div>
        <div class="chart">
            <div id="chart"></div>
        </div>
    </div>
    <div class="content-data">
        <div class="head">
            <h3>Chatbox</h3>
            <div class="menu">
                <i class='bx bx-dots-horizontal-rounded icon'></i>
                <ul class="menu-link">
                    <li><a href="#">Edit</a></li>
                    <li><a href="#">Save</a></li>
                    <li><a href="#">Remove</a></li>
                </ul>
            </div>
        </div>
        <div class="chat-box">
            <p class="day"><span>Today</span></p>
            <div class="msg">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?ixid=MnwxMjA3fDB8MHxzZWFyY2h8NHx8cGVvcGxlfGVufDB8fDB8fA%3D%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=60" alt="">
                <div class="chat">
                    <div class="profile">
                        <span class="username">Alan</span>
                        <span class="time">18:30</span>
                    </div>
                    <p>Hello</p>
                </div>
            </div>
            <div class="msg me">
                <div class="chat">
                    <div class="profile">
                        <span class="time">18:30</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Eaque voluptatum eos quam dolores eligendi exercitationem animi nobis reprehenderit laborum! Nulla.</p>
                </div>
            </div>
            <div class="msg me">
                <div class="chat">
                    <div class="profile">
                        <span class="time">18:30</span>
                    </div>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam, architecto!</p>
                </div>
            </div>
            <div class="msg me">
                <div class="chat">
                    <div class="profile">
                        <span class="time">18:30</span>
                    </div>
                    <p>Lorem ipsum, dolor sit amet.</p>
                </div>
            </div>
        </div>
        <form action="#">
            <div class="form-group">
                <input type="text" placeholder="Type...">
                <button type="submit" class="btn-send"><i class='bx bxs-send' ></i></button>
            </div>
        </form>
    </div>
</div> --}}
        <script>
            $(document).ready(function() {
                $('#carnettable').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
                $('#mostvmtod').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
                 $('#mostvm').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
                $('#mostvtv').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
                $('#mostvcomnics').DataTable({
                    searching: false,
                    paging: false,
                    info: false
                });
            });
        </script>
    </main>




@endsection
