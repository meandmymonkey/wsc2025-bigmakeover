<?php

declare(strict_types=1);

namespace App\LegacyBridge;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\HeaderUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

class Controller
{
    public function __construct(
        #[Autowire('%legacy_web_path%')] private string $legacyRoot,
        #[Autowire('@legacy.services')] private ContainerInterface $container
    ) {}

    #[Route(path: '/', name: 'app_legacy_index', defaults: ['path' => 'index.php'], priority: -1024)]
    #[Route(path: '/{path}', name: 'app_legacy', requirements: ['path' => '.+'], priority: -1024)]
    public function __invoke(Request $request, string $path): Response
    {
        $scriptPath = $this->legacyRoot.'/'.$path;

        if (!is_readable($scriptPath)) {
            throw new NotFoundHttpException();
        }

        $_SERVER['SCRIPT_FILENAME'] = $scriptPath;
        $_SERVER['SCRIPT_NAME'] = $path;

        ob_start();

        global $session;
        $session = $request->getSession();

        global $servicesForLegacy;
        $servicesForLegacy = $this->container;

        global $symfonyRequest;
        $symfonyRequest = $request;

        require_once $scriptPath;

        $result = ob_get_clean();

        $response = new Response($result);

        foreach (headers_list() as $header) {
            $headerData = HeaderUtils::split($header, ':');
            $response->headers->set($headerData[0], $headerData[1]);
        }

        header_remove();

        return $response;
    }
}
