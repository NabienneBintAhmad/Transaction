<?php

namespace App\Controller;

use App\Entity\UserPrestataire;
use App\Entity\User;
use App\Form\UserPrestataireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserPrestataireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\Prestataire;

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
     */
    public function new(Request $request,  UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(Prestataire::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
            $maxidresult = $idrep ->getResult();
            $maxid = ($maxidresult[0][1] + 1);
            $mat.="~USR@sENT".$maxid;
            $values = json_decode($request->getContent());
            if(isset($values->username,$values->password)) {

                $user = new User();
                $user->setUsername($values->username);
                $user->setPassword($passwordEncoder->encodePassword($user,$values->password));
                $user->setRoles(["ROLE_USER"]);
                $user->setStatut("Debloquer");
                $errors = $validator->validate($user);


                $usersprest = new UserPrestataire();

                $part = $this->getDoctrine()->getRepository(Prestataire::class)->find($values->entreprise);
                $usersprest->setNom($values->nom);
                $usersprest->setPrenom($values->prenom);
                $usersprest->setMatricule($mat);
                $usersprest->setAdresse($values->adresse);
                $usersprest->setEmail($values->email);
                $usersprest->setContact($values->contact);
                $usersprest->setCni($values->cni);
                $usersprest->setAuthent($user);
                $usersprest->setMatriculeEntreprise($part);
                if(count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                        'Content-Type' => 'application/json'
                    ]);
                }
                $entityManager->persist($user);
                $entityManager->persist($usersprest);
                $entityManager->flush();
    
                $data = [
                    'status' => 201,
                    'message' => 'Le caisssier a été créé'
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
     * @Route("/{id}", name="user_prestataire_show", methods={"GET"})
     */
    public function show(UserPrestataire $userPrestataire): Response
    {
        return $this->render('user_prestataire/show.html.twig', [
            'user_prestataire' => $userPrestataire,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="user_prestataire_edit", methods={"GET","POST"})
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
     * @Route("/{id}", name="user_prestataire_delete", methods={"DELETE"})
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
