<?php
namespace App\Services;

use App\Contracts\EmailInterface;
use App\Contracts\UploadFile;
use App\Http\Resources\StudentCollection;
use App\Http\Resources\Student as StudentResource;
use App\Mail\SendEmail;
use App\Services\StudentInterface;
use App\Student;
use App\User;
use DB;

class StudentServices implements StudentInterface
{
    protected $model;
    protected $email;
    protected $fileImage;
    public function __construct(Student $model,EmailInterface $email,UploadFile $fileImage)
    {
        $this->model=$model;
        $this->email=$email;
        $this->fileImage = $fileImage;
    }

    public function getAll()
    {
        $students = $this->model->all();
        return StudentResource::collection($students);
    }
    public function showById($id)
    {
        $student = $this->model
            ->find($id);
        return new StudentResource($student);
    }
    public function updateData(array $data, $id)
    {
        DB::beginTransaction();
        try{
                if(isset($data['image'])){
                    $newImage = $this->fileImage->uploadImage($data['image']);
                    $data['image']=$newImage;
                }
                $this->model
                    ->where('id','=',$id)
                    ->update($data);
                DB::commit();
                return new StudentResource($this->showById($id));
        }catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error'=>$exception->getMessage()],500);
        }
    }
    public function deleteData($id)
    {
        try{
            $this->model
                ->where('id',$id)
                ->delete();
        }catch (\Exception $exception){
            return response()->json(['error'=>$exception->getMessage()],500);
        }

    }
    public function storeDataWithUploadFileAndSendEmail(array $data)
    {
        DB::beginTransaction();
        try{
            $student = $this->model->create([
                'first_name'=>$data['first_name'],
                'last_name'=>$data['last_name'],
            ]);
            $this->email->SendEmail($data['email'],new SendEmail($data['first_name'].$data['last_name']));
            DB::commit();
            return new StudentResource($student);
        }
        catch (\Exception $exception){
            DB::rollBack();
            return response()->json(['error'=>$exception->getMessage()],500);
        }
    }
}
