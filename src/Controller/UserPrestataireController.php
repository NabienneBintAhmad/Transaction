<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Compte;
use App\Entity\Admin;
use App\Form\UserType;
use App\Entity\Prestataire;
use App\Repository\PrestataireRepository;
use App\Entity\UserPrestataire;
use App\Form\UserPrestataireType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserPrestataireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\VarExporter\Internal\Values;

/**
 * @Route("/api")
 */
class UserPrestataireController extends AbstractController
{
    /**
     * @Route("/", name="user_prestataire_index", methods={"GET"})
     */
    public function index(UserPrestataireRepository $userPrestataireRepository): Response
    {
        return $this->render('user_prestataire/index.html.twig', [
            'user_prestataires' => $userPrestataireRepository->findAll(),
        ]);
    }

    /**
     * @Route("/users", name="user_prestataire_new", methods={"GET","POST"})
     * //@IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request,  UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, PrestataireRepository $prestaRepository):Response
    {
        
        $values = json_decode($request->getContent());
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(UserPrestataire::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
            $maxidresult = $idrep ->getResult();
            $maxid = ($maxidresult[0][1] + 1);
            $mat.="~USR@sENT".$maxid;
                $userpresta = new UserPrestataire();
                $user = new User();
                $form=$this->createForm(UserType::class, $user);
                $form->handleRequest($request);
                $datas=$request->request->all();
                $file=$request->files->all()['imageFile'];
                $form->submit($datas); 
                    $user->setPassword(
                        $passwordEncoder->encodePassword(
                            $user,
                            $form->get('password')->getData()
                        ));
                    $user->setRoles(["ROLE_USER"]);
                    $user->setStatut("Debloquer");
                    $user->setImageFile($file);
                    $presta=$this->getUser()->getPrestataire();
                    $admin=$this->getUser()->getAdmin();
                    $user->setPrestataire($presta);
                    $user->setAdmin($admin);
                    $user->setUpdatedAt(new \DateTime('now'));



              

              
                $form = $this->createForm(UserPrestataireType::class, $userpresta);
                $form->handleRequest($request);
                $data = $request->request->all();
                $form->submit($data);
                $userpresta->setMatricule($mat);
                $userpresta->setAuthent($user);
                $connex=$this->getUser()->getPrestataire();
               // $found=$this->getDoctrine()->getRepository(Prestataire::class)->find($connex);
        //dump($connex);die();
                //$admin = $this->getDoctrine()->getRepository(Admin::class)->findOneBy(['authent'=>$presta]);
                //
                
          //$multiservice = $this->getDoctrine()->getRepository(Prestataire::class)->findOneBy(['admin'=>$connex]);
                //dump($connex);die(); 
                $userpresta->setMatriculeEntreprise($connex);
            
                if(!$userpresta->getAuthent())
                {
                    $notfound = [
                        'status' => 404,
                        'message' => 'Ce user est pas trouvé'
                    ];
        
                    return new JsonResponse($notfound, 404);    
                }
                if(!$userpresta->getMatriculeEntreprise())
                {
                    $notfound = [
                        'status' => 404,
                        'message' => 'Ce prestataire n\' est pas trouvé'
                    ];
        
                    return new JsonResponse($notfound, 404);    
                }

                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->persist($userpresta);
               $entityManager->flush(); 

               return new Response('Inserré',Response::HTTP_CREATED);
           
        
  
          

    }


    /**
     * @Route("/comptetravail", name="comptetravail", methods={"POST"})
     * //@IsGranted("ROLE_ADMIN")
     */
    public function comptetravail(Request $request,EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
      
        $user=new User();
        //$form=$this->createForm(UserPrestataireType::class, $cmpttrav);
        /* $form->handleRequest($request); */
        $datas=$request->request->all();
        //$form->submit($datas); 
       // $values = json_decode($request->getContent());
        $user= $userRepository->findOneBy(['username'=>$datas]);
        
        if(!$user)
        {
            throw $this->createNotFoundException('utilisateur non trouvé!!');
        }
    
        $compte = $this->getDoctrine()->getRepository(Compte::class)->findOneBy(['numero'=>$datas]);
       // dump($compte);
        if(!$compte)
        {
            throw $this->createNotFoundException('compte non trouvé!!');
        }
       if($user->getPrestataire()==$compte->getProprietaire()){

        $user->setCompteTravail($compte);
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => ' Le compte a été associé à l\'utilisateur'
        ];
        return new JsonResponse($data);

       }
        
        $data = [
            'status' => 400,
            'message' => ' Le compte n\'appartient pas au patron de cet utilisateur!'
        ];
        return new JsonResponse($data);
    }

         /**
     * @Route("/listuserpresta", name="userprestalist", methods={"GET"})
     */
    public function list(UserPrestataireRepository $userRepository, SerializerInterface $serializer): Response
    {
       
        $user=$this->getUser()->getAdmin();
        $list=$userRepository->findBy(['matriculeEntreprise'=>$user]);
        $data=$serializer->serialize($list, 'json',['groups' => ['userpresta']]);

       return new Response($data, 200, [
        'Content-Type' => 'application/json'
    ]);
    }

    /**
     * @Route("/{id}", name="user_prestataire_show", methods={"GET"}, requirements={"id":"\d+"})
     */
    public function show(UserPrestataire $userPrestataire): Response
    {
        return $this->render('user_prestataire/show.html.twig', [
            'user_prestataire' => $userPrestataire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_prestataire_edit", methods={"GET","POST"}, requirements={"id":"\d+"})
     */
    public function edit(Request $request, UserPrestataire $userPrestataire): Response
    {
        $form = $this->createForm(UserPrestataireType::class, $userPrestataire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_prestataire_index');
        }

        return $this->render('user_prestataire/edit.html.twig', [
            'user_prestataire' => $userPrestataire,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_prestataire_delete", methods={"DELETE"}, requirements={"id":"\d+"})
     */
    public function delete(Request $request, UserPrestataire $userPrestataire): Response
    {
        if ($this->isCsrfTokenValid('delete'.$userPrestataire->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($userPrestataire);
            $entityManager->flush();
        }

        return $this->redirectToRoute('user_prestataire_index');
    }
}
