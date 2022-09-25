<?php

namespace App\Controller;

use App\Entity\ProjectCollection;
use App\Repository\ProjectCollectionRepository;
use App\Repository\ProjectRepository;
use App\Service\MetaTagParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectCollectionController extends AbstractController
{
    #[Route('/collections', name: 'app_collections')]
    public function homepage(Request $request, ProjectCollectionRepository $repository, MetaTagParser $metaTagParser): Response
    {
        $offset = max(0, $request->query->getInt('offset', 0));

        $paginator = $repository->getProjectPaginator($request->query->get('q'), $offset);
        
        return $this->render('collection/index.html.twig', [
            'collections' => $paginator,
            'previous' => $offset - ProjectRepository::PAGINATOR_PER_PAGE,
            'next' => min(count($paginator), $offset + ProjectRepository::PAGINATOR_PER_PAGE),
            'metaTags' => $metaTagParser->parse('app_homepage')
        ]);
    }

    #[Route('/collections/{slug}', name: 'app_collection_show')]
    public function show(ProjectCollection $collection, MetaTagParser $metaTagParser): Response
    {
        return $this->render('collection/show.html.twig', [
            'collection' => $collection,
            'metaTags' => $metaTagParser->parse('app_project_show'),
        ]);
    }
}