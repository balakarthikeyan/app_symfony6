<?php

namespace App\Controller;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/api", name="api_")
 */
class ProjectApiController extends AbstractController
{

    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    /**
     * @Route("/project", name="project_index", methods={"GET"})
     */
    public function index(): Response
    {
        // $products = $this->getDoctrine()->getRepository(Project::class)->findAll();
        $products = $this->entityManager->getRepository(Project::class)->findAll();

        $data = [];

        foreach ($products as $product) {
            $data[] = [
                'id' => $product->getId(),
                'name' => $product->getName(),
                'description' => $product->getDescription(),
            ];
        }


        return $this->json($data);
    }

    /**
     * @Route("/project", name="project_new", methods={"POST"})
     */
    public function new(Request $request): Response
    {
        // $entityManager = $this->getDoctrine()->getManager();

        $project = new Project();
        $project->setName($request->request->get('name'));
        $project->setDescription($request->request->get('description'));

        $this->entityManager->persist($project);
        $this->entityManager->flush();

        return $this->json('Created new project successfully with id ' . $project->getId());
    }

    /**
     * @Route("/project/{id}", name="project_show", methods={"GET"})
     */
    public function show(int $id): Response
    {
        // $project = $this->getDoctrine()->getRepository(Project::class)->find($id);
        $project = $this->entityManager->getRepository(Project::class)->find($id);

        if (!$project) {

            return $this->json('No project found for id' . $id, 404);
        }

        $data =  [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/project/{id}", name="project_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        // $entityManager = $this->getDoctrine()->getManager();
        $project = $this->entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }

        $project->setName($request->request->get('name'));
        $project->setDescription($request->request->get('description'));
        $this->entityManager->flush();

        $data =  [
            'id' => $project->getId(),
            'name' => $project->getName(),
            'description' => $project->getDescription(),
        ];

        return $this->json($data);
    }

    /**
     * @Route("/project/{id}", name="project_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        // $entityManager = $this->getDoctrine()->getManager();
        $project = $this->entityManager->getRepository(Project::class)->find($id);

        if (!$project) {
            return $this->json('No project found for id' . $id, 404);
        }

        $this->entityManager->remove($project);
        $this->entityManager->flush();

        return $this->json('Deleted a project successfully with id ' . $id);
    }
}
