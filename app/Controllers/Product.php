<?php


namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Product extends Controller
{

    public function index(){
        // print_r("You are here");
        // $this->load->view('welcome_message.php');
        echo view('templates/header');
        echo view('products/create');
    }





}