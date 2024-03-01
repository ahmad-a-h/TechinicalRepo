<?php
namespace App\Repositories;

interface CategoryRepositoryInterface
{
    public function GetCategoriesByUserId(int $Userid):Collection;
    public function SortTasksByDecreaseOrderTasks(bool $ASC):Collection;
    public function GetCategoryByName(string $expression):Collection;
    public function Category_Create(int $UserId,Category $category):bool;
    public function Category_Update(int $UserId,Category $category):bool;
    public function Category_Delete(int $UserId,int $CategoryId):bool;
    // Add other method definitions as needed...
}