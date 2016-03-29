<?php

namespace App\Controller;

use Sifoni\Controller\Base;

class HomeController extends Base {

    public function helloAction($name) {
        $data['name'] = $name;
        return $this->render('home.html.twig', $data);
    }
}