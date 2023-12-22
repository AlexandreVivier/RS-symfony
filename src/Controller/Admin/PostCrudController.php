<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use DateTime;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class PostCrudController extends AbstractCrudController
{
   
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title'),
            TextEditorField::new('content'),
            DateTimeField::new('created_at')->hideOnForm(),
            // AssociationField::new('category')->autocomplete()
            // ->setFormTypeOption('by_reference', false),
            AssociationField::new('author')->formatValue(function ($value, $entity) {
                return $entity->getAuthor()->getPseudo();
            })->hideOnForm(),
        ];
    }
    
}
