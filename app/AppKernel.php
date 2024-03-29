<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Mediashare\AppBundle\MediashareAppBundle(),
            new Mediashare\AdminBundle\MediashareAdminBundle(),
            new Mediashare\UserBundle\MediashareUserBundle(),
            new Mediashare\NewsBundle\MediashareNewsBundle(),
            new Mediashare\PartnerBundle\MediasharePartnerBundle(),
            new Mediashare\GuestBookBundle\MediashareGuestBookBundle(),
            new Mediashare\GalleryBundle\MediashareGalleryBundle(),
            new Mediashare\GedBundle\MediashareGedBundle(),
            new Mediashare\FaqBundle\MediashareFaqBundle(),
            new Mediashare\ProductBundle\MediashareProductBundle(),
            new Mediashare\ReferencingBundle\MediashareReferencingBundle(),
            new Mediashare\PageBundle\MediasharePageBundle(),
            new Mediashare\NewsletterBundle\MediashareNewsletterBundle(),
            new Mediashare\PdfBundle\MediasharePdfBundle(),
            new Liuggio\ExcelBundle\LiuggioExcelBundle(),
            new Liip\ImagineBundle\LiipImagineBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir() . '/config/config_' . $this->getEnvironment() . '.yml');
    }
}
