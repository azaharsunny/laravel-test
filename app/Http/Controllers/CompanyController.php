<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use Exception;
use Session;
use Redirect;


class CompanyController extends Controller
{

    public function index()
    {
        $data['title'] = "Company List";
        $data['companies'] = Company::paginate(10);
        return view('companies.listing',$data);
    }

    public function show($id) {

    }

    public function edit($id) {
        try{
            $data['title'] = "Edit Company";
            $data['details'] = Company::find($id);
            return view('companies.edit',$data);
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }

    public function update (Request $request, $id)
    {
        try{
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:50|min:3',
                'email' => 'required|unique:companies,email,'.$id,
                'website'   => 'required',
                'image'   =>'image',

            ]);
            if ($validation->fails()) {
                return redirect()->back()->withInput($request->input())
                ->withMessage($validation->errors()->first());
            }
            $comapny = Company::find($id);
            $comapny->name = $request->name;
            $comapny->email = $request->email;
            $comapny->website = $request->website;
                if($request->hasFile('image')){
                    $destination = "public/images/logos";
                    $image = $request->file('image');
                    $image_name = $image->getClientOriginalName();
                    $path = $request->file('image')->storeAs($destination,$image_name);
                    $comapny->logo = $image_name;
                 }
            $comapny->save();
            return redirect()->back()->withSuccess("Data has been successfully Updated.");
        }catch(\Exception $e){
            return redirect()->back()->withMessage($e->getMessage());
        }
    }

    public function create()
    {
        $data['title'] = "Add New Companyy";
        return view('companies.add',$data);
    }

    public function store(Request $request) {
        try
        {
            $validation = Validator::make($request->all(), [
                'name' => 'required|max:50|min:3',
                'email' => 'required|unique:companies,email',
                'website'   => 'required',
                'image'   =>'required|image',

            ]);
            if ($validation->fails()) {
                return redirect()->back()->withInput($request->input())
                ->withMessage($validation->errors()->first());
            }
            $comapny = new Company;
            $comapny->name = $request->name;
            $comapny->email = $request->email;
            $comapny->website = $request->website;

            $destination = "public/images/logos";
            $image = $request->file('image');
            $image_name = $image->getClientOriginalName();
            $path = $request->file('image')->storeAs($destination,$image_name);
            $comapny->logo = $image_name;
            $comapny->save();
            return redirect()->back()->withSuccess("Data has been successfully inserted.");

        }catch(\Exception $e){
            return redirect()->back()->withInput($request->input())
            ->withMessage($e->getMessage());
        }
    }

    public function destroy($id)
    {
        try{
            Company::where('id',$id)->delete();
            return redirect()->back()->withSuccess("Data has been successfully Deleted.");
    }catch(\Exception $e){
        return redirect()->back()->withMessage($e->getMessage());
    }

    }


}
