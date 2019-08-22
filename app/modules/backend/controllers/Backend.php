<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Backend extends MY_Controller{


  function index()
  {
    redirect(site_url("backend/home"),"refresh");
  }




}
