<?php

namespace CDI\EnfermeriaBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use CDI\EnfermeriaBundle\Entity\Consultas;
use CDI\EnfermeriaBundle\Form\ConsultasType;

use CDI\EnfermeriaBundle\Entity\SignosVitalesSuministrados;
use CDI\EnfermeriaBundle\Entity\MedicamentosSuministrados;
use CDI\EnfermeriaBundle\Entity\Medicamentos;
use CDI\EnfermeriaBundle\Entity\InsumosSuministrados;
use CDI\EnfermeriaBundle\Entity\ObservacionesSuministradas;
use CDI\EnfermeriaBundle\Entity\Insumos;


/**
 * Consultas controller.
 *
 * @Route("/consultas")
 */
class ConsultasController extends Controller
{

    /**
     * Lists all Consultas entities.
     *
     * @Route("/", name="consultas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('EnfermeriaBundle:Consultas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Consultas entity.
     *
     * @Route("/", name="consultas_create")
     * @Method("POST")
     * @Template("EnfermeriaBundle:Consultas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Consultas();
         //Objeto del Usuario que suministro
        $emUsuario= $this->getDoctrine()->getManager();
        $entityUsuario = $emUsuario->getRepository('EnfermeriaBundle:Usuarios')->find($this->get('security.context')->getToken()->getUser());
        
        
        
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        //echo ("<pre>");        debug_zval_dump($request); echo("</pre>"); die;
        
        if ($form->isValid()) {
            $entity->setFecha(new \DateTime("now"));   
            $entity->setUsuarios($entityUsuario);          
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('consultas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Consultas entity.
    *
    * @param Consultas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Consultas $entity)
    {
        $form = $this->createForm(new ConsultasType(), $entity, array(
            'action' => $this->generateUrl('consultas_create'),
            'method' => 'POST',
            'attr' => array('class' => 'form-horizontal'),
        ));

        $form->add('submit', 'submit', array('label' => 'Registrar','attr' => array('class' => 'btn btn-primary')));

        return $form;
    }

    /**
     * Displays a form to create a new Consultas entity.
     *
     * @Route("/new", name="consultas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Consultas();
        $form   = $this->createCreateForm($entity);

      
        
        return array(
            'entity' => $entity,           
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Consultas entity.
     *
     * @Route("/{id}", name="consultas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Consultas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Consultas entity.
     *
     * @Route("/{id}/edit", name="consultas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
               
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('EnfermeriaBundle:Consultas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultas entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);
        
        //Signos Vitales Suministrados
        $entitySignosVitalesSuministrados = new SignosVitalesSuministrados();
        $em = $this->getDoctrine()->getManager();
        $entitySignosVitalesSuministrados = $em->getRepository('EnfermeriaBundle:SignosVitalesSuministrados')->findByConsulta($id);

        
        //LISTA DE MEDICAMENTOS
        $em = $this->getDoctrine()->getManager();
        $entityMedicamentos = $em->getRepository('EnfermeriaBundle:Medicamentos')->findAll();
        //debug_zval_dump($entityMedicamentos); die;
        
        //medicamentos Suministrados
        $entityMedicamentosSuministrados = new MedicamentosSuministrados();
        $em = $this->getDoctrine()->getManager();
        $entityMedicamentosSuministrados = $em->getRepository('EnfermeriaBundle:MedicamentosSuministrados')->findByConsulta($id);
        
        
        //Insumos Suministrados
        $entityInsumosSuministrados = new InsumosSuministrados();
        $em = $this->getDoctrine()->getManager();
        $entityInsumosSuministrados = $em->getRepository('EnfermeriaBundle:InsumosSuministrados')->findByConsulta($id);
        
        
           //Observaciones Suministradas
        $entityObservacionesSuministradas = new ObservacionesSuministradas();
        $em = $this->getDoctrine()->getManager();
        $entityObservacionesSuministradas = $em->getRepository('EnfermeriaBundle:ObservacionesSuministradas')->findByConsulta($id);
        
        //Lista de insumos 
        $emInsumos = $this->getDoctrine()->getManager();
        $insumos = $emInsumos->getRepository('EnfermeriaBundle:Insumos')->findAll();
        
        return array(
            'Medicamentos' => $entityMedicamentos,
            'SignosVitalesSuministrados' => $entitySignosVitalesSuministrados,
            'MedicamentosSuministrados' => $entityMedicamentosSuministrados,
            'insumos' => $insumos,
            'InsumosSuministrados' => $entityInsumosSuministrados,
            'ObservacionesSuministradas' => $entityObservacionesSuministradas,
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
         
        );
    }

    /**
    * Creates a form to edit a Consultas entity.
    *
    * @param Consultas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Consultas $entity)
    {
        $form = $this->createForm(new ConsultasType(), $entity, array(
            'action' => $this->generateUrl('consultas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
            'attr' => array('class' => 'form-horizontal'),
        ));

        $form->add('submit', 'submit', array('label' => 'Actualizar','attr' => array('class' => 'btn btn-primary')));

        return $form;
    }
    /**
     * Edits an existing Consultas entity.
     *
     * @Route("/{id}", name="consultas_update")
     * @Method("PUT")
     * @Template("EnfermeriaBundle:Consultas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)           
    {
 
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('EnfermeriaBundle:Consultas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Consultas entity.');
        }
        
         //Objeto del Usuario que suministro
        $emUsuario= $this->getDoctrine()->getManager();
        $entityUsuario = $emUsuario->getRepository('EnfermeriaBundle:Usuarios')->find($this->get('security.context')->getToken()->getUser());
        
        //Medicamentos
        $medSuministrados=$this->get('request')->request->get('cdi_enfermeriabundle_medicamentossuministrados');       
        
        if ($medSuministrados['medicamento']!="") {
           //Objeto medicamento       
        $emMedicamento= $this->getDoctrine()->getManager();
        $entityMedicamento = $emMedicamento->getRepository('EnfermeriaBundle:Medicamentos')->find($medSuministrados['medicamento']);
                       
        //Objeto Medicamento Suministrado
        $medicamentoSuministrado = new MedicamentosSuministrados();
        $medicamentoSuministrado->setMedicamento($entityMedicamento);
        $medicamentoSuministrado->setCantidad($medSuministrados['cantidad']);
        $medicamentoSuministrado->setViaAdministracion($medSuministrados['viaAdministracion']);
        $medicamentoSuministrado->setConsulta($entity);
        $medicamentoSuministrado->setUsuario($entityUsuario);
        $medicamentoSuministrado->setFecha(new \DateTime("now"));
        $emMedicamento->persist($medicamentoSuministrado);
        $emMedicamento->flush();         
        }
        
        
        
        
        //Insumos
        $insSuministrados=$this->get('request')->request->get('cdi_enfermeriabundle_insumossuministrados');       
        
        if ($insSuministrados['insumo']!="") {
        //Objeto de Insumos 
        $emInsumo= $this->getDoctrine()->getManager();
        $entityInsumo= $emInsumo->getRepository('EnfermeriaBundle:Insumos')->find($insSuministrados['insumo']);

        //Objeto Insumos Suministrados
        $insumoSuministrado = new InsumosSuministrados();
        $insumoSuministrado->setInsumo($entityInsumo);
        $insumoSuministrado->setCantidad($insSuministrados['cantidad']);
        $insumoSuministrado->setFecha(new \DateTime("now"));
        $insumoSuministrado->setConsulta($entity);
        $insumoSuministrado->setUsuario($entityUsuario);
        $emInsumo->persist($insumoSuministrado);
        $emInsumo->flush();
        }
        
        //Observaciones
        $obsSuministradas=$this->get('request')->request->get('cdi_enfermeriabundle_observacionessuministradas');       
         
        if ($obsSuministradas['tipo']!="") {
        
         //Objeto Observaciones Suministradas
        $observacionSuministrada = new ObservacionesSuministradas();
        $observacionSuministrada->setTipo($obsSuministradas['tipo']);
        $observacionSuministrada->setDescripcion($obsSuministradas['descripcion']);
        $observacionSuministrada->setFecha(new \DateTime("now"));
        $observacionSuministrada->setConsulta($entity);
        $observacionSuministrada->setUsuario($entityUsuario);
        $em->persist($observacionSuministrada);
        $em->flush();
         }
          //Signos Vitales
        $svSuministrados=$this->get('request')->request->get('cdi_enfermeriabundle_signosvitalessuministrados');       
        
          if ($svSuministrados['nombre']!="") {
         //Objeto Signos Vitales
        $signoSuministrado = new SignosVitalesSuministrados();
        $signoSuministrado->setValor($svSuministrados['valor']);
        $signoSuministrado->setNombre($svSuministrados['nombre']);
        $signoSuministrado->setFecha(new \DateTime("now"));
        $signoSuministrado->setConsulta($entity);
        $signoSuministrado->setUsuario($entityUsuario);
        $em->persist($signoSuministrado);
        $em->flush();
          }
        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('consultas_edit', array('id' => $id)));
        }
       

        return array(
            'entity'      => $entity,            
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Consultas entity.
     *
     * @Route("/{id}", name="consultas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('EnfermeriaBundle:Consultas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Consultas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('consultas'));
    }

    /**
     * Creates a form to delete a Consultas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('consultas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn')))
            ->getForm()
        ;
    }
}
