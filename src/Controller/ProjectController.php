<?php


namespace App\Controller;


use App\Entity\Project;
use App\Repository\ProjectRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    #[Route('/projects', name: 'app_homepage')]
    public function homepage(Request $request, ProjectRepository $repository, ServiceRepository $serviceRepository, UserInfoRepository $userInfoRepository): Response
    {

        $offset = max(0, $request->query->getInt('offset', 0));

        $paginator = $repository->getProjectPaginator($request->query->get('q'), $offset);

        if ($request->query->get('preview')) {
            return $this->render('project/_searchPreview.html.twig', [
                'projects' => $paginator,
            ]);
        }

        return $this->render('project/index.html.twig', [
            'projects' => $paginator,
            'services' => $serviceRepository->findAll(),
            'userInfo' => $userInfoRepository->findActive(),
            'previous' => $offset - ProjectRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ProjectRepository::PAGINATOR_PER_PAGE),
        ]);
    }

    #[Route('/projects/{slug}', name: 'project_show')]
    public function show(Project $project, ProjectRepository $repository): Response
    {
        return $this->render('project/show.html.twig', [
            'project' => $project,
            'lastProjects' => $repository->findRandom()
        ]);
    }
}