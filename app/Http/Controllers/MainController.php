<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{

    //
    public function test()
    {
        return response()->json([
            "message" => "Тест амжилттай. Сервертэй холбогдлоо."
        ]);
    }

    public function registration(Request $request)
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        $messages = [
            'unique' => 'Албан тушаалын нэр давхацсан байна. Өөр албан тушаалын нэр оруулна уу.',
            'required' => 'Энэ талбар хоосон байж болохгүй.',
            'max' => 'Тэмдэгтийн тоо хэтэрсэн байна.',
            'email' => 'И-мэйл хаяг алдаатай байна. Бодит и-мэйл хаяг оруулна уу.',
            'min' => 'Нууц үгэнд хамгийн багадаа 8 тэмдэгт шаардлагатай.',
            'confirmed' => 'Нууц үг баталгаажуугүй байна.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                "message" => "failed",
            ])->withErrors($validator);
        }

        DB::table('users')->insert(
            ['name' => $request->input('name'),
            'email' => $request->input('email'),
            'email_verified_at' => null,
            'password' => Hash::make($request->input('password')),
            'is_admin' => ($request->input('is_admin')) ? 1 : 0,
            'remember_token' => Str::random(60),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()]
        );

        return response()->json([
            "message" => "success",
            "name" => $request->input('name')
        ]);
    }

    public function profiledit(Request $request){
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
         $messages = [
            'unique' => 'Албан тушаалын нэр давхацсан байна. Өөр албан тушаалын нэр оруулна уу.',
            'required' => 'Энэ талбар хоосон байж болохгүй.',
            'max' => 'Тэмдэгтийн тоо хэтэрсэн байна.',
            'email' => 'И-мэйл хаяг алдаатай байна. Бодит и-мэйл хаяг оруулна уу.',
            'min' => 'Нууц үгэнд хамгийн багадаа 8 тэмдэгт шаардлагатай.',
            'confirmed' => 'Нууц үг баталгаажуугүй байна.',
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        DB::table('users')->where('id', $request->input('id'))->update(
            ['name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'updated_at' => Carbon::now()]
        );

        return response()->json([
            "message" => "success",
            "name" => $request->input('name')
        ]);
    }

    public function getotherusers(Request $request){
        $userid = $request->input('id');

        $usersData = DB::table('users')
            ->select('name', 'email', 'is_admin', 'created_at', 'id')
            ->where('id', '!=', $userid)->get();

        return response()->json([$usersData]);
    }

    public function deletion(Request $request){
        $userid = $request->input('id');
        $name = $request->input('name');
        DB::table('users')->where('id', $userid)->delete();
        return response()->json([
            "message" => "success",
            "name" => $name
        ]);
    }
}
