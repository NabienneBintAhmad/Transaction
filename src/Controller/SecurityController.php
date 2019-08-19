<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Image;
use App\Entity\Compte;
use App\Form\UserType;
use App\Form\ImageType;
use App\Entity\Caissier;
use App\Exception\AccountDeletedException;
use App\Security\User as AppUser;
use Symfony\Component\Security\Core\Exception\AccountExpiredException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
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
use Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface;
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
                $entityManager=$this->getDoctrine()->getManager();
               $entityManager->persist($user);
               $entityManager->flush();
            
            $admin = new Admin();
          
            $form = $this->createForm(AdminTpeType::class, $admin);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $admin->setAuthent($user);
            $admin->setMatricule($mat); 
            $admin->setRole("Admin");
            if(!$admin->getAuthent())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce user n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($admin);
           $entityManager->flush(); 
            

            $presta = new Prestataire();
          
            $form = $this->createForm(PrestqtqireType::class, $presta);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $presta->setAdmin($admin);
            $presta->setMatricule($mat1);
            $presta->setCompte($compt);
            $presta->setNinea($ninea);
            if(!$presta->getAdmin())
            {
                $notfound = [
                    'status' => 404,
                    'message' => 'Ce admin n\' est pas trouvé'
                ];
    
                return new JsonResponse($notfound, 404);    
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($presta);
            $entityManager->flush();  

            $compte = new Compte();
           
            $form = $this->createForm(CompteType::class, $compte);
            $form->handleRequest($request);
            $data = $request->request->all();
            $form->submit($data);
            $compte->setProprietaire($presta);
            $compte->setNumero($compt);
            $compte->setSolde(0);
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
 
        }
        
   /**
     * @Route("/compt", name="compt", methods={"POST"})
     * @IsGranted("ROLE_SUPERADMIN")
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
      * @Route("/bloquer", name="bloquer", methods={"POST"})
     * @IsGranted("ROLE_SUPERADMIN")
     */

    public function bloquer(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $values = json_decode($request->getContent());
        $user = new User();
        $user = $userRepository->findOneByusername($values->username);
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
       // $user->setRoles(["ROLE_USERLOCK"]);
        $user->SetStatut("Bloquer");
        $entityManager->flush();
       
        $data = [
            'status' => 201,
            'message' => 'L\'utilisateur a été bloqué'
        ];
        return new JsonResponse($data);
       
    }


    /**
      * @Route("/debloquer", name="debloquer", methods={"POST"})
     * @IsGranted("ROLE_SUPERADMIN")
     */

    public function debloquer(Request $request, EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $values = json_decode($request->getContent());
        $user = new User();
        $user = $userRepository->findOneByusername($values->username);
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        $user->SetStatut("Debloquer");
        $entityManager->flush();
       
        $data = [
            'status' => 201,
            'message' => 'L\'utilisateur a été débloqué'
        ];
        return new JsonResponse($data);
       
    }


    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("/login_check", name="login", methods={"POST"})
     * @param JWTEncoderInterface $JWTEncoder
     * @throws \Lexik\Bundle\JWTAuthenticationBundle\Exception\JWTEncodeFailureException
     */
    public function login(Request $request,JWTEncoderInterface $JWTEncoder, UserRepository $userRepository)
    {

        $values = json_decode($request->getContent());
        $user = new User();

     /*  return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles()
        ]);  */
        $user = $userRepository->findOneByusername($values->username);
        if(!$user)
        {
            throw $this->createNotFoundException('User Not Found');
        }
        $isValid = $this->passwordEncoder->isPasswordValid($user, $values->password);
        if(!$isValid )
        {
            throw $this->createNotFoundException('Mot de passe incorrecte');
        }
    if ($user->getStatut()=="Bloquer") {
        throw $this->createNotFoundException('Accès refusé !!! Vous etes bloqué!!!');
    }
    $token = $JWTEncoder->encode([
        'username' => $user->getUsername(),
        'exp' => time() + 86400 // 1 day expiration
    ]);

    return $this->json([
        'token' => $token
    ]);


    }


   /*  public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user is deleted, show a generic Account Not Found message.
        if ($user->isDeleted()) {
            throw new AccountDeletedException();
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof AppUser) {
            return;
        }

        // user account is expired, the user may be notified
        if ($user->isExpired()) {
            throw new AccountExpiredException('...');
        }
    } */
}
