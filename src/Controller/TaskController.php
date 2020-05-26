<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use App\FormValue\TaskFormValue;
use App\Model\Task\CloseTask;
use App\Model\Task\GetTask;
use App\Model\Task\SaveTask;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class TaskController extends AbstractController
{
    /**
     * @var GetTask
     */
    private $getTask;

    /**
     * @var SaveTask
     */
    private $saveTask;

    /**
     * @var CloseTask
     */
    private $closeTask;

    public function __construct(GetTask $getTask, SaveTask $saveTask, CloseTask $closeTask)
    {
        $this->getTask = $getTask;
        $this->saveTask = $saveTask;
        $this->closeTask = $closeTask;
    }

    public function index(bool $today = false): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $this->getTask->getTasks($today),
        ]);
    }

    /**
     * @Route("/task-closed", name="task_closed")
     */
    public function task_closed(): Response
    {
        return $this->render('task/index.html.twig', [
            'tasks' => $this->getTask->getClosedTasks(),
        ]);
    }

    /**
     * @Route("/task-new", name="task_new")
     */
    public function new(Request $request): Response
    {
        $taskFormValue = new TaskFormValue();

        $form = $this->createForm(TaskType::class, $taskFormValue);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->saveTask->new($taskFormValue);

            $this->addFlash('notice', 'Task was saved');

            return $this->redirectToRoute('index');
        }

        return $this->render('task/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/close/{id}", name="task_close")
     */
    public function close(Task $task): Response
    {
        $this->closeTask->close($task);

        $this->addFlash('notice', 'Task was closed');

        return $this->redirectToRoute('index');
    }

    /**
     * @Route("/open/{id}", name="task_open")
     */
    public function open(Task $task): Response
    {
        $this->closeTask->open($task);

        $this->addFlash('notice', 'Task was opened');

        return $this->redirectToRoute('index');
    }
}
