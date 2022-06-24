<?php

namespace App\Http\Controllers;
use App\Module;
use App\Role;
use App\Rolemodule;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    //
    public function new_role(){
        // return Module::all();
        return view('rolesmodule.newrole',[
            'roles' => Module::all()]);
    }
    public function list_role(){
        return view('rolesmodule.rolelisting',[
             'activerole' => Role::all()]
        );
    }

    public function modulelist_role($roleid,$modulelist_role){

        return view('rolesmodule.rolemoldules',[
            'modules' => Module::all(),
             'rolemodules' => Rolemodule::where(['role_id'=>$roleid])->get(),
             'roleid' => $roleid,
             'modulename'=>$modulelist_role
             ]);
    }
    public function saverole(Request $request){
        $moduleids =  explode(",",$request->selected);

       // return $moduleids;
        if(count($moduleids) == 1 && $moduleids[0] == "ID " || $moduleids[0] == ""){
            return view('rolesmodule.newrole',[
                'error' => 'Please select atlist 1 module to assign to the newly created role.',
                'roles' => Module::all()]);
            
        }else{

            
            if(Role::where(['rol_name'=>$request->name])->count() == 0){
                $role = new Role();
                $role->rol_name = $request->name;

                if($role->save()){
                   
                   // $index = 0;

                        for($index = 0; $index < count($moduleids) ; $index++){
                            if($moduleids[$index] != "ID "){
                                $rolemodule = new Rolemodule();
                                $rolemodule->role_id = $role->id;
                                $rolemodule->module_id = $moduleids[$index];

                                if(!$rolemodule->save())
                                {
                                    return view('rolesmodule.newrole',[
                                        'error' => 'Please check if the user role is created and try to add desired modules 1 by 1.',
                                        'roles' => Module::all()]);
                                }
                                
                            }
                        }
                        return view('rolesmodule.newrole',[
                            'sucess' => 'User role is successfully created.',
                            'roles' => Module::all()]);

                }else{
                    return view('rolesmodule.newrole',[
                        'error' => 'There was an error while saving a user role.',
                        'roles' => Module::all()]);
                }

            }else{
                return view('rolesmodule.newrole',[
                    'error' => 'Role name exists. Please use another user role name.',
                    'roles' => Module::all()]);

            }
        }

        return $aray[0];

            
        
                return $modules[0];
            return $request->all();
            return view('rolesmodule.newrole',[
                'roles' => Module::all()]);
    }

    public function updaterole(Request $request){
        $moduleids =  explode(",",$request->selected);

        if(count($moduleids) == 1 && $moduleids[0] == "ID " || $moduleids[0] == ""){
            return view('rolesmodule.rolemoldules',[
                    'modules' => Module::all(),
                     'rolemodules' => Rolemodule::where(['role_id'=>$request->roleid])->get(),
                     'roleid' => $request->roleid,
                     'error' => 'A role should atlist have 1 module. Please select atlist 1 module.',
                     'modulename'=>$request->modulename]);
            
        }

        $count = Rolemodule::where(['role_id'=>$request->roleid])->count();
        $proceed = false;

        //return $count;

        if($count > 0){
            if(!Rolemodule::where(['role_id'=>$request->roleid])->delete()){
                return view('rolesmodule.rolemoldules',[
                    'modules' => Module::all(),
                     'rolemodules' => Rolemodule::where(['role_id'=>$request->roleid])->get(),
                     'roleid' => $request->roleid,
                     'error'=> 'There was an error while saving the modules for a role',
                     'modulename'=>$request->modulename
                     
                     ]);
        

            }else{
                $proceed = true;
            }

        }else{
            $proceed = true;
        }

        if($proceed )
        {
            //return $moduleids;
            for($index = 0; $index < count($moduleids) ; $index++){
                if($moduleids[$index] != "ID "){
                    $rolemodule = new Rolemodule();
                    $rolemodule->role_id = $request->roleid;
                    $rolemodule->module_id = $moduleids[$index];

                    if(!$rolemodule->save())
                    {
                        return view('rolesmodule.rolemoldules',[
                            'modules' => Module::all(),
                             'rolemodules' => Rolemodule::where(['role_id'=>$request->roleid])->get(),
                             'roleid' => $request->roleid,
                             'error'=> 'There was an error while saving the modules for a role',
                             'modulename'=>$request->modulename
                             
                             ]);
                    }
                    
                }
            }
            return view('rolesmodule.rolemoldules',[
                'modules' => Module::all(),
                 'rolemodules' => Rolemodule::where(['role_id'=>$request->roleid])->get(),
                 'roleid' => $request->roleid,
                 'sucess'=> 'Role module successfully updated.',
                 'modulename'=>$request->modulename
                 
                 ]);
        }

        return view('rolesmodule.rolemoldules',[
            'modules' => Module::all(),
             'rolemodules' => Rolemodule::where(['role_id'=>$request->roleid])->get(),
             'roleid' => $request->roleid,
             'error'=> 'There was an error while saving the modules for a role',
             'modulename'=>$request->modulename
             
             ]);

    }

    public function updaterolename(Request $request){

        if(Role::where(['rol_name'=>$request->rolename])->count() == 0){
            $role = Role::where(['id'=>$request->id])->first();
            $role->rol_name = $request->rolename;

            if($role->save()){
                return view('rolesmodule.rolelisting',[
                    'sucess' => 'Role name is successfully updated.',
                    'activerole' => Role::all()]);

            }else{
                return view('rolesmodule.rolelisting',[
                    'error' => 'There was an error while saving a user role.',
                    'activerole' => Role::all()]);

            }
        }else{
            return view('rolesmodule.rolelisting',[
                'error' => 'Role name exists. Please use another user role name.',
                'activerole' => Role::all()]);

        }
        
    }

    public function removerolename(Request $request){
        
                if(Role::where(['id'=>$request->id])->count() == 1){
                  
                    if(Role::where(['id'=>$request->id])->delete()){
                        Rolemodule::where(['role_id'=>$request->id])->delete();
                        return view('rolesmodule.rolelisting',[
                            'sucess' => 'Role is successfully deleted.',
                            'activerole' => Role::all()]);
        
                    }else{
                        return view('rolesmodule.rolelisting',[
                            'error' => 'There was an error while deleting a user role.',
                            'activerole' => Role::all()]);
                    }
                }else{
                    return view('rolesmodule.rolelisting',[
                        'error' => 'Role does not exist.',
                        'activerole' => Role::all()]);
        
                }
                
            }
}
