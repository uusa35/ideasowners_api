<?php
namespace App\Core\Traits;

use App\Post;
use Tymon\JWTAuth\Facades\JWTAuth;

trait MobileTrait
{
    public function sendNotification(Post $post)
    {

        $fields = [
            'app_id' => "6f395d86-9da8-4ce4-8e15-56212a017092",
            'included_segments' => ['All'],
            'data' => ["title" => "test title", 'body' => 'test body'],
            'headings' => ['en' => $post->title],
            'template_id' => '51c7c1bc-d53d-4a40-904e-6a9a2b7f2dfe',
            'contents' => ['en' => $post->body],
            "included_segments" => ["All"],
            'small_icon' => 'http://ideasowners.net/wp-content/uploads/2016/03/128x128-2.jpg',
            'large_icon' => 'http://ideasowners.net/wp-content/uploads/2016/03/128x128-2.jpg',
            'big_picture' => 'http://ideasowners.net/wp-content/uploads/2016/03/128x128-2.jpg',
//            'buttons' => json_encode([["id" => "id1", "text" => "button1", "icon" => "ic_launcher"], ["id" => "id2", "text" => "button2", "icon" => "ic_launcher"]])
        ];

        $fields = json_encode($fields);
//        print("\nJSON sent:\n");
//        print($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ODQ3NWE0ZTMtZjQ2ZS00MjVmLWFlYTItMDcwNThmNTU5MTVm'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

        $response = curl_exec($ch);
        curl_close($ch);

//        $return["allresponses"] = $response;
//        $return = json_encode($return);
//
//        print("\n\nJSON received:\n");
//        print($return);
//        print("\n");
//
//	$response = sendMessage();
//	$return["allresponses"] = $response;
//	$return = json_encode( $return);
//
//  print("\n\nJSON received:\n");
//	print($return);
//  print("\n");

    }

    public function authJWT()
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (!$user) {

            return response()->json(['message' => 'you not authorized for such action'], 505);

        }
        return $user;
    }
}