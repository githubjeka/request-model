<?php

declare(strict_types=1);

namespace Yiisoft\RequestModel\Tests\Support;

use Nyholm\Psr7\Response;
use Yiisoft\RequestModel\Attribute\Body;
use Yiisoft\RequestModel\Attribute\Query;
use Yiisoft\RequestModel\Attribute\Request;
use Yiisoft\RequestModel\Attribute\Route;
use Yiisoft\RequestModel\Attribute\UploadedFiles;

final class SimpleController
{
    public function action(SimpleRequestModel $request): Response
    {
        return new Response(200, [
            $request->getLogin(),
            $request->getPassword(),
        ]);
    }

    public function anotherAction(SimpleRequestModel $request): Response
    {
        return new Response(200, [
            'id' => $request->getId(),
        ]);
    }

    public function actionUsingAttributes(
        #[Route('id')] int $id,
        #[Body] $body,
        #[UploadedFiles] array $files
    ): Response {
        return new Response(200, [
            'id' => $id,
            'body' => $body,
            'countFiles' => count($files),
        ]);
    }

    public function actionUsingAttributes2(
        #[Query('page')] int $page,
        #[Request('attribute')] $attribute,
    ): Response {
        return new Response(200, [
            'page' => $page,
            'attribute' => $attribute,
        ]);
    }
}
