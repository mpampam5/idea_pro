<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH."/modules/backend/core/MY_Controller.php";

class Home extends MY_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Pohon_model','model');
    $this->load->library(array("btree"));
  }

  function index()
  {
    $this->template->set_title('Home');
    $data['balance'] = $this->balance->total_balance(sess('id_member'));
    $data['comission']  = $this->balance->sponsor(sess('id_member'));
    $data['deposit'] = $this->balance->deposit(sess('id_member'));
    $data['withdraw'] = $this->balance->withdraw(sess('id_member'));
    $data['referral'] = $this->balance->referral(profile('kode_referral'));
    $data['left_group'] = $this->btree->leftcount(sess('id_member'));
    $data['right_group'] = $this->btree->rightcount(sess('id_member'));
    $data['pin_terpakai'] = $this->balance->cek_pin_terpakai(sess('id_member'));
    $data['stok_pin'] = $this->balance->stok_pin(sess('id_member'));
    $data['total_order_pin'] = $this->balance->total_order_pin(sess('id_member'));
    $this->template->view('index',$data);
  }




}
