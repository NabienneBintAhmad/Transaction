<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Entity\Prestataire;
use App\Entity\UserPrestataire;
use App\Form\UserPrestataireType;
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request,  UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager):Response
    {
        
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(UserPrestataire::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
            $maxidresult = $idrep ->getResult();
            $maxid = ($maxidresult[0][1] + 1);
            $mat.="~USR@sENT".$maxid;
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
                    $user->setStatut("debloquer");
                    $user->setImageFile($file);
                    $user->setUpdatedAt(new \DateTime('now'));
                    $entityManager=$this->getDoctrine()->getManager();
                   $entityManager->persist($user);
                   $entityManager->flush();


                $userpresta = new UserPrestataire();

                if(!$userpresta->getMatriculeEntreprise())
                {
                    $notfound = [
                        'status' => 404,
                        'message' => 'Ce prestataire n\' est pas trouvé'
                    ];
        
                    return new JsonResponse($notfound, 404);    
                }

                $form = $this->createForm(UserPrestataireType::class, $userpresta);
                $form->handleRequest($request);
                $data = $request->request->all();
                $form->submit($data);
                $userpresta->setMatricule($mat); 
                $entityManager=$this->getDoctrine()->getManager();
                $entityManager->persist($userpresta);
               $entityManager->flush(); 

               return new Response('Inserré',Response::HTTP_CREATED);
                
  
          

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
