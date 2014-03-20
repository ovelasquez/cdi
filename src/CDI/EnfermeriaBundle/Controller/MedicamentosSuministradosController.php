<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\MedicamentosSuministrados;
use CDI\EnfermeriaBundle\Form\MedicamentosSuministradosType;

/**
 * MedicamentosSuministrados controller.
 *
 * @Route("/medicamentossuministrados")
 */
class MedicamentosSuministradosController extends Controller
{

    /**
     * Lists all MedicamentosSuministrados entities.
     *
     * @Route("/", name="medicamentossuministrados")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new MedicamentosSuministrados entity.
     *
     * @Route("/", name="medicamentossuministrados_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:MedicamentosSuministrados:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new MedicamentosSuministrados();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $entity->setFecha(new \DateTime("now"));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('medicamentossuministrados_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a MedicamentosSuministrados entity.
    *
    * @param MedicamentosSuministrados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(MedicamentosSuministrados $entity)
    {
        $form = $this->createForm(new MedicamentosSuministradosType(), $entity, array(
            'action' => $this->generateUrl('medicamentossuministrados_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));
        
        return $form;
    }

    /**
     * Displays a form to create a new MedicamentosSuministrados entity.
     *
     * @Route("/new", name="medicamentossuministrados_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new MedicamentosSuministrados();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a MedicamentosSuministrados entity.
     *
     * @Route("/{id}", name="medicamentossuministrados_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedicamentosSuministrados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing MedicamentosSuministrados entity.
     *
     * @Route("/{id}/edit", name="medicamentossuministrados_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedicamentosSuministrados entity.');
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
    * Creates a form to edit a MedicamentosSuministrados entity.
    *
    * @param MedicamentosSuministrados $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(MedicamentosSuministrados $entity)
    {
        $form = $this->createForm(new MedicamentosSuministradosType(), $entity, array(
            'action' => $this->generateUrl('medicamentossuministrados_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }
    /**
     * Edits an existing MedicamentosSuministrados entity.
     *
     * @Route("/{id}", name="medicamentossuministrados_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:MedicamentosSuministrados:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find MedicamentosSuministrados entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $em->flush();

            return $this->redirect($this->generateUrl('medicamentossuministrados_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a MedicamentosSuministrados entity.
     *
     * @Route("/{id}", name="medicamentossuministrados_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find MedicamentosSuministrados entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('medicamentossuministrados'));
    }

    /**
     * Creates a form to delete a MedicamentosSuministrados entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('medicamentossuministrados_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
