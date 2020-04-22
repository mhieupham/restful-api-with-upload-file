<?php
namespace App\Services;


interface StudentInterface
{
    public function getAll();
    public function showById($id);
    public function updateData(array $data,$id);
    public function deleteData($id);
    public function storeDataWithUploadFileAndSendEmail(array $data);
}
