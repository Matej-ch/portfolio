<?php

namespace App\Controller;

use App\Repository\ProjectCollectionRepository;
use App\Repository\ProjectRepository;
use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class SitemapController extends AbstractController
{
    #[Route('/sitemap/sitemap.xml', name: 'app_sitemap_xml', defaults: ['xml'])]
    public function showAsXml(Request $request, ProjectRepository $repository, ProjectCollectionRepository $projectCollectionRepository, Packages $assetPackage): Response
    {
        $urls = $this->parseUrls($repository, $projectCollectionRepository, $assetPackage);

        $response = new Response(
            $this->renderView('sitemap/xml.html.twig', [
                'urls' => $urls,
                'hostname' => $request->getSchemeAndHttpHost()]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');

        return $response;
    }

    #[Route('/sitemap', name: 'app_sitemap_html', defaults: ['html'])]
    public function showAsHtml(Request $request, ProjectRepository $repository, ProjectCollectionRepository $projectCollectionRepository, Packages $assetPackage): Response
    {
        $urls = $this->parseUrls($repository, $projectCollectionRepository, $assetPackage);

        return new Response(
            $this->renderView('sitemap/text.html.twig', [
                'urls' => $urls,
                'hostname' => $request->getSchemeAndHttpHost()]),
            200
        );
    }

    /**
     * @param ProjectRepository $repository
     * @param ProjectCollectionRepository $projectCollectionRepository
     * @param Packages $assetPackage
     * @return array
     */
    private function parseUrls(ProjectRepository $repository, ProjectCollectionRepository $projectCollectionRepository, Packages $assetPackage): array
    {
        $urls = [];

        $urls[] = ['loc' => $this->generateUrl('app_homepage'), 'label' => 'Projects homepage'];
        $urls[] = ['loc' => $this->generateUrl('app_collections'), 'label' => 'Projects collections'];
        $urls[] = ['loc' => $this->generateUrl('app_about'), 'label' => 'About me'];

        foreach ($repository->findAll() as $project) {
            $urls[] = [
                'loc' => $this->generateUrl('app_project_show', ['slug' => $project->getSlug()]),
                'label' => $project->getName(),
                'image' => [
                    'loc' => $assetPackage->getUrl("uploads/projects/" . $project->getBgImg()),
                    'title' => $project->getBgImg()
                ],
            ];
        }

        foreach ($projectCollectionRepository->findAll() as $collection) {
            $urls[] = [
                'loc' => $this->generateUrl('app_collection_show', ['slug' => $collection->getSlug()]),
                'label' => $collection->getName(),
                'image' => [],
            ];
        }

        return $urls;
    }
}