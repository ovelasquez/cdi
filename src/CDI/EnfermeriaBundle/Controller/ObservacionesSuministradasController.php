<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\ObservacionesSuministradas;
use CDI\EnfermeriaBundle\Form\ObservacionesSuministradasType;

/**
 * ObservacionesSuministradas controller.
 *
 * @Route("/observacionessuministradas")
 */
class ObservacionesSuministradasController extends Controller
{

    /**
     * Lists all ObservacionesSuministradas entities.
     *
     * @Route("/", name="observacionessuministradas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new ObservacionesSuministradas entity.
     *
     * @Route("/", name="observacionessuministradas_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:ObservacionesSuministradas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ObservacionesSuministradas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $entity->setFecha(new \DateTime("now"));
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('observacionessuministradas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ObservacionesSuministradas entity.
    *
    * @param ObservacionesSuministradas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ObservacionesSuministradas $entity)
    {
        $form = $this->createForm(new ObservacionesSuministradasType(), $entity, array(
            'action' => $this->generateUrl('observacionessuministradas_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        return $form;
    }

    /**
     * Displays a form to create a new ObservacionesSuministradas entity.
     *
     * @Route("/new", name="observacionessuministradas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new ObservacionesSuministradas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a ObservacionesSuministradas entity.
     *
     * @Route("/{id}", name="observacionessuministradas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObservacionesSuministradas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing ObservacionesSuministradas entity.
     *
     * @Route("/{id}/edit", name="observacionessuministradas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObservacionesSuministradas entity.');
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
    * Creates a form to edit a ObservacionesSuministradas entity.
    *
    * @param ObservacionesSuministradas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ObservacionesSuministradas $entity)
    {
        $form = $this->createForm(new ObservacionesSuministradasType(), $entity, array(
            'action' => $this->generateUrl('observacionessuministradas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

       return $form;
    }
    /**
     * Edits an existing ObservacionesSuministradas entity.
     *
     * @Route("/{id}", name="observacionessuministradas_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:ObservacionesSuministradas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ObservacionesSuministradas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $user = $this->get('security.context')->getToken()->getUser();            
            $entity->setUsuario($user);
            $em->flush();

            return $this->redirect($this->generateUrl('observacionessuministradas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a ObservacionesSuministradas entity.
     *
     * @Route("/{id}", name="observacionessuministradas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ObservacionesSuministradas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('observacionessuministradas'));
    }

    /**
     * Creates a form to delete a ObservacionesSuministradas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('observacionessuministradas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
