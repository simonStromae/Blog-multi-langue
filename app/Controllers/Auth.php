<?php

namespace App\Controllers;

use App\Models\RecipeModel;
use App\Models\UserModel;

class Auth extends BaseController
{
    public function register()
    {
        return view('auth/register');
    }

    public function create(){
        $inputs = $this->validate([
            'username' => 'required|min_length[5]|is_unique[users.username]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[5]'
        ]);

        if (!$inputs) {
            return view('auth/register', [
                'validation' => $this->validator
            ]);
        }

        $userModel = new UserModel();
        $userModel->save([
            'username' => $this->request->getVar('username'),
            'email'  => $this->request->getVar('email'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        $this->showFlashMessage('success', 'Enregistrement réussi');
        return redirect()->route('login');
    }

    public function login()
    {
        return view('auth/login');
    }

    public function loginValidate(){
        $inputs = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]'
        ]);

        if (!$inputs) {
            return view('auth/login', [
                'validation' => $this->validator
            ]);
        }

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if ($user) {

            $pass = $user->password;
            $authPassword = password_verify($password, $pass);

            if ($authPassword) {
                $sessionData = [
                    'id' => $user->id,
                    'username' => $user->username,
                    'email' => $user->email,
                    'loggedIn' => true,
                ];

                $session = session();
                $session->set($sessionData);

                $this->showFlashMessage('success', 'Bienvenue Mr/Mme '.$user->username);
                return redirect()->route('posts', ['fr']);
            }

            $this->showFlashMessage('error', 'Erreur ! Mot de passe incorrect');
            return redirect()->route('login');
        }

        $this->showFlashMessage('error', 'Erreur ! Email incorrect');
        return redirect()->route('login');
    }

    public function profile(){
        $data = [
            'title_page' => "Mon Profil",
        ];
        return view('auth/profile', $data);
    }

    public function updateProfile(){
        $data = [
            'title_page' => "Mon Profil",
        ];

        $inputs = $this->validate([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]'
        ]);

        if (!$inputs) {
            return view('auth/profile', [
                'validation' => $this->validator,
                'title_page' => $data['title_page']
            ]);
        }

        $userModel = new UserModel();
        $userModel->update($this->request->getVar('user_id'), [
            'email'  => $this->request->getVar('email'),
            'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        $session = session();
        $session->set('email', $this->request->getVar('email'));

        $this->showFlashMessage('success', 'Mise à jour réussie');
        return redirect()->route('profile', [$data]);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->route('home');
    }


    private function showFlashMessage($messageType, $message)
    {

        $session = session();
        $session->setFlashdata('messageType', $messageType);
        $session->setFlashdata('message', $message);
    }
}
