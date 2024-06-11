<?php

namespace App\Controller;

use App\Entity\TestRichText;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FondsStructureController extends AbstractController
{
    #[Route('/fonds/structure', name: 'app_fonds_structure')]
    public function index(): Response
    {
        $testRichText = new TestRichText();
        $testRichText->setName('test');
        $testRichText->setContent('<div><h1>Fonds Structurés</h1></div>');

        $form = $this->createFormBuilder($testRichText)
            ->add('name', TextType::class)
            ->add('content', CKEditorType::class)
            ->add('save', SubmitType::class, ['label' => 'Save '])
            ->getForm();

        return $this->render('fonds_structure/index.html.twig', [
            'form' => $form,
        ]);
    }
}
