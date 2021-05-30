<?php


namespace App\Controller;


use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Service\MarkdownHelper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function new(EntityManagerInterface $entityManager)
    {
        $project = new Project();
        $project->setName('first')->setSlug('first_project' . random_int(0,1000))->setDescription(<<<EOF
        here is description of my project
EOF
);
        if(random_int(1,10) > 2) {
            $project->setCreatedAt(new \DateTime(sprintf('-%d days', random_int(1,100))));
        }

        $entityManager->persist($project);
        $entityManager->flush();

        return new Response(sprintf("New project is id #%d , name %s",$project->getId(),$project->getName()));
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
}