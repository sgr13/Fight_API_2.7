<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 17.03.18
 * Time: 21:12
 */

namespace AppBundle\Controller\Api;




use AppBundle\Controller\BaseController;
use AppBundle\Entity\Programmer;
use AppBundle\Form\ProgrammerType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProgrammerController extends BaseController
{
    /**
     * @Route("/api/programmers")
     * @Method("POST")
     */
    public function newAction(Request $request)
    {
        $body = $request->getContent();
        $data = json_decode($body, true);

        $programmer = new Programmer();
        $form = $this->createForm(new ProgrammerType(), $programmer);
        $form->submit($data);

        $programmer->setUser($this->findUserByUsername('weaverryan'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($programmer);
        $em->flush();

        $location = $this->generateUrl('api_programmers_show', array(
           'nickname' => $programmer->getNickname()
        ));
        $data = $this->serializeProgrammer($programmer);
        $response = new JsonResponse($data, 201);
        $response->headers->set('Location', $location);

        return $response;

//        return new Response('Let\'s do this!');
    }

    /**
     * @Route("/api/programmers/{nickname}" , name="api_programmers_show")
     * @Method("GET")
     */
    public function showAction($nickname)
    {
        $programmer = $this->getDoctrine()
            ->getRepository('AppBundle:Programmer')
            ->findOneByNickname($nickname);

        if (!$programmer) {
            throw $this->createNotFoundException('No programmer found for username' . $nickname);
        }

        $data = $this->serializeProgrammer($programmer);

        return new JsonResponse($data);
    }

    /**
     * @Route("/api/programmers")
     * @Method("GET")
     */
    public function listAction()
    {
        $programmers = $this->getDoctrine()
            ->getRepository('AppBundle:Programmer')
            ->findAll();

        $data = array('programmers' => array());

        foreach ($programmers as $programmer) {
            $data['programmers'][] = $this->serializeProgrammer($programmer);
        }

        return new JsonResponse($data);
    }

    private function serializeProgrammer(Programmer $programmer)
    {
        return array(
          'nickname' => $programmer->getNickname(),
          'avatarNumber' => $programmer->getAvatarNumber(),
          'powerLevel' => $programmer->getPowerLevel(),
          'tagLine' => $programmer->getTagLine()
        );
    }
}