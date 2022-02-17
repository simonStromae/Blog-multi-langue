<?php

namespace App\Controllers;

use App\Models\ArticleModel;


class Post extends BaseController
{
    private $more = [
        "fr" => "Lire Plus",
        "en" => "Read More",
        "de" => "Mehr lesen",
        "es" => "Leer más",
        "ja" => "続きを読む",
    ];

    private $titlePage = [
        "fr" => "Mon Blog",
        "en" => "My Blog",
        "de" => "Mein Blog",
        "es" => "Mi blog",
        "ja" => "マイブログ",
    ];

    public function allPosts($lang)
    {
        $articleModel = new ArticleModel();

        $data = [
            'posts' => $articleModel->where('lang', $lang)->orderBy('updated_at', 'desc')->findAll(),
            'more' => $this->more[$lang],
            'title_page' => $this->titlePage[$lang],
            'lang' => $lang
        ];

        return view('posts/index', $data);
    }

    public function details($id, $lang){
        $articleModel = new ArticleModel();

        $data = [
            'post' => $articleModel->find($id),
            'title_page' => $this->titlePage[$lang],
        ];

        return view('posts/details', $data);
    }

    public function addPost(){
        $data = [
            'title_page' => $this->titlePage["fr"],
            'langs' => ['fr' => 'FR', 'en' => 'EN', 'es' => 'ESP', 'de' => 'DE', 'ja' => 'JAP']
        ];
        return view('posts/create', $data);
    }

    public function savePost(){
        if ($this->request->getMethod() === 'post' && $this->validate([
            'titre' => 'required|min_length[3]|max_length[255]',
            'langue'  => 'required',
            'contenu'  => 'required',
        ])) {
            //initialize article model
            $articleModel = new ArticleModel();

            //save post in database
            $articleModel->insert([
                'title' => $this->request->getPost('titre'),
                'lang' => $this->request->getPost('langue'),
                'slug'  => url_title($this->request->getPost('titre'), '-', true),
                'text'  => $this->request->getPost('contenu'),
            ]);

            $this->showFlashMessage("success", "Ajout article effectuée avec succèss");
            return redirect()->route("posts", [$this->request->getPost('langue')]);
        } else {
            $data = [
                'title_page' => $this->titlePage["fr"],
                'langs' => ['fr' => 'FR', 'en' => 'EN', 'es' => 'ESP', 'de' => 'DE', 'ja' => 'JAP']
            ];

            return view('posts/create', $data);
        }
    }

    public function editPost($id)
    {
        $articleModel = new ArticleModel();

        $data = [
            'post' => $articleModel->find($id),
            'title_page' => $this->titlePage["fr"],
            'langs' => ['fr' => 'FR', 'en' => 'EN', 'es' => 'ESP', 'de' => 'DE', 'ja' => 'JAP']
        ];
        return view('posts/edit', $data);
    }

    public function updatePost($id){
        //initialize article model
        $articleModel = new ArticleModel();
            
        if ($this->request->getMethod() === 'put' && $this->validate([
            'titre' => 'required|min_length[3]|max_length[255]',
            'langue'  => 'required',
            'contenu'  => 'required',
        ])) {
            //save post in database
            $articleModel->update($id, [
                'title' => $this->request->getPost('titre'),
                'lang' => $this->request->getPost('langue'),
                'slug'  => url_title($this->request->getPost('titre'), '-', true),
                'text'  => $this->request->getPost('contenu'),
            ]);

            $this->showFlashMessage("success", "Modification article effectuée avec succèss");
            return redirect()->route("posts", [$this->request->getPost('langue')]);
        } else {
            $data = [
                'title_page' => $this->titlePage["fr"],
                'langs' => ['fr' => 'FR', 'en' => 'EN', 'es' => 'ESP', 'de' => 'DE', 'ja' => 'JAP'],
                'post' => $articleModel->find($id)
            ];

            return view('posts/edit', $data);
        }
    }

    public function deletePost($id)
    {
        //initialize recipe and ingredient model
        $articleModel = new ArticleModel();

        //delete recipe
        $articleModel->delete($id);

        $this->showFlashMessage("success", "Suppression de l'article #" . $id . " effectuée avec succèss");
        return redirect()->route("posts", ['fr']);
    }

    private function showFlashMessage($messageType, $message)
    {

        $session = session();
        $session->setFlashdata('messageType', $messageType);
        $session->setFlashdata('message', $message);
    }
}
