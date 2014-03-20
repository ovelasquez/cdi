<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\SignosVitalesSuministrados;
use CDI\EnfermeriaBundle\Form\SignosVitalesSuministradosType;

/**
 * SignosVitalesSuministrados controller.
 *
 * @Route("/signosvitalessuministrados")
 */
class SignosVitalesSuministradosController extends Controller
{

    /**
     * Lists all SignosVitalesSuministrados entities.
     *
     * @Route("/", name="signosvitalessuministrados")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new SignosVitalesSuministrados entity.
     *
     * @Route("/", name="signosvitalessuministrados_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:SignosVitalesSuministrados:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new SignosVitalesSuministrados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $entity->setFecha(new \DateTime("now"));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('signosvitalessuministrados_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a SignosVitalesSuministrados entity.
    *
    * @param SignosVitalesSuministrados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(SignosVitalesSuministrados $entity)
    {
        $form = $this->createForm(new SignosVitalesSuministradosType(), $entity, array(
            'action' => $this->generateUrl('signosvitalessuministrados_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

       return $form;
    }

    /**
     * Displays a form to create a new SignosVitalesSuministrados entity.
     *
     * @Route("/new", name="signosvitalessuministrados_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new SignosVitalesSuministrados();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a SignosVitalesSuministrados entity.
     *
     * @Route("/{id}", name="signosvitalessuministrados_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SignosVitalesSuministrados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing SignosVitalesSuministrados entity.
     *
     * @Route("/{id}/edit", name="signosvitalessuministrados_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SignosVitalesSuministrados entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a SignosVitalesSuministrados entity.
    *
    * @param SignosVitalesSuministrados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(SignosVitalesSuministrados $entity)
    {
        $form = $this->createForm(new SignosVitalesSuministradosType(), $entity, array(
            'action' => $this->generateUrl('signosvitalessuministrados_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }
    /**
     * Edits an existing SignosVitalesSuministrados entity.
     *
     * @Route("/{id}", name="signosvitalessuministrados_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:SignosVitalesSuministrados:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find SignosVitalesSuministrados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $em->flush();

            return $this->redirect($this->generateUrl('signosvitalessuministrados_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a SignosVitalesSuministrados entity.
     *
     * @Route("/{id}", name="signosvitalessuministrados_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find SignosVitalesSuministrados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('signosvitalessuministrados'));
    }

    /**
     * Creates a form to delete a SignosVitalesSuministrados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('signosvitalessuministrados_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
