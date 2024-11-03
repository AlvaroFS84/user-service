<?php

namespace App\Infrastructure\Controller;

use App\Application\Command\CreateUserCommand;
use App\Infrastructure\Service\Interface\ResponseServiceinterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;

class UserController extends AbstractController
{

    public function __construct(private MessageBusInterface $bus, private ResponseServiceinterface $responseService){}

    public function createUser(Request $request):JsonResponse
    {

        try{
            $data = json_decode($request->getContent(),true);

            $userCommand = new CreateUserCommand(
                $data['email'],
                $data['name'],
                $data['surname'],
                $data['password']
            );

            $this->bus->dispatch($userCommand);
        }catch(Exception $e){

            $respondeData = [
                'status' => 'failed',
                'message' => $e->getMessage()
            ];
            
            return $this->responseService->response($respondeData,JsonResponse::HTTP_BAD_REQUEST);
        }

        $respondeData = [
            'status' => 'ok',
            'message' => 'User created'
        ];
        
        return $this->responseService->response($respondeData,JsonResponse::HTTP_BAD_REQUEST);

    }
}