<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            EmailField::new('email'),
            TextField::new('password'),
            // ImageField::new('image.name')
            //  ->setBasePath(self::PRODUCT_BASE_PATH )
            // ->setUploadDir(self::PRODUCT_UPLOAD_PATH),




            TextField::new('lastname'),
            TextField::new('firstname'),
            TextField::new('address'),
            TextField::new('zipcode'),
            TextField::new('city'),
            DateTimeField::new('created_at')->hideOnForm(),
           // IntegerField::new('roles')->hideOnForm(),// in future ->hideOnForm(), can be removed 
           // TextEditorField::new('description'),
        ];
    }
    
}
