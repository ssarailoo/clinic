<?php

namespace Models;


use AllowDynamicProperties;
use Core\Application;

#[AllowDynamicProperties] class Doctor extends User
{
    public string $education='';
    public string $profile_pic='';
    public string $address='';

    public string $section_id='';
    public string $medical_code='';
    public string  $is_active='';
    public  string $is_completed='';

    public static function tableName(): string
    {
        return 'doctors';
    }
    public function rules(): array
    {
        return array_merge( parent::rules(),[
            'medical_code'=>[self::RULE_REQUIRED],
            'education'=>[self::RULE_REQUIRED],
            'profile_pic'=>[self::RULE_REQUIRED]]);
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