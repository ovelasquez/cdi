<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Pfg;
use CDI\EnfermeriaBundle\Form\PfgType;

/**
 * Pfg controller.
 *
 * @Route("/pfg")
 */
class PfgController extends Controller
{

    /**
     * Lists all Pfg entities.
     *
     * @Route("/", name="pfg")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Pfg')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Pfg entity.
     *
     * @Route("/", name="pfg_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Pfg:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pfg();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('pfg_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Pfg entity.
    *
    * @param Pfg $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Pfg $entity)
    {
        $form = $this->createForm(new PfgType(), $entity, array(
            'action' => $this->generateUrl('pfg_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new Pfg entity.
     *
     * @Route("/new", name="pfg_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pfg();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pfg entity.
     *
     * @Route("/{id}", name="pfg_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pfg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pfg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Pfg entity.
     *
     * @Route("/{id}/edit", name="pfg_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pfg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pfg entity.');
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
    * Creates a form to edit a Pfg entity.
    *
    * @param Pfg $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pfg $entity)
    {
        $form = $this->createForm(new PfgType(), $entity, array(
            'action' => $this->generateUrl('pfg_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));
        
        return $form;
    }
    /**
     * Edits an existing Pfg entity.
     *
     * @Route("/{id}", name="pfg_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Pfg:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Pfg')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pfg entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('pfg_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pfg entity.
     *
     * @Route("/{id}", name="pfg_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Pfg')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pfg entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pfg'));
    }

    /**
     * Creates a form to delete a Pfg entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pfg_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
