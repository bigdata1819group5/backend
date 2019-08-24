<?php

namespace App\Misc\Response;


use App\Misc\Containers\GuestAccount;
use App\Services;
use Symfony\Component\HttpFoundation\Response;


/**
 * Class TemplateResponse
 * @package App\Misc\Response
 */
class TemplateResponse extends Response
{

    /**
     * AdminResponse constructor.
     * @param string $template
     * @param array $variables
     */
    private function __construct(string $template, array $variables)
    {

        $content = Services::twigService()->render(
            $template,
            $variables + [
                'menu' => $this->getMenu()
            ]
        );

        parent::__construct($content);
    }

    /**
     * @param string $template
     * @param array $variables
     * @return TemplateResponse
     */
    public static function make(string $template, array $variables): TemplateResponse
    {
        return new TemplateResponse($template, $variables);
    }

    /**
     * @return array
     */
    private function getMenu()
    {
        if (Services::accountService()->getAccount() instanceof GuestAccount) {
            return [
                ['url' => '/login/', 'title' => 'Login'],
            ];
        }

        return [
            ['url' => '/stream/', 'title' => 'stream'],
        ];
    }
}