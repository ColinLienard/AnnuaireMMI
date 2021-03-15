<?php

namespace App\Controller\Admin;

use App\Entity\Offer;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class OfferCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Offer::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->renderContentMaximized()
            ->setDateFormat('d/M/Y')
            ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
            ->setEntityLabelInSingular("Offre d'emploi")
            ->setEntityLabelInPlural("Offres d'emploi");

    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new("id")
                ->onlyOnIndex(),
            TextField::new('title','Intitulé'),
            TextField::new('company','Entreprise')
                ->onlyOnForms(),
            ChoiceField::new('domain','Domaine')
                ->setChoices(["Communication" => "Communication","Graphisme" => "Graphisme","Développement" => "Développement"]),
            ChoiceField::new('type','Type de contrat')
                ->setChoices(["Non renseigné" => "Non renseigné","CDD" => "CDD","CDI" => "CDI"]),
            TextField::new("region","Region"),
            TextField::new("city","Ville")
                ->onlyOnForms(),
            TextEditorField::new('description','Description')
                ->setFormType(CKEditorType::class)
                ->setFormTypeOptionIfNotSet("config_name","offer")
                ->onlyOnForms(),
            TextField::new("name","Nom Prénom")
                ->onlyOnForms(),
            EmailField::new("email","Email")
                ->onlyOnForms(),
            TelephoneField::new('phone',"Numéro de téléphone")
                ->onlyOnForms(),
            DateField::new('created_at',"Date")
                ->onlyOnIndex(),

        ];
    }
}
