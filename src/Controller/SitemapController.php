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
    #[Route('/sitemap/sitemap', name: 'sitemap')]
    public function showAction(Request $request, ProjectRepository $repository, Packages $assetPackage): Response
    {
        $urls = [];
        $hostname = $request->getSchemeAndHttpHost();

        $urls[] = ['loc' => $this->generateUrl('app_homepage'), 'label' => 'Projects homepage'];
        $urls[] = ['loc' => $this->generateUrl('app_about'), 'label' => 'About me'];

        foreach ($repository->findAll() as $project) {
            $urls[] = [
                'loc' => $this->generateUrl('project_show', ['slug' => $project->getSlug()]),
                'label' => $project->getName(),
                'image' => [
                    'loc' => $assetPackage->getUrl("uploads/projects/" . $project->getBgImg()),
                    'title' => $project->getBgImg()
                ],
            ];
        }


        $type = $request->get('type');
        if (empty($type)) {
            $type = 'xml';
        }

        $response = new Response();
        $response->setStatusCode(200);

        if ($type === 'xml') {
            $response->setContent($this->renderView('sitemap/xml.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname]));

            $response->headers->set('Content-Type', 'text/xml');

        } else {
            $response->setContent($this->renderView('sitemap/text.html.twig', [
                'urls' => $urls,
                'hostname' => $hostname]));
        }
        
        return $response;
    }
}