<?php

namespace App\Http\Controllers;

use App\Project;
use App\Company;
use App\ProjectUser;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $projects = Project::where('user_id',Auth::user()->id)->get();
            return view('projects.index',['projects'=>$projects]);
        }else{
            return view('auth.login');
        }
    }


    //add project user function.

    public function adduser(Request $request){
        $project = Project::find($request->input('project_id'));
            if(Auth::user()->id == $project->user_id){
                $user = User::where('email',$request->input('email'))->first();

                //checking if the user has already beeen added to the project users.
                $projectuser = ProjectUser::where('user_id',$request->input('user_id'))
                                                ->where('project_id',$project->id)->first();
                if($projectuser){
                    return redirect()->route('projects.show',['project'=>$project->id]);
                }

                if ($user && $project){
                $project->users()->attach($user->id);
                    return redirect()->route('projects.show',['project'=>$project->id]);
            }
        }

        return redirect()->route('projects.show',['project'=>$project->id])->with('errors','Error adding user to Project');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($company_id = null)
    {
        $companies = null;
        if(!$company_id){
            $companies = Company::where('user_id',Auth::user()->id)->get();
        }
        return view('projects.create',['company_id'=>$company_id,'companies'=>$companies]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //function to add new Project to the database.
    public function store(Request $request)
    {
        //Function to authenticate and store elements in the database.
        if(Auth::check()){
            $Projects = Project::create([
                'name' =>$request->input('projectName'),
                'days' =>$request->input('projectDuration'),
                'company_id' =>$request->input('company_id'),
                'description' =>$request->input('description'),
                'user_id' =>Auth::user()->id
            ]);
        }
//       /* dd($Projects);*/
        //If storage Successful re-route to the list of projects page.
        if($Projects){
            /*$data = [
                'project' => $Projects,
            ];*/

           // dd($Projects->id);
            return redirect(url('sample/'.$Projects->id));
            //return  view('projects.show',$data);
//            return redirect()->route('projects.show',compact('Projects'))
//                ->with('success','Project Created Successfully');
        }

        return back()->withInput->with('errors','Error creating New Project');
    }

    public function sample($id){
        $project = Project::find($id);
        $comments = $project->comments;
        $data = [
            'comments' => $comments,
            'project' => $project,
        ];
        return view('projects.show',$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response,
     */
    public function show(Project $project)
    {
        // $Project = Project::where('id',$Project->id)->first();
        $project = Project::find($project->id);
        $comments = $project->comments;

        return view('projects.show',['project'=>$project,'comments'=>$comments]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $project = Project::find($project->id);
        return view('projects.edit',['project'=>$project]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $Project)
    {
        //save data
        $ProjectUpdate = Project::where('id',$Project->id)
            ->update([
                'days' => $request->input('ProjectDuration'),
                'description'=>$request->input('description'),
                'name'=>$request->input('ProjectName')
            ]);
        if($ProjectUpdate){


           //return redirect()->route('projects.show',['Project'=>$Project])->with('success','Project updated Successfully');
            return redirect(url('sample/'.$Project->id));
        }


        //route Back or Return incase it fails.
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $Project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $Project)
    {
        //Find Project.....
        $findProject = Project::find($Project->id);

        //Redirection after successful deleting.
        if ($findProject = $Project->delete()){
            return redirect('projects')->with('success','Project Deleted Successfully');
        }
        else{
            return back()->withInput()->with('error','projects could not be deleted');
        }
    }
}
