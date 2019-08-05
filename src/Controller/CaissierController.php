<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Caissier;
use App\Form\CaissierType;;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



/**
 * @Route("/api")
 */
class CaissierController extends AbstractController
{

    /**
     * @Route("/caissier", name="caissier_new", methods={"GET","POST"})
     * @IsGranted("ROLE_SUPERADMIN")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $entityManager, SerializerInterface $serializer, ValidatorInterface $validator)
    {
        
        $mat = date('y');
        $idrep = $this->getDoctrine()->getRepository(Caissier::class)->CreateQueryBuilder('a')
            ->select('Max(a.id)')
            ->getQuery();
            $maxidresult = $idrep ->getResult();
            $maxid = ($maxidresult[0][1] + 1);
            $mat.="~CA@s1si".$maxid;
            $values = json_decode($request->getContent());
            if(isset($values->username,$values->password)) {

                $user = new User();
                $user->setUsername($values->username);
                $user->setPassword($passwordEncoder->encodePassword($user, $values->password));
                $user->setRoles(["ROLE_CAISSIER"]);
                $user->setStatut("Debloquer");
                $errors = $validator->validate($user);

            $caissier = new Caissier();
            
                $caissier->setNom($values->nom);
                $caissier->setPrenom($values->prenom);
                $caissier->setMatricule($mat);
                $caissier->setAdresse($values->adresse);
                $caissier->setEmail($values->email);
                $caissier->setContact($values->contact);
                $caissier->setCni($values->cni);
                $caissier->setRole("Caissier");
                $caissier->setAuthent($user);
        
            
                if(count($errors)) {
                    $errors = $serializer->serialize($errors, 'json');
                    return new Response($errors, 500, [
                        'Content-Type' => 'application/json'
                    ]);
                }
                $entityManager->persist($user);
                $entityManager->persist($caissier);
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
     * @Route("/{id}", name="caissier_show", methods={"GET"})
     */
    public function show(Caissier $caissier): Response
    {
        return $this->render('caissier/show.html.twig', [
            'caissier' => $caissier,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="caissier_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Caissier $caissier): Response
    {
        $form = $this->createForm(CaissierType::class, $caissier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('caissier_index');
        }

        return $this->render('caissier/edit.html.twig', [
            'caissier' => $caissier,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="caissier_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Caissier $caissier): Response
    {
        if ($this->isCsrfTokenValid('delete'.$caissier->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($caissier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('caissier_index');
    }
}
