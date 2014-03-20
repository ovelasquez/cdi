<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Pacientes;
use CDI\EnfermeriaBundle\Entity\Consultas;
use CDI\EnfermeriaBundle\Entity\Datos;

/**
 * Consultas controller.
 *
 * @Route("/verificar")
 */
class VerificarController extends Controller {

    /**
     * Verificar si el paciente existe
     * @Method("GET")
     * @Template()
     */
    public function indexAction() {

        return $this->render('EnfermeriaBundle:Verificar:index.html.twig');
    }

    /**
     * @Method("POST")    
     */
    public function createAction(Request $request) {

        //echo 'QK';        die();
        $reqe = $request->request->all();
        $cedula = $reqe["cedula"];

        // Verificamos si la persona esta registrada
        $estaRegistrado = new Datos();

        $estaRegistrado = "
                    SELECT d 
                    FROM  EnfermeriaBundle:Datos d 
                    WHERE d.cedula='" . $cedula . "'";

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery($estaRegistrado);
        $estaRegistrado = $query->getResult();

        //        echo ("<pre>"); debug_zval_dump($estaRegistrado); echo("</pre>"); die;
        //Si no esta registrado lo creamos como un Paciente                                
        if (!$estaRegistrado) {
            return $this->redirect($this->generateUrl('pacientes_new'));
        } else {

            // Si esta registrados entonces Verificamos si es un Paciente         
            $esPaciente = new Pacientes();
            $esPaciente = "
                    SELECT p
                    FROM EnfermeriaBundle:Pacientes p
                    WHERE p.datos = " . $estaRegistrado[0]->getId();
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($esPaciente);
            $esPaciente = $query->getResult();

//                echo ("<pre>"); debug_zval_dump($esPaciente); echo("</pre>"); die;
            // Si no es un Paciente lo registramos como paciente y le pasamos el ID de sus Datos
            if (!$esPaciente) {
                //   $response = $this->forward('EnfermeriaBundle:Pacientes:new', array('id' => $estaRegistrado[0]->getId()));
                //   return $response;
                return $this->redirect($this->generateUrl
                                        ('pacientes_new', array('id' => $estaRegistrado[0]->getId())
                                )
                );
            }


            // Si es Paciente y tiene una consulta activa 
            $tieneConsulta = new Consultas();
            $tieneConsulta = "
                    SELECT c
                    FROM EnfermeriaBundle:Consultas c
                    WHERE c.egreso=false and c.paciente = " . $esPaciente[0]->getId();
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery($tieneConsulta);
            $tieneConsulta = $query->getResult();

            // echo '<h1> Tiene Consulta </h1>';echo ("<pre>"); debug_zval_dump($tieneConsulta); echo("</pre>"); die;
            //Cuando generamos una nueva consulta
            // Si tiene consulta y egreso=true
            // Si no tiene consulta
            //Cuando generamos un editar consulta
            //Si tiene consulta y egreso=true


            if (!$tieneConsulta) {
                //Objeto del Usuario que suministro

               

                $em = $this->getDoctrine()->getManager();
                $entityUsuario = $em->getRepository('EnfermeriaBundle:Usuarios')->find($this->get('security.context')->getToken()->getUser());
                $entityPaciente = $em->getRepository('EnfermeriaBundle:Pacientes')->find($esPaciente[0]->getId());

                $consulta = new Consultas();
                $consulta->setCharla(false);
                $consulta->setEgreso(false);
                $consulta->setFecha(new \DateTime("now"));
                $consulta->setPaciente($entityPaciente);
                $consulta->setUsuarios($entityUsuario);
                $em->persist($consulta);
                $em->flush();


                $response = $this->forward('EnfermeriaBundle:Consultas:edit', array('id' => $consulta->getId()));
                return $response;
            } else {

                //Consulta Editar
                $response = $this->forward('EnfermeriaBundle:Consultas:edit', array('id' => $tieneConsulta[0]->getId()));
                return $response;
            }
        }
    }

}
