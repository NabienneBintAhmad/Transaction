<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Admin;
use App\Entity\Image;
use App\Entity\Compte;
use App\Form\ImageType;
use App\Entity\Prestataire;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/api")
 */
class SecurityController extends AbstractController
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


        $values = json_decode($request->getContent());


/* 
         $image = new Image();
        $form=$this->createForm(ImageType::class, $image);
        $form->handleRequest($request);
        $datas=$request->request->all();
        $file=$request->files->all()['imageFile'];
        $form->submit($datas); 
     if($form->isSubmitted() && $form->isValid())
          {
           $image->setImageFile($file);
              $image->setUpdatedAt(new \Datetime());
            $entityManager=$this->getDoctrine()->getManager();
               $entityManager->persist($image);
              $entityManager->flush();
    //       // var_dump($form);die();
          return $this->handleView($this->view(['status'=>'ok'], Response::HTTP_CREATED));
        }

         return $this->handleView($this->view($form->getErrors())); */


        if (isset($values->username, $values->password)) {

            $user = new User();
            $user->setUsername($values->username);
            $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setStatut("Debloquer");
            $errors = $validator->validate($user);


            $admin = new Admin();
            $admin->setAuthent($user);
            $admin->setNom($values->nom);
            $admin->setPrenom($values->prenom);
            $admin->setAdresse($values->adresse);
            $admin->setEmail($values->email);
            $admin->setContact($values->contact);
            $admin->setCni($values->cni);
            $admin->setMatricule($mat);
            $admin->setRole("Admin");

            $presta = new Prestataire();
            $presta->setAdmin($admin);
            $presta->setNom($values->nom1);
            $presta->setPrenom($values->prenom1);
            $presta->setNomEntreprise($values->nom_entreprise);
            $presta->setAdresse($values->adresse1);
            $presta->setContact($values->contact1);
            $presta->setCni($values->cni1);
            $presta->setEmail($values->email1);
            $presta->setMatricule($mat1);
            $presta->setCompte($compt);
            $presta->setNinea($ninea);

            $compte = new Compte();
            $compte->setProprietaire($presta);
            $compte->setNumero($compt);
            $compte->setSolde($values->solde);



            if (count($errors)) {
                $errors = $serializer->serialize($errors, 'json');
                return new Response($errors, 500, [
                    'Content-Type' => 'application/json'
                ]);
            }
            $entityManager->persist($user);
            $entityManager->persist($admin);
            $entityManager->persist($presta);
            $entityManager->persist($compte);
            $entityManager->flush();

            $data = [
                'status' => 201,
                'message' => 'L\'utilisateur a été créé'
            ];

            return new JsonResponse($data, 201);
        }
        $data = [
            'status' => 500,
            'message' => 'pas insertion!!!'
        ];
        return new JsonResponse($data, 500);
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

        /*   $entityManager->persist($user);
        $entityManager->persist($admin);
        $entityManager->persist($presta); */
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
