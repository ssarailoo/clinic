<?php

namespace Models;


use AllowDynamicProperties;
use Core\Application;

class Doctor extends User
{
    public string $education='';
    public string $profile_pic='';
    public string $address='';

    public ?string $section_id=null;
    public string $medical_code='';
    public string  $is_active='';
    public  string $is_completed='';

    public static function tableName(): string
    {
        return 'doctors';
    }


    public function labels(): array
    {
        return array_merge([
                'education' => 'Education',
                'medical_code' => 'Medical Code',
                'profile_pic' => 'Profile Picture'
            ]
            , parent::labels());
    }

    public function profilePic(array $file, string $filename)
    {

        $name = $file['name'];
        if (!is_dir(Application::$ROOT_DIR . "/Public/Storage/users/doctors/$filename"))
            mkdir(Application::$ROOT_DIR . "/Public/Storage/users/doctors/$filename");
        move_uploaded_file($file['tmp_name'], Application::$ROOT_DIR . "/Public/Storage/users/doctors/$filename/" . time() . "$name");
        return  "./Storage/users/doctors/$filename/" . time() . "$name";

    }



}