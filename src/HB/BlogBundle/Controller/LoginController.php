<?php

namespace HB\BlogBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Security\Core\SecurityContext;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LoginController
 *
 * @author hb
 */
class LoginController extends Controller {


/**
 * Lists all User entities.
 * 
 *@Route("/login", name="login")
 *l'annotation ci dessous permet de spécifier que l'action est lié directement au template
 *@Template()
 */
public function loginAction()
{
    $request = $this->getRequest();
    $session = $request->getSession();
    // get the login error if there is one
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
        $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
        $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
        $session->remove(SecurityContext::AUTHENTICATION_ERROR);
    }
    
    
    
    return array(
    // last username entered by the user
    'last_username' => $session->get(SecurityContext::LAST_USERNAME),
    'error' => $error,
    );
}


}

