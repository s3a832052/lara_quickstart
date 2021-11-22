<?php

use Illuminate\Support\Facades\Route;
use App\Models\Task;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
   $tasks=Task::orderby('create_at','asc')->get();
   return view('tasks',['tasks'=>$tasks]);
});


Route::post('/task', function (Request $request) {
    //驗證輸入
    $validator=Validator::make($request->all(),[
        'name'=>'required|max255',
    ]);
    if($validator->fails()){
        return redirect('/')
            ->withInput()
            ->withErrors($validator);

        $task=new Task;
        $task->name=$request->name;
        $task->save();
        return redirect('/');
    }
});

Route::delete('/task/{task}', function (Task $task) {
    //
});
