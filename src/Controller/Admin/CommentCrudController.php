<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            TextEditorField::new('content'),
            BooleanField::new('isDeleted'),
            AssociationField::new('author'),
            AssociationField::new('post')
        ];
    }

    public function createEntity(string $entityFqcn): Comment
    {
        $comment = new Comment();
        $comment->setCreatedAt(new \DateTimeImmutable());

        return $comment;
    
    }
}
