<?php

namespace App\Controller;

use App\Repository\ProjectRepository;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends AbstractController
{
    #[Route('/sitemap/sitemap.xml', name: 'sitemap', defaults: ['_format' => 'xml'])]
    public function showAction(Request $request, ProjectRepository $repository, Packages $assetPackage): Response
    {
        $urls = [];
        $hostname = $request->getSchemeAndHttpHost();

        // add static urls
        $urls[] = ['loc' => $this->generateUrl('app_homepage')];
        $urls[] = ['loc' => $this->generateUrl('app_about')];


        // add dynamic urls, like blog posts from your DB
        foreach ($repository->findAll() as $project) {
            $urls[] = [
                'loc' => $this->generateUrl('project_show', ['slug' => $project->getSlug()]),
                'image' => [
                    'loc' => $assetPackage->getUrl("uploads/projects/" . $project->getBgImg()),
                    'title' => $project->getBgImg()
                ],
            ];
        }

        // return response in XML format
        $response = new Response(
            $this->renderView('sitemap/sitemap.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }
}