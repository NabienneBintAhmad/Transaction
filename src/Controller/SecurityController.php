<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Image;
use App\Entity\Compte;
use App\Form\UserType;
use App\Form\ImageType;
use App\Entity\Caissier;
use App\Form\CompteType;
use App\Form\AdminTpeType;
use App\Form\CaissierType;
use App\Entity\Prestataire;
use App\Form\PrestqtqireType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractFOSRestController
{



    /**
     * @Route("/register", name="register", methods={"POST"})
     * @IsGranted("ROLE_SUPERADMIN")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator):Response
    {
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(Prestataire::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
        $maxidresult = $idrep->getResult();
        $maxid = ($maxidresult[0][1] + 1);
        $mat1 = date('y');
        $idrep1 = $this->getDoctrine()->getRepository(Prestataire::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
        $maxidresult1 = $idrep1->getResult();
        $maxid1 = ($maxidresult1[0][1] + 1);
        $mat .= "-AD@m1i" . $maxid;
        $mat1 .= "-NOOPr" . $maxid1;

        $compt = random_int(1000000000, 9999999999);
        $ninea = $mat . $compt;
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
                $user->setRoles(["ROLE_ADMIN"]);
                $user->setStatut("debloquer");
                $user->setImageFile($file);
                $user->setUpdatedAt(new \DateTime('now'));
               $entityManager->persist($user);
               $entityManager->flush();
            
            $admin = new Admin();
            if(!$admin->getAuthent()())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce user est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $form = $this->createForm(AdminTpeType::class, $admin);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $admin->setMatricule($mat); 
            $admin->setRole("Admin");
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($admin);
           $entityManager->flush(); 
            

            $presta = new Prestataire();
            if(!$presta->getAdmin())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce admin n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $form = $this->createForm(PrestqtqireType::class, $presta);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $presta->setMatricule($mat1);
            $presta->setCompte($compt);
            $presta->setNinea($ninea);
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($presta);
            $entityManager->flush();  

            $compte = new Compte();
            if(!$compte->getProprietaire()())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce prestataire n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $form = $this->createForm(CompteType::class, $compte);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $compte->setNumero($compt);
            $compte->setSolde(0);

            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($compte);
            $entityManager->flush();

            return new Response('Inserré',Response::HTTP_CREATED);
 
        }
        
   /**
     * @Route("/compt", name="compt", methods={"POST"})
     */
    public function compte(Request $request, EntityManagerInterface $entityManager): Response
    {

        $values = json_decode($request->getContent());
        $compte = new Compte();
      
        $compt = random_int(1000000000, 9999999999);
         $form = $this->createForm(CompteType::class, $compte);
         $form->handleRequest($request);
         $data = $request->request->all();
         $form->submit($data);
       
        $compte->setNumero($compt);
        $compte->setSolde(0);
        $proprietaire = $this->getDoctrine()->getRepository(Prestataire::class)->findOneBy(['nomEntreprise'=>$values->nomEntreprise]);
        $compte->setProprietaire($proprietaire);
        // var_dump($proprietaire);die();
        // if($proprietaire)
        // {   

            if(!$compte->getProprietaire())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce prestataire n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
        $entityManager=$this->getDoctrine()->getManager();
        $entityManager->persist($compte);
        $entityManager->flush();

        return new Response('Inserré',Response::HTTP_CREATED);
        // }
        //return new Response(' NON Inserré !!!!!',Response::HTTP_BAD_REQUEST);
  }

    /**
     * @Route("/register/bloquer", name="bloquer", methods={"POST","GET"})
     * @IsGranted("ROLE_SUPERADMIN")
     */

    public function bloquer(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $values = json_decode($request->getContent());
        $user = new User();
        $user = $userRepository->findOneByusername($values->username);
        $user->setRoles(["ROLE_USERLOCK"]);
        $user->SetStatut("Bloquer");
        $entityManager->flush();
        $data = [
            'status' => 201,
            'message' => 'L\'utilisateur a été bloqué'
        ];
        return new JsonResponse($data);
    }


    /**
     * @Route("/login", name="login", methods={"POST"})
     * //@IsGranted("ROLE_USERLOCK")
     */
    public function login(Request $request)
    {
        $user = $this->getUser();
        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);

        if ("roles" == ["ROLE_USERLOCK"]) {
            $data = [
                'status' => 500,
                'message' => 'Vous etes bloqué!!!'
            ];
            return new JsonResponse($data, 500);
        }
    }
}
