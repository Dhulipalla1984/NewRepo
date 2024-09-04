<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//Route::middleware('auth:api')->get('/users', [UserController::class, 'index']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::middleware('auth:sanctum')->get('/users', [UserController::class, 'index']);
// Route::post('/login', [UserController::class, 'login']);
//Route::get('/users', [UserController::class, 'index']);
// Route::get('/test', function() {
//     return 'Route is working';
// });
// Route::get('/users/{id}', [UserController::class, 'show']);
// Route::post('/articles', [ArticleController::class, 'store']);
// Route::put('/articles/{id}', [ArticleController::class, 'update']);
// Route::delete('/articles/{id}', [ArticleController::class, 'destroy']);
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::get('users', [UserController::class, 'Index']);
    Route::post('logout', [AuthController::class, 'logout']);
});

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::post('/tokens/create', function (Request $request) {
//     $token = $request->user()->createToken($request->token_name);
 
//     return ['token' => $token->plainTextToken];
// });

// Route::post('/login', function (Request $request) {
//     // Assuming you're using email and password for authentication
//     $credentials = $request->only('email', 'password');

//     // Attempt to authenticate the user
//     if (Auth::attempt($credentials)) {
//         // Get the authenticated user
//         $user = Auth::user();
//          // Revoke all previous tokens
//          $user->tokens()->delete();
//         // Create a token for the user
//         $token = $user->createToken('YourAppName')->plainTextToken;
       

        
//         // Return the token as a response
//         return response()->json(['token' => $token]);
//     } else {
//         // Authentication failed
//         return response()->json(['error' => 'Unauthorized'], 401);
//     }
// });
