<?php

namespace Tests\Unit\Services;

use App\Models\Category;
use App\Repositories\CategoryRepository;
use App\Services\CategoryService;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mockery;
use Mockery\MockInterface;
use PHPUnit\Framework\TestCase;

class CategoryServiceTest extends TestCase
{
    /**
     * @var MockInterface|CategoryRepository
     */
    private $categoryRepositoryMock;

    /**
     * @var CategoryService
     */
    private CategoryService $categoryService;

    /**
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->categoryRepositoryMock = Mockery::mock(CategoryRepository::class);
        $this->categoryService = new CategoryService($this->categoryRepositoryMock);
    }

    /**
     *
     */
    public function tearDown(): void
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @return array
     */
    public function getAllCategoriesDataProvider(): array
    {
        $category = new Category();
        $category->title = 'Image Title';
        $category->image = 'categories/test-image-hash';
        $category->slug = Str::slug('Image Title');

        $categoryCollection = new Collection();
        $categoryCollection->add($category);

        $expectedResult = new Collection();
        $expectedResult->add($category);

        return [
            'default' => [
                'categoryCollection' => $categoryCollection,
                'expectedResult' => $expectedResult,
            ],
        ];
    }

    /**
     * @dataProvider getAllCategoriesDataProvider
     * @param Collection $categoryCollection
     * @param Collection $expectedResult
     *
     * @return void
     */
    public function testGetAllCategories(Collection $categoryCollection, Collection $expectedResult): void
    {
        $this->categoryRepositoryMock
            ->shouldReceive('getAllCategories')
            ->once()
            ->andReturn($categoryCollection);

        $result = $this->categoryService->getAllCategories();

        $this->assertEquals($expectedResult, $result);
    }

    /**
     * @return array|array[]
     */
    public function getCategoryByIdDataProvider(): array
    {
        $category = new Category();
        $category->id = 1;
        $category->title = 'Image Title';
        $category->image = 'categories/test-image-hash';
        $category->slug = Str::slug('Image Title');

        $expectedResult = $category;

        return [
            'default' => [
                'id' => $category->id,
                'expectedResult' => $expectedResult,
            ],
        ];
    }

    /**
     * @dataProvider getCategoryByIdDataProvider
     * @param int $id
     * @param Category $expectedResult
     *
     * @return void
     */
    public function testGetCategoryById(int $id, Category $expectedResult): void
    {
        $this->categoryRepositoryMock
            ->shouldReceive('getCategoryById')
            ->with($id)
            ->once()
            ->andReturn($expectedResult);

        $result = $this->categoryService->getCategoryById($id);

        $this->assertEquals($expectedResult, $result);
    }
}
