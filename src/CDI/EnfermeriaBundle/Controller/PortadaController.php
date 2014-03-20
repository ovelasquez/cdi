<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PortadaController extends Controller
{

    public function indexAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('EnfermeriaBundle:Portada:index.html.twig');
    }
    
    public function despedidaAction()
    {
        /*
         * The action's view can be rendered using render() method
         * or @Template annotation as demonstrated in DemoController.
         *
         */
        return $this->render('EnfermeriaBundle:Portada:despedida.html.twig');
    }
}
