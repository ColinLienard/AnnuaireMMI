<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class ArticlesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Articles::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setDateFormat('d/M/Y')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular('Article')
            ->setEntityLabelInPlural('Articles');

    }

    public function createEntity(string $entityFqcn)
    {
        $article = new Articles();
        $user = $this->getUser();
        $author = $user->getFirstName() . " " . $user->getLastName();
        $article->setAuthor($author);

        return $article;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new("id")
                ->onlyOnIndex(),
            TextField::new("title","Titre"),
            TextField::new("author","Auteur")
                ->onlyOnIndex(),
            ImageField::new("img","Miniature")
                ->setBasePath("/data/img/article")
                ->setUploadDir('public/data/img/article')
                ->setUploadedFileNamePattern(uniqid(rand()) . ".[extension]")
                ->setRequired(false),
            TextEditorField::new('content',"Contenu")
                ->setFormType(CKEditorType::class)
                ->onlyOnForms(),
            DateField::new('created_at',"Date")
                ->onlyOnIndex(),
        ];
    }
}
