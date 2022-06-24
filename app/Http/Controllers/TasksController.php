<?php
/**
 * Created by PhpStorm.
 * User: kamut
 * Date: 17/09/2018
 * Time: 08:19
 */

namespace App\Http\Controllers;


use App\Task;
use App\Taskdescription;
use App\User;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function newTask(){

        $tasks = Task::all();
        $complete_taskinfo = [];

        foreach ($tasks as $taskinfo){
            $user = User::where('id',$taskinfo->userid)->get(['name','lastname']);
            array_push($complete_taskinfo,['emp_name'=>$user[0]->name.' '.$user[0]->lastname,
                'taskname'=>$taskinfo->name,
                'taskdescription'=>$taskinfo->description,
                'startdate'=>$taskinfo->startdate,
                'enddate'=>$taskinfo->end,
                'status'=>$taskinfo->status,
                'id'=>$taskinfo->id]);
        }

        return view('tasks.new',['newtask'=>'',
            'tasks'=>$complete_taskinfo,
            'users'=>User::all()]);
    }

    public function listtask(){

        $tasks = Task::all();
        $complete_taskinfo = [];

        foreach ($tasks as $taskinfo){
            $user = User::where('id',$taskinfo->userid)->get(['name','lastname']);
            array_push($complete_taskinfo,['emp_name'=>$user[0]->name.' '.$user[0]->lastname,
                'taskname'=>$taskinfo->name,
                'taskdescription'=>$taskinfo->description,
                'startdate'=>$taskinfo->startdate,
                'enddate'=>$taskinfo->end,
                'status'=>$taskinfo->status,
                'id'=>$taskinfo->id]);
        }

        return view('tasks.new',[
            'tasks'=>$complete_taskinfo,
            'users'=>User::all()]);
    }

    public function saveTask(Request $request){

        $task = new Task();
        $begining = date_format(date_create($request->startdate),"Y/m/d");
        $end = date_format(date_create($request->enddate),"Y/m/d");
        $task->userid = $request->userid;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->startdate = $begining;
        $task->end = $end;
        $task->status = 0;

        if($task->save()){
            $tasks = Task::all();
            $complete_taskinfo = [];

            foreach ($tasks as $taskinfo){
                $user = User::where('id',$taskinfo->userid)->get(['name','lastname']);
                array_push($complete_taskinfo,['emp_name'=>$user[0]->name.' '.$user[0]->lastname,
                    'taskname'=>$taskinfo->name,
                    'taskdescription'=>$taskinfo->description,
                    'startdate'=>$taskinfo->startdate,
                    'enddate'=>$taskinfo->end,
                    'status'=>$taskinfo->status,
                    'id'=>$taskinfo->id]);
            }

            return view('tasks.new',['newtask'=>'',
                'tasks'=>$complete_taskinfo,
                'users'=>User::all(),
                'sucess'=>'Employee task is successfully saved.']);
        }
    }

    public function getTask(Request $request){
        $data = json_decode($request->getContent(), true);
        $id = $data['id'];
        return Response()->json(['error'=>'0',
            'tasks'=>Task::where('userid',$id)->get()]);
    }

    public function updateTask(Request $request){

        $data = json_decode($request->getContent(), true);
        $task = Task::find($data['id']);
        $task->status = $data['status'];
        if($task->save()){
            $taskdescriptions = new Taskdescription();
            $taskdescriptions->taskid = $data['id'];
            $taskdescriptions->comment = $data['comment'];

            if($taskdescriptions->save()){

                if(isset($data["pic"])) {
                    $image = $data["pic"];
                    $image = str_replace('data:image/png;base64,', '', $image);
                    $image = str_replace(' ', '+', $image);
                    $imageName = $taskdescriptions->id .rand(1000,100000). '.png';
                    \File::put(public_path() . '/' . $imageName, base64_decode($image));
                    $taskdescriptions->pic = $imageName;
                    if ($taskdescriptions->save()) {
                    }
                }

                return Response()->json(['error'=>'0',
                    'msg'=>'Task Status is successfully saved.']);
            }

        }else{
            return Response()->json(['error'=>'1',
                'msg'=>'There was an error updating your task.']);
        }
    }

    public  function  specifictask($id,$name){
        $taskinfor = Task::find($id);
        $taskdescription = Taskdescription::where('taskid',$id)->get();
        return view('tasks.specific',
            ['task'=>$taskinfor,
                'name'=>$name,
                'taskdescr'=>$taskdescription]);
    }
}