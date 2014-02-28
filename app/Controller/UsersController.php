<?php
class UsersController extends AppController {
     
    public function index() {
         
    }
 
    public function login() {
    	$this->layout = 'login';
    }
     
    public function logout() {

    }

    public function teste(){
    	$this->layout = '';
    }
}
?>