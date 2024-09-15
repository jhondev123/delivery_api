<?php

namespace Tests\Unit\Repositories;

use Mockery;
use Mockery\Mock;
use Tests\TestCase;
use Mockery\MockInterface;
use App\Domain\Entities\Group;
use App\Domain\Entities\Product;
use App\Models\Product as ProductModel;
use App\Http\Repositories\ProductRepository;

class ProductRepositoryTest extends TestCase
{
    private MockInterface|ProductRepository $productRepository;
    private ProductModel $product1;
    private ProductModel $product2;

    protected function setUp(): void
    {
        parent::setUp();
        $this->productRepository = Mockery::mock(ProductRepository::class);
        $this->product1 = new ProductModel();
        $this->product1->id = 1;
        $this->product1->name = 'Produto 1';
        $this->product1->price = 10.0;
        $this->product1->description = 'Descrição do Produto 1';

        $this->product2 = new ProductModel();
        $this->product2->id = 2;
        $this->product2->name = 'Produto 2';
        $this->product2->price = 20.0;
        $this->product2->description = 'Descrição do Produto 2';
    }
    public function newProduct()
    {
        $product = new Product();
        $product->setName('coca-cola');
        $product->setPrice(2.5);
        $product->setDescription('Refrigerante');
        $product->setGroup(new Group('1'));
        return $product;
    }

    public function test_getAll_products(): void
    {
        $this->productRepository->shouldReceive('getAllProducts')
            ->once()
            ->andReturn([$this->product1, $this->product2]);

        $products = $this->productRepository->getAllProducts();

        $this->assertIsArray($products);
        $this->assertCount(2, $products);
        $this->assertInstanceOf(ProductModel::class, $products[0]);
        $this->assertEquals('Produto 1', $products[0]->name);
    }
    public function test_getById_product(): void
    {
        $this->productRepository->shouldReceive('getProductById')
            ->once()
            ->with(1)
            ->andReturn($this->product1);

        $product = $this->productRepository->getProductById(1);

        $this->assertInstanceOf(ProductModel::class, $product);
        $this->assertEquals(1, $product->id);
        $this->assertEquals('Produto 1', $product->name);
        $this->assertEquals(10.0, $product->price);
        $this->assertEquals('Descrição do Produto 1', $product->description);
    }
    public function test_store_product(): void
    {
        $product = $this->newProduct();

        $this->productRepository->shouldReceive('store')
            ->once()
            ->with($product)
            ->andReturn([
                'id' => 3,
                'name' => 'coca-cola',
                'price' =>  2.5,
                'description' => 'Refrigerante',
                'group_id' => 1,
            ]);

        $storedProduct = $this->productRepository->store($product);

        $this->assertIsArray($storedProduct);
        $this->assertEquals(3, $storedProduct['id']);
        $this->assertEquals('coca-cola', $storedProduct['name']);
        $this->assertEquals(2.5, $storedProduct['price']);
        $this->assertEquals('Refrigerante', $storedProduct['description']);
        $this->assertEquals(1, $storedProduct['group_id']);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
