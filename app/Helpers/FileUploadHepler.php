<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;

class FileUploadHepler
{

    public function getName($file)
    {
        if (is_array($file)) {
            return $this->setNames($file);
        }
        return $this->setName($file);
    }

    public function setName($file)
    {
        $ext     = $file->extension();
        $timestamp = strtotime(date('Y-m-d H:i:s'));
        $name  = uniqid() . "_{$timestamp}.{$ext}";
        return $name;
    }

    public function setNames($files)
    {
        $names  = [];
        foreach ($files as $file) {
            $ext = $file->extension();
            $timestamp = strtotime(date('Y-m-d H:i:s'));
            $name  = uniqid() . "_{$timestamp}.{$ext}";
            $names[] = $name;
        }
        return $names;
    }

    public function upLoadSignle($file, $path)
    {
        $name                   = $this->setName($file);
        $destinationPath        =  $path . '/' . uniqid();
        $pathFile               = $file->storeAs($destinationPath, $name);
        $dataFile               = [
            'avatar'            =>  Storage::url($pathFile)
        ];

        return $dataFile;
    }

    public function uploadMutiple($files, $path)
    {
        $names  = $this->setNames($files);
        $dataFiles = [];
        foreach ($files as $key => $file) {
            $destinationPath   = $path . '/' . uniqid();
            $pathFile               = $file->storeAs($destinationPath, $names[$key]);
            $dataFile               = [
                'avatar'                =>  Storage::url($pathFile)
            ];
            $dataFiles[] = $dataFile;
        }
        return $dataFiles;
    }

    public function upload($file, $path)
    {
        if (is_array($file)) {
            return $this->uploadMutiple($file, $path);
        }
        return $this->upLoadSignle($file, $path);
    }

    public function deleteFiles($files)
    {
        $converFiles = collect($files);
        $converFiles->each(function ($file) {
            if (file_exists(public_path($file))) {
                unlink(public_path($file));
            }
        });
        return true;
    }

    public function deleteFile($file)
    {
        if (file_exists(public_path($file))) {
            unlink(public_path($file));
        }
    }

    public function delete($file)
    {
        if (is_array($file)) {
            return $this->deleteFiles($file);
        }
        return $this->deleteFile($file);
    }
}

