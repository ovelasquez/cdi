<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Pacientes;
use CDI\EnfermeriaBundle\Entity\Datos;
use CDI\EnfermeriaBundle\Form\PacientesType;

/**
 * Pacientes controller.
 *
 * @Route("/pacientes")
 */
class PacientesController extends Controller
{

    /**
     * Lists all Pacientes entities.
     *
     * @Route("/", name="pacientes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Pacientes')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pacientes entity.
     *
     * @Route("/", name="pacientes_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Pacientes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pacientes();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        
        if ($form->isValid()) {
            $entity->setFechaRegistro(new \DateTime("now"));
            
            $entity->setFechaNacimiento(new \DateTime($entity->getFechaNacimiento()));      
            
            //echo '<pre>';            debug_zval_dump($entity);       echo '</pre>'; die;
            
            $em = $this->getDoctrine()->getManager();            
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pacientes_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Pacientes entity.
    *
    * @param Pacientes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pacientes $entity)
    {
        $form = $this->createForm(new PacientesType(), $entity, array(
            'action' => $this->generateUrl('pacientes_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Pacientes entity.
     *
     * @Route("/new", name="pacientes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($id = Null)
    {
        //$id = $request->request->get('id'); echo 'ID: '.$id; die;
        
        $entity = new Pacientes();
        
        $entity_datos= New Datos;
        
        $em = $this->getDoctrine()->getManager();
        
        if ($id!=Null) {
            
            $entity_datos = $em->getRepository('EnfermeriaBundle:Datos')->find($id);
            
            if (!$entity_datos) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
            } else {
                
                $entity->setDatos($entity_datos);
            }
        }

        
        
        $form   = $this->createCreateForm($entity);
        
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pacientes entity.
     *
     * @Route("/{id}/edit", name="pacientes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $entity = new Pacientes();
        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
        }

        $date = $entity->getFechaNacimiento();
        $fecha = $date->format('d-m-Y');
        $entity->setFechaNacimiento($fecha);
        
        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Pacientes entity.
    *
    * @param Pacientes $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pacientes $entity)
    {
        $form = $this->createForm(new PacientesType(), $entity, array(
            'action' => $this->generateUrl('pacientes_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

       return $form;
    }
    /**
     * Edits an existing Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Pacientes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pacientes entity.');
        }

       
        $deleteForm = $this->createDeleteForm($id);
        
        $date = $entity->getFechaNacimiento();
        
        $fecha = $date->format('d-m-Y');
        
        $entity->setFechaNacimiento($fecha);
        
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
             $entity->setFechaNacimiento(new \DateTime($entity->getFechaNacimiento())); 
            $em->flush();

            return $this->redirect($this->generateUrl('pacientes_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pacientes entity.
     *
     * @Route("/{id}", name="pacientes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Pacientes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pacientes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pacientes'));
    }

    /**
     * Creates a form to delete a Pacientes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pacientes_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
    
}
