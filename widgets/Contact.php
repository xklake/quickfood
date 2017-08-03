<?php
namespace frontend\web\template\quickfood\widgets;
use yii; 
use yii\base\Widget;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BreadcrumbsEx
 *
 * @author jli1
 */
class Contact extends Widget {
    public function run()
    {
        return $this->render('contact');
    }    
}
