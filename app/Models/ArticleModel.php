<?php

namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'article';
    protected $allowedFields = [
        'title', 'slug', 'lang', 'text'
    ];
    protected $returnType    = \App\Entities\Article::class;
    protected $useTimestamps = true;
}
