<?php

namespace App\Controller;

use App\Entity\TestRichText;
use Eckinox\TinymceBundle\Form\Type\TinymceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Knp\Snappy\Pdf as knpSnappyPdf;

class FondsStructureController extends AbstractController
{
    CONST FILE_TO_PDF = 'file.pdf';

    #[Route('/fonds/structure', name: 'app_fonds_structure')]
    public function index(Request $request, knpSnappyPdf $knpSnappyPdf): Response
    {
        $testRichText = new TestRichText();
        $testRichText->setName('test');
        $testRichText->setContent('<div><h1>Fonds Structurés</h1><input type="text" id="name" value="name" name="field_name" /></div>');

        $form = $this->createFormBuilder($testRichText)
            ->add('name', TextType::class)
            ->add('content', TinymceType::class)
            ->add('save', SubmitType::class, ['label' => 'Save '])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $testRichText = $form->getData();

            if (file_exists(self::FILE_TO_PDF)) {
                unlink(self::FILE_TO_PDF);
            }

            /*$knpSnappyPdf->generateFromHtml(
                $testRichText->getContent(),
                self::FILE_TO_PDF
            );*/


            // ... perform some action, such as saving the task to the database

            //return $this->redirectToRoute('task_success');
        }


        /*$knpSnappyPdf->generateFromHtml(
            $this->renderView(
                'MyBundle:Foo:bar.html.twig',
                array(
                    'some'  => $vars
                )
            ),
            '/path/to/the/file.pdf'
        );*/

        return $this->render('fonds_structure/index.html.twig', [
            'form' => $form,
        ]);
    }
}
