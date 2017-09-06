<?php
namespace app\index\controller;

class Index
{
    public function index()
    {	
        return 'mmp';
    }
   public function login($id)
   {
   	 	return 'nihao:'.$id;
   }
}
