<?php

namespace Controller;

use Model\Patient;
use Model\User;
use Src\Request;
use Src\View;
use Src\Auth\Auth;

class Site
{
    public function patient(): string
    {
        $patients = Patient::all();
        return (new View())->render('site.patient', ['patients' => $patients]);
    }

    // public function doctor(): string
    // {
    //     $patients = Patient::all();
    //     $doctors = Doctor::where('Name', app()->auth->doctor()->Name)->first();
    //     return (new View())->render('site.doctor', ['doctors' => $doctors]);
    // }

    // public function registerPatient(Request $request): string
    // {
    //     $role_id = 1;
    //     $administrator = Administrator::all();

    //     if($_POST[''])
    // }

    // public function indx(Request $request): string
    // {
    //     $patients = Patient::where('ID_patient', $request->ID_patient)->get();
    //     return (new View())->render('site.patient', ['patients' => $patients]);
    // }

    public function hello(): string
    {
        return new View('site.hello', ['message' => 'hello working']);
    }

    public function signup(Request $request): string
    {
        if ($request->method === 'POST' && Doctor::create($request->all())) {
            app()->route->redirect('/hello');
        }
        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }
        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

    
}

