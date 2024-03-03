<?php
namespace App\Http\Repos;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function GetCategoriesByUserId(int $userId)
    {
        // Retrieve categories associated with the specified user
        return Category::where('user_id', $userId)->get();
    }

    public function SortTasksByDecreaseOrderTasks(bool $asc)
    {
        // Sort tasks by decrease order or increase order based on the given flag
        $order = $asc ? 'asc' : 'desc';
        return Task::orderBy('created_at', $order)->get();
    }

    public function GetCategoryByName(string $name)
    {
        // Retrieve categories with the given name
        return Category::where('name', $name)->get();
    }

    public function Category_Create(int $userId, Category $category)
    {
        // Create a new category associated with the specified user
        $category->user_id = $userId;
        return $category->save();
    }

    public function Category_Update(int $userId, Category $category)
    {
        // Update the category associated with the specified user
        return $category->update(['user_id' => $userId]);
    }

    public function Category_Delete(int $userId, int $categoryId)
    {
        // Delete the category associated with the specified user and ID
        return Category::where('user_id', $userId)->where('id', $categoryId)->delete();
    }
}
