<?php
   namespace App\Controller;

   use Symfony\Component\HttpFoundation\Response;
   use Symfony\Component\HttpFoundation\Request;
   use Symfony\Component\Routing\Annotation\Route;

   use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
   use Symfony\Bundle\FrameworkBundle\Controller\Controller;

   use Symfony\Component\Form\Extension\Core\Type\TextType;
   use Symfony\Component\Form\Extension\Core\Type\SubmitType;

   use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

   use App\Entity\Employee;
   use App\Entity\User;

class EmployeeController extends Controller{
    
    /** 
        * @Route("/employee", name = "employee_list")
        * @Method({"GET"})
        
    */
    // * @Security("is_granted('ROLE_ADMIN')")
    public function index() {
        //$this->denyaccessunlessgranted('IS_AUTHENTICATED_REMEMBERED');
        //$user = $this.getUser();
        //$users = $this->getDoctrine()->getRepository(User::class)->findAll();
        $employees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        return $this->render('employees/index.html.twig', array('employees' => $employees));
    }

    /** 
        * @Route("/employee/view/{id}", name = "employee_view")
    */
    public function view($id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        return $this->render('employees/view.html.twig', array('employee' => $employee));
    }

    /** 
        * @Route("/employee/delete/{id}", name = "employee_delete")
        * @Method({"DELETE"})
    */
    public function delete($id) {
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($employee);
        $entityManager->flush();
          
        $response = new Response();
        $response->send();
    }

    /** 
        * @Route("/employee/add", name = "employee_add")
        * Method({"GET", "POST"})
    */
    public function new(Request $request){
        $employee = new Employee();
        $form = $this->createFormBuilder($employee)
                ->add('firstName', TextType::class, array(
                    'attr' => array('class' => 'form-control')))
                ->add('middleName', TextType::class, array(
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('lastName', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('division', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('position', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Add', 
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->getForm();

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()){
                    $employee = $form->getData();
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->persist($employee);
                    $entityManager->flush();
                    return $this->redirectToRoute('employee_list');
                }

                return $this->render('employees/new.html.twig', array(
                    'form' => $form->createView()));
    }

    /** 
        * @Route("/employee/edit/{id}", name = "employee_edit")
        * Method({"GET", "POST"})
    */
    public function edit(Request $request, $id){
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $form = $this->createFormBuilder($employee)
                ->add('firstName', TextType::class, array(
                    'attr' => array('class' => 'form-control')))
                ->add('middleName', TextType::class, array(
                    'required' => false,
                    'attr' => array('class' => 'form-control')
                ))
                ->add('lastName', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('division', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('position', TextType::class, array(
                    'attr' => array('class' => 'form-control')
                ))
                ->add('save', SubmitType::class, array(
                    'label' => 'Save', 
                    'attr' => array('class' => 'btn btn-primary')
                ))
                ->getForm();

                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()){
                  
                    $entityManager = $this->getDoctrine()->getManager();
                    $entityManager->flush();

                    return $this->redirectToRoute('employee_list');
                }

                return $this->render('employees/edit.html.twig', array(
                    'form' => $form->createView()));
    }

}