<?php
namespace App\Interfaces;
use App\Models\Category;
interface CategoryRepositoryInterface
{
    public function GetCategoriesByUserId(int $Userid);
    public function SortTasksByDecreaseOrderTasks(bool $ASC);
    public function GetCategoryByName(string $expression);
    public function Category_Create(int $UserId,Category $category);
    public function Category_Update(int $UserId,Category $category);
    public function Category_Delete(int $UserId,int $CategoryId);
    // Add other method definitions as needed...
}