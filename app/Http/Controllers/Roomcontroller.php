<?php

namespace App\Http\Controllers;

use App\Models\conversation;
use App\Models\episodemodel;
use App\Models\messages;
use App\Models\RoomModel;
use App\Models\RoomUsersModel;
use App\Models\SeasonModel;
use App\Models\TV;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class Roomcontroller extends Controller
{


    public function show(){

        $allrooms = RoomModel::with(['cartoon','room_users','room_epe','room_messages'])->get();
        $allcartoons = TV::where('place','!=', 'Published,comic')->get();

        return View('layouts.room.room', compact('allrooms','allcartoons'));

    }


    public function showroomsapi(){

        $allrooms = RoomModel::withCount('room_users')->with(['cartoon','room_epe'])->where('type_ispublic_private','public')->paginate(10);
        return Response()->json($allrooms);

    }


    public function myroomsapi($user_id){

        $allrooms = RoomModel::withCount('room_users')->with(['cartoon','room_epe'])->where('who_create_room_user_id',$user_id)->paginate(10);
        return Response()->json($allrooms);

    }



    public function deleteroomsapi($id){

        $room = RoomModel::findOrFail($id);



        $messages = messages::where('conversation_id',$id)->get();

        if ($messages != null) {

            foreach ($messages as $msg ) {
                $msg->delete();
            }


        }
        $RoomUsersModel = RoomUsersModel::where('room_id',$id)->get();
        if ($RoomUsersModel != null) {

            foreach ($RoomUsersModel as $msg ) {
                $msg->delete();
            }


        }
        $room->delete();

        return Response()->json(["message" => "deleted"]);

    }


    public function AddnewRoomapi(Request $request){

        $invitaion_code = $this->random_string(7);

        $data['title'] = $request->title;
        $data['who_create_room_user_id'] = $request->who_create_room_user_id;
        $data['invitaion_code'] = $invitaion_code;

        $conversationdata['title'] = $request->title.'  محادثة';
        $conversation = conversation::create($conversationdata);

        if ($conversation) {

            $data['conversation_id'] = $conversation->id;
            $data['time_creted'] = now()->toDateString();
            $data['tv_id'] = $request->tv_id;
            $data['season_id'] = $request->season_id;
            $data['epe_id'] = $request->epe_id;
            $data['type_ispublic_private'] = $request->type_ispublic_private;
            $data['number_limit'] = $request->number_limit;



            $movie = RoomModel::create($data);
            if ($movie) {
                return Response()->json(["message" => "added"]);
            }

            return Response()->json(["message" => "error"]);
        }



    }

    public function usersinsideRoomApi($id){

        $usersinroom = RoomUsersModel::with('user')->where('room_id',$id)->get();

        return Response()->json(["data" => $usersinroom]);

    }
    public function enterRoomapi($id,Request $request){


        $room = RoomModel::findOrFail($id);

        $rooms = RoomUsersModel::where('room_id',$id)->get();

        if ($room->invitaion_code == $request->invitaion_code) {

            if ($room->number_limit != count($rooms)) {

                $data['user_id'] = $request->user_id;
                $data['room_id'] = $id;
                $data['invitaion_code'] = $request->invitaion_code;

                $movie = RoomUsersModel::create($data);

                if (!$movie) {
                    return Response()->json(["message" => "error"]);

                }
                return Response()->json(["message" => "added"]);

            }else{

                return Response()->json(["message" => "numberlimit"]);

                //return Response()->json('لا بمكن الدخول بسبب أن الحد المسموح وصل حدوده');
            }







        }else {
            return Response()->json(["message" => "invititioncode_error"]);

            //return Response()->json('رمز الدعوة غير صحيح');
            }







    }


    public function allmessagesapi($id){

        $messages = messages::with(['message_user'])->where('conversation_id',$id)->paginate();
        return Response()->json($messages);

    }
    public function deletemessagesapi($id){
        $messages = messages::findOrFail($id);
        $messages->delete();
        return Response()->json(["message" => "deleted"]);

    }


    public function addmessagesapi($id,Request $request){


        $data['body'] = $request->body;
        $data['read'] = true;
        $data['user_id'] = $request->user_id;
        $data['conversation_id'] = $id;

        $movie = messages::create($data);

        if (!$movie) {
            return Response()->json(["message" => "error"]);
        }

        return Response()->json(["message" => "added"]);


}





    public function getMovieType($id){


        $seasons = TV::findOrFail($id);

        return Response()->json($seasons->place);



    }


    public function getSeasons($id){


        $seasons = SeasonModel::with('episodes')->where('movie_id', $id)->get();

        return Response()->json($seasons);



    }

    public function getEpisdoesMovie($id){


        $episodes = episodemodel::where('tv_id', $id)->get();

        return Response()->json($episodes);

    }


    public function getEpisdoes($id){

        $seasons = SeasonModel::findOrFail($id);

        $tv = TV::where('id', $seasons->movie_id)->first();

        $episodes = episodemodel::with('video_quality')->where(['tv_id' =>  $tv->id, 'season_id' => $id ])->get();

        return Response()->json($episodes);

    }


    public function AddnewRoom(Request $request){

        $invitaion_code = $this->random_string(7);

        $data['title'] = $request->title;
        $data['who_create_room_user_id'] = 1;
        $data['invitaion_code'] = $invitaion_code;

        $conversationdata['title'] = $request->title.'  محادثة';
        $conversation = conversation::create($conversationdata);

        if ($conversation) {

            $data['conversation_id'] = $conversation->id;
            $data['time_creted'] = now()->toDateString();
            $data['tv_id'] = $request->tv_id;
            $data['season_id'] = $request->season_id;
            $data['epe_id'] = $request->epe_id;
            $data['type_ispublic_private'] = $request->type_ispublic_private;
            $data['number_limit'] = $request->number_limit;



            $movie = RoomModel::create($data);
            if (!$movie) {
                return 'خطا في إدخال المعلومات';
            }

            return 'تم الأمر بنجاح';
        }



    }


    public function usersinsideRoom($id){

        $usersinroom = RoomUsersModel::with('room')->with('user')->where('room_id',$id)->get();


        $room = RoomModel::findOrFail($id);

        return View('layouts.room.roomuser', compact('room','usersinroom'));

    }

    public function AddnewUserToRoom($id,Request $request){


        $room = RoomModel::findOrFail($id);
        $rooms = RoomUsersModel::where('room_id',$id)->get();

        if ($room->invitaion_code == $request->invitaion_code) {

            if ($room->number_limit != count($rooms)) {

                $data['user_id'] = $request->user_id;
                $data['room_id'] = $id;
                $data['invitaion_code'] = $request->invitaion_code;

                $movie = RoomUsersModel::create($data);

                if (!$movie) {
                    return 'خطا في إدخال المعلومات';
                }

                return Response()->json(count($rooms));

            }else{

                return Response()->json('لا بمكن الدخول بسبب أن الحد المسموح وصل حدوده');
            }







        }else {
            return Response()->json('رمز الدعوة غير صحيح');
            }







    }


    public function userOutFromRoom(Request $request){

        $room = RoomUsersModel::where(['room_id'=> $request->room_id,'user_id'=> $request->user_id]);
        $isdelete = $room->delete();
        if($isdelete){
            return Response()->json(["message" => "deleted"]);

        }else{
            return Response()->json(["message" => "error"]);

        }

    }



    public function allmessages($id){

        $messages = messages::with(['message_user'])->where('conversation_id',$id)->get();
        $room = RoomModel::findOrFail($id);


        return View('layouts.room.messages', compact('room','messages'));

    }


      public function Addnewmessages($id,Request $request){


                $data['body'] = $request->body;
                $data['read'] = true;
                $data['user_id'] = $request->user_id;
                $data['conversation_id'] = $id;

                $movie = messages::create($data);

                if (!$movie) {
                    return 'خطا في إدخال المعلومات';
                }

                return 'تم الأمر بنجاح';


    }


    public function DeleteRoom($id){

        $room = RoomModel::findOrFail($id);



        $messages = messages::where('conversation_id',$id)->get();

        if ($messages != null) {

            foreach ($messages as $msg ) {
                $msg->delete();
            }


        }
        $RoomUsersModel = RoomUsersModel::where('room_id',$id)->get();
        if ($RoomUsersModel != null) {

            foreach ($RoomUsersModel as $msg ) {
                $msg->delete();
            }


        }
        $room->delete();


    }


    function random_string($length) {
        $key = '';
        $keys = array_merge(range(0, 9), range('a', 'z'));

        for ($i = 0; $i < $length; $i++) {
            $key .= $keys[array_rand($keys)];
        }

        return $key;
    }

}
