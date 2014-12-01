<?php

namespace Stevebauman\Maintenance\Controllers;

use Illuminate\Support\Facades\Session;
use Stevebauman\Maintenance\Controllers\BaseController;

class PermissionDeniedController extends BaseController {
    
    public function getIndex(){
        if(Session::get('message')) {
            
            if($this->isAjax()){
                
                $this->message = 'You do not have access to perform this function';
                $this->messageType = 'danger';
                return $this->response();
                
            } else{
            
                return $this->view('maintenance::permission-denied', array(
                    'title'=>'Permission Denied'
                ));
            }
            
        } else {
            $this->redirect = route('maintenance.dashboard.index');
            
            return $this->response();
        }
    }
    
}