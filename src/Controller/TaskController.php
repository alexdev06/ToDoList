<?php

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class TaskController extends AbstractController
{
    /**
     * @Route("/tasks", name="task_list")
     * @IsGranted("ROLE_USER")
     */
    public function listAction()
    {
        return $this->render('task/list.html.twig', ['tasks' => $this->getDoctrine()->getRepository(Task::class)->findAll()]);
    }

    /**
     * @Route("/tasks/done", name="task_done_list")
     * @IsGranted("ROLE_USER")
     */
    public function listDoneAction()
    {
        return $this->render('task/listDone.html.twig', ['tasks' => $this->getDoctrine()->getRepository(Task::class)->findBy(['isDone' => true], [])]);
    }

    /**
     * @Route("/tasks/create", name="task_create")
     * @IsGranted("ROLE_USER")
     */
    public function createAction(Request $request, EntityManagerInterface $entityManager)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            $entityManager->persist($task);
            $entityManager->flush();
            $this->addFlash('success', 'La tâche a été bien été ajoutée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/tasks/{id}/edit", name="task_edit")
     * @IsGranted("ROLE_USER")
     */
    public function editAction(Task $task, Request $request, EntityManagerInterface $entityManager)
    {
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'La tâche a bien été modifiée.');

            return $this->redirectToRoute('task_list');
        }

        return $this->render('task/edit.html.twig', ['form' => $form->createView(), 'task' => $task]);
    }

    /**
     * @Route("/tasks/{id}/toggle", name="task_toggle")
     * @IsGranted("ROLE_USER")
     */
    public function toggleTaskAction(Task $task, EntityManagerInterface $entityManager)
    {
        $task->toggle(!$task->isDone());
        $entityManager->flush();
        
        if ($task->isDone() == true) {
            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme "Terminée".', $task->getTitle()));
        } else {
            $this->addFlash('success', sprintf('La tâche %s a bien été marquée comme "A faire".', $task->getTitle()));
        }

        return $this->redirectToRoute('task_list');
    }

    /**
     * @Route("/tasks/{id}/delete", name="task_delete")
     * @IsGranted("REMOVE", subject="task")
     */
    public function deleteTaskAction(Task $task, EntityManagerInterface $entityManager)
    {
        $entityManager->remove($task);
        $entityManager->flush();
        $this->addFlash('success', 'La tâche a bien été supprimée.');

        return $this->redirectToRoute('task_list');
    }
}
