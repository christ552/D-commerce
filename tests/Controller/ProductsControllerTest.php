<?php

namespace App\Test\Controller;

use App\Entity\Products;
use App\Repository\ProductsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductsControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ProductsRepository $repository;
    private string $path = '/products/';
    private EntityManagerInterface $manager;

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = static::getContainer()->get('doctrine')->getRepository(Products::class);

        foreach ($this->repository->findAll() as $object) {
            $this->manager->remove($object);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'product[name]' => 'Testing',
            'product[discription]' => 'Testing',
            'product[price]' => 'Testing',
            'product[stock]' => 'Testing',
            'product[created_at]' => 'Testing',
            'product[isActive]' => 'Testing',
            'product[poids]' => 'Testing',
            'product[taille]' => 'Testing',
            'product[categories]' => 'Testing',
        ]);

        self::assertResponseRedirects('/products/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Products();
        $fixture->setName('My Title');
        $fixture->setDiscription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setStock('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setPoids('My Title');
        $fixture->setTaille('My Title');
        $fixture->setCategories('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Product');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Products();
        $fixture->setName('My Title');
        $fixture->setDiscription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setStock('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setPoids('My Title');
        $fixture->setTaille('My Title');
        $fixture->setCategories('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'product[name]' => 'Something New',
            'product[discription]' => 'Something New',
            'product[price]' => 'Something New',
            'product[stock]' => 'Something New',
            'product[created_at]' => 'Something New',
            'product[isActive]' => 'Something New',
            'product[poids]' => 'Something New',
            'product[taille]' => 'Something New',
            'product[categories]' => 'Something New',
        ]);

        self::assertResponseRedirects('/products/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getDiscription());
        self::assertSame('Something New', $fixture[0]->getPrice());
        self::assertSame('Something New', $fixture[0]->getStock());
        self::assertSame('Something New', $fixture[0]->getCreated_at());
        self::assertSame('Something New', $fixture[0]->getIsActive());
        self::assertSame('Something New', $fixture[0]->getPoids());
        self::assertSame('Something New', $fixture[0]->getTaille());
        self::assertSame('Something New', $fixture[0]->getCategories());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Products();
        $fixture->setName('My Title');
        $fixture->setDiscription('My Title');
        $fixture->setPrice('My Title');
        $fixture->setStock('My Title');
        $fixture->setCreated_at('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setPoids('My Title');
        $fixture->setTaille('My Title');
        $fixture->setCategories('My Title');

        $this->manager->persist($fixture);
        $this->manager->flush();

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/products/');
    }
}
