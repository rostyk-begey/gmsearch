<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

use App\Company;
use Illuminate\Http\Request;

class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public static function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $companies = Company::latest()->paginate($perPage);
        } else {
            $companies = Company::latest()->paginate($perPage);
        }

        return view('admin.companies', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('directory.companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        //Company::create($requestData);

        if ($request->hasFile('logo')) {
            // cache the file
            $file = $request->file('logo');

            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();

            // save to storage/app/photos as the new $filename
            $path = $file->storeAs('public/images', $filename);

            $requestData['logo'] = $path;
            //dd($path);
            /***********************************/
            /*$image      = $request->file('logo');
            $fileName   = time() . '.' . $image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(120, 120, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->stream('jpg'); // <-- Key point

            //dd();
            //Storage::disk('local')->put($fileName, $img, 'public/storage/');
            Storage::putFile('images', new File($image->getRealPath()));
            //$request->logo->storeAs('public/images',$fileName);*/
        }

        Company::create($requestData);

        //return redirect('admin/companies')->with('flash_message', 'Company added!');
        return redirect('/admin/companies')->with('flash_message', 'Company added!');//.$path);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $company = Company::findOrFail($id);

        return view('directory.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $companies = [$company];

        return view('admin.companies', compact('companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $company = Company::findOrFail($id);

        $file = $company->logo;
        Storage::delete( $file );

        if ($request->hasFile('logo')) {
            // cache the file
            $file = $request->file('logo');

            // generate a new filename. getClientOriginalExtension() for the file extension
            $filename = 'profile-photo-' . time() . '.' . $file->getClientOriginalExtension();

            // save to storage/app/photos as the new $filename
            $path = $file->storeAs('public/images', $filename);

            $requestData['logo'] = $path;
        }

        $company->update($requestData);

        $companies = Company::all();

        return redirect('admin/companies')->with('flash_message', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $file = Company::find($id)->logo;
        //$filename = Input::get('logo');


        Storage::delete( $file );
        Company::destroy($id);
        return redirect('admin/companies')->with('flash_message', 'Company deleted!');//.public_path('/images' . $file));
    }
}
