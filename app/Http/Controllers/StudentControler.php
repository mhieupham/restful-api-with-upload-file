<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentCollection;
use App\Mail\SendEmail;
use Illuminate\Http\Request;
use App\Services\StudentInterface;
use Illuminate\Support\Facades\Mail;
class StudentControler extends Controller
{
    //
    private $student ;
    public function __construct(StudentInterface $student)
    {
        $this->student = $student;
    }
    public function index(){
        $student = $this->student->getAll();
        return response()->json($student);
//        return new StudentCollection($student);
    }
    public function show($id){
        $student = $this->student->showById($id);
        return response()->json($student);
    }
    public function store(StudentRequest $request){
        $data = $this->student->storeDataWithUploadFileAndSendEmail($request->only('first_name','last_name','image'));
        return response()->json($data,201);
    }
    public function update(StudentRequest $request,$id){
        $student= $this->student->updateData($request->only('first_name','last_name','image'),$id);
        return response()->json($student,200);
    }
    public function destroy($id){
        $this->student->deleteData($id);
        $student = $this->student->getAll();
        return response()->json($student,200);
    }
}
