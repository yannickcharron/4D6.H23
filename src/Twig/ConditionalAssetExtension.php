<?php

namespace App\Twig;

use Symfony\Component\Asset\Packages;
use Symfony\Component\HttpKernel\KernelInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ConditionalAssetExtension extends AbstractExtension
{

    private Packages $packages;
    private KernelInterface $kernel;

    public function __construct(Packages $packages, KernelInterface $kernel)
    {
        $this->packages = $packages;
        $this->kernel = $kernel;
    }

    public function getFunctions() 
    {
        return [
            new TwigFunction('asset_if', [$this, 'asset_if'])
        ];
    }

    public function asset_if($path, $fallbackPath, $packageName = null) 
    {
        $pathToCheck = realpath($this->kernel->getProjectDir() . '/public') . '/' . $path;

        if(!file_exists($pathToCheck) || $path == null) {
            return $this->packages->getUrl($fallbackPath, $packageName);
        }

        return $this->packages->getUrl($path, $packageName);
        
    }

}