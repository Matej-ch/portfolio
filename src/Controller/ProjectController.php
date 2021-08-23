<?php


namespace App\Controller;


use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(MarkdownHelper $markdownHelper,ProjectRepository $repository): Response
    {
        $projects = $repository->findAllOrderByNewest();

        return $this->render('project/homepage.html.twig',['projects' =>  $projects]);
    }

    /**
     * @Route("/projects/new", name="app_new")
     */
    public function new(Request $request): Response
    {
        $project = new Project();
        $project->setIsActive(1);
        $project->setName('First project');
        $project->setDescription('First project description');

        $form = $this->createForm(ProjectType::class, $project);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $project = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('app_homepage');
        }

        return $this->render('project/new.html.twig',['form' => $form->createView()]);
    }

    /**
     * @Route("/projects/{slug}",name="app_show")
     */
    public function show(Project $project): Response
    {
        return $this->render('project/show.html.twig',[
            'project' => $project,
        ]);
    }

    /**
     * @Route("/projects/{slug}/update",name="app_update", methods="POST")
     */
    public function updateDescription(Project $project,Request $request,EntityManagerInterface $entityManager): RedirectResponse
    {
        $description = $request->request->get('description');

        $project->setDescription($description);

        $entityManager->flush();

        return $this->redirectToRoute('app_show',[
            'slug' => $project->getSlug()
        ]);
    }
}