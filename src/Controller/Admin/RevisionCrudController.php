<?php

namespace App\Controller\Admin;

use App\Entity\Revision;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RevisionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Revision::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('id')->onlyOnIndex(),
            TextField::new('datereviz'),
            TextField::new('kilometrage'),       
            TextField::new('filtre'),
            TextField::new('huile'),             
            DateField::new('createdAt')->onlyOnIndex(),
            AssociationField::new('cars'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
        ->setPermission(Action::DELETE, 'ROLE_ADMIN');
    }
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
        ->add('datereviz')
        ;
    }
}
