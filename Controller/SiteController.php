<?php

namespace Controller;

use Core\Application;
use Core\Controller;
use Core\Request;
use Core\Response;
use Models\ContactForm;

class SiteController extends Controller
{
    public function home(): false|array|string
    {
        return $this->render('home');
    }

    public function contact(Request $request, Response $response): false|array|string
    {
        $this->setLayout('no-nav');
        $contact = new ContactForm();

        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                $response->redirect('/contact');
            }
        }

        return $this->render('contact', [
            'model' => $contact
        ]);
    }


}