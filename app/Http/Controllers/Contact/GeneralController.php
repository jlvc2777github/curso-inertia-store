<?php

namespace App\Http\Controllers\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Contact\General;
use App\Models\ContactGeneral;
use Illuminate\Http\Request;
use Inertia\Inertia;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd("index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
     
        Inertia::share('step',getStep());
     //   return inertia("Contact/General/Save");
        return inertia("Contact/General/Step");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(General $request)
    {
       // dd($request);
        $contactGeneral= ContactGeneral::create($request->validated());
        return to_route('contact-general.edit',['contact_general'=>$contactGeneral->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ContactGeneral $contactGeneral)
    {
     
        //dd($contactGeneral);

        Inertia::share('step',getStep($contactGeneral));

        $contactGeneral->company;
        $contactGeneral->person;
        $contactGeneral->detail;
        if($contactGeneral->company==null){
            unset($contactGeneral->company);
        } 
        if($contactGeneral->person==null){
            unset($contactGeneral->person);
        } 
        if($contactGeneral->detail==null){
            unset($contactGeneral->detail);
        } 
       // return inertia("Contact/General/Save",compact('contactGeneral'));
        return inertia("Contact/General/Step",compact('contactGeneral'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(General $request, ContactGeneral $contactGeneral)
    {
       
        //dd("$request");
        $contactGeneral->update($request->validated());
        return to_route('contact-general.edit',['contact_general'=>$contactGeneral->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
