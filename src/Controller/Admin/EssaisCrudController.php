<?php

namespace App\Controller\Admin;

use App\Entity\Essais;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EssaisCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Essais::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            DateTimeField::new('startedAt'),
            AssociationField::new('voiture'),
            AssociationField::new('conducteur'),
            AssociationField::new('passager01',
            ),
            # AssociationField::new('passager02'),
            # AssociationField::new('passager03'),
            #AssociationField::new('passager04'),
            AssociationField::new('route',
            ),
            BooleanField::new('etat'),
        ];
    }
}
