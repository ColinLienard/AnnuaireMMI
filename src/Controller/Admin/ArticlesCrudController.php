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

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new("id")->onlyOnIndex(),
            TextField::new("title","Titre"),
            TextField::new("author","Auteur"),
            TextField::new("img","Image"),
            TextEditorField::new('content',"Contenu")->setFormType(CKEditorType::class)->onlyOnForms(),
            DateField::new('created_at',"Date")->onlyOnIndex(),
        ];
    }
}
