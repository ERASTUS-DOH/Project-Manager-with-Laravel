<?php

namespace App\Http\Controllers;

use App\company;
use foo\bar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $companies = Company::where('user_id',Auth::user()->id)->get();
            return view('companies.index',['companies'=>$companies]);
        }else{
            return view('auth.login');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //function to add new company to the database.
        if(Auth::check()){
            $company = Company::create([
                'name' =>$request->input('companyName'),
                'description' =>$request->input('description'),
                'user_id' =>Auth::user()->id
            ]);
        }

        if($company){
            return redirect()->route('companies.show',['company'=> $company->id])
                ->with('success','Company Created Successfully');
        }

        return back()->with('errors','Error creating New Company');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(company $company)
    {
        //
       // $company = Company::where('id',$company->id)->first();
        $company = Company::find($company->id);
        return view('companies.show',['company'=>$company]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(company $company)
    {
        $company = Company::find($company->id);
        return view('companies.edit',['company'=>$company]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, company $company)
    {
        //save data
        $companyUpdate = Company::where('id',$company->id)
            ->update([

                'description'=>$request->input('description'),
                'name'=>$request->input('companyName')
            ]);
        if($companyUpdate){
            return redirect()->route('companies.show',['company'=>$company->id])->with('success','Company updated Successfully');
        }


        //route Back or Return incase it fails.
        return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(company $company)
    {
        //Find company.....
        $findCompany = Company::find($company->id);

        //Redirection after successful deleting.
        if ($findCompany = $company->delete()){
            return redirect('companies')->with('success','Company Deleted Successfully');
        }
        else{
            return back()->withInput()->with('error','Companies could not be deleted');
        }
    }
}
