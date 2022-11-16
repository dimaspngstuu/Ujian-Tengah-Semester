<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patients;

class PatientsController extends Controller
{
    //get resource patients
    public function index(){

        //mengambil semua data di database dengan method all();
        $patients = Patients::all();

        $data = [
            "message"=>"data patients today",
            "data"=>$patients
        ];

        return response()->json($patients,200);
    }

    //create new patients
    public function store(Request $request){

        $entryData = [
            "name"=>$request->name,
            "phone"=>$request->phone,
            "address"=>$request->address,
            "status"=>$request->status
        ];

        //crete data into sql
        $patient = Patients::create($entryData);


        $data = [
            "message"=>"data patients is created",
            "data"=>$patient
        ];


        return response()->json($data,201);
    }

    //get detail patients
    public function show($id){

        //method for get detail patient
        $patient = Patients::find($id);

        if($patient){
            $data = [
                "message" => "details data patients",
                "data"=>$patient
            ];

            return response()->json($data,200);
        }else {
            $data = [
                "message" => "data is not found"
            ];

            return response()->json($data,404);
        }
    }

    //edit or update patients
    public function update(Request $request,$id){
        $pasien = Patients::find($id);


        if($pasien){
            $entryData = [
                'name'=>$request->name,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'status'=>$request->status
            ];

            //update data passien
            $pasien->update($entryData);


            $data = [
                "message"=>"data is a change",
                "data"=>$pasien
            ];

            return response()->json($data,200);

        } else {
            $data =  [
                "message"=>"data not found"
            ];

            return response()->json($data,404);
        }
    }

    //delete data patients
    public function destroy($id){

        //method for delete patient
        $pasien = Patients::find($id);

        if($pasien){
            $pasien->delete();

            $data = [
                "message"=>"patients deleted"
            ];

            
            return response()->json($data,200);

        }else {
            $data = [
                "message"=>"patients not found"
            ];

            return response()->json($data,404);
        }
    }
}
