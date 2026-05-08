<?php

namespace App\Models;

use CodeIgniter\Model;

class CompanyModel extends Model
{
    //protected $table = 'company';
    //protected $allowedFields = ['title', 'slug', 'body'];

    public function getNews($slug = false)
    {
        if ($slug === false) {
            return $this->findAll();
        }

        return $this->where(['slug' => $slug])->first();
    }
}


?>