<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use App\Traits\ApiResponser; // Import the ApiResponser trait
use DB;

class UserController extends Controller
{
    use ApiResponser;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Retrieve all users from the database.
     */
    public function getUsers()
    {
        $users = DB::connection('mysql')->select("SELECT * FROM tbl_user");
        
        // return response()->json($users, 200);
        return $this->successResponse($users);
    }

    /**
     * Retrieve all users using Eloquent ORM.
     */
    public function index()
    {
        $users = User::all();

        // Alternative return formats:
        // return response()->json($users, 200);
        // return response()->json(['data' => $users, 'site' => 1], 200);
        // return response()->json(['data' => $users], 200);

        return $this->successResponse($users);
    }
    public function add (Request $request){
        $rules =[

        'username' => 'required|max:20',
        'password' => 'required|max:20',
        'gender' => 'required|max:20',
        ];
        
        $this ->validate($request,$rules);

        $user = User::create($request->all());

        return $this->successResponse($user, Response::HTTP_CREATED);
    }
}
