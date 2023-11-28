<?php

namespace App\Controller\Admin;

use App\Entity\Images;
use App\Entity\Products;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\src\Controller\Admin\ImagesCrudController;


class ProductsCrudController extends AbstractCrudController
{
    public const PRODUCT_BASE_PATH = "upload/images/products";
    public const PRODUCT_UPLOAD_PATH = "public/upload/images/products";

    public static function getEntityFqcn(): string
    {
        return Products::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name'),
            BooleanField::new('isActive'),
            TextEditorField::new('discription'),
            MoneyField::new('price')->setCurrency('EUR'),
            IntegerField::new('stock'),
            DateTimeField::new('created_at')->hideOnForm(),
            // ImageField::new('images.name')
            // ->setBasePath(self::PRODUCT_BASE_PATH )
            // ->setUploadDir(self::PRODUCT_UPLOAD_PATH),
           
        ];
      
    }
   
}
