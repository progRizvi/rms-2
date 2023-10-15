<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class FoodController extends Controller
{
    public function index()
    {
        $foods = Food::with("category")->where("restaurant_id", auth("restaurants")->user()->id)->orderBy("id", "desc")->paginate(10);
        return view("backend.pages.food.index", compact("foods"));
    }
    public function create()
    {
        $categories = Category::orderBy("name", "asc")->where("status", "active")->get();
        return view("backend.pages.food.create", compact("categories"));
    }
    public function store(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                "title" => "required|max:100|unique:food,title",
                "description" => "nullable",
                "price" => "required|numeric",
                "discount" => "nullable|numeric",
                "category_id" => "required|exists:categories,id",
                "image" => "nullable|image",
                "status" => "required|in:Active,Inactive",
                "featured" => "required|in:Yes,No",
            ]
        );
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back();
        }
        $data = $request->except(["_token", "file"]);
        if ($request->hasFile("file")) {
            $file = $request->file("file");
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/food"), $fileName);
            $data["image"] = $fileName;
        }
        $data["slug"] = Str::slug($request->title);
        $data["restaurant_id"] = auth("restaurants")->user()->id;
        $foods = Food::create($data);
        if ($foods) {
            toastr()->success("Food created successfully");
            return redirect()->route("restaurant.foods.index");
        }
        toastr()->error("Something went wrong");
        return redirect()->back();
    }
    public function edit($id)
    {
        $food = Food::find($id);
        $categories = Category::orderBy("name", "asc")->where("status", "active")->get();
        return view("backend.pages.food.edit", compact("food", "categories"));
    }
    public function update(Request $request, $id)
    {
        $validation = Validator::make(
            $request->all(),
            [
                "title" => "required|max:100|unique:food,title," . $id,
                "description" => "nullable",
                "price" => "required|numeric",
                "discount" => "nullable|numeric",
                "category_id" => "required|exists:categories,id",
                "image" => "nullable|image",
                "status" => "required|in:Active,Inactive",
                "featured" => "required|in:Yes,No",
            ]
        );
        if ($validation->fails()) {
            foreach ($validation->errors()->all() as $error) {
                toastr()->error($error);
            }
            return redirect()->back();
        }
        $data = $request->except(["_token", "file"]);

        $food = Food::find($id);
        if ($request->hasFile("file")) {
            if ($food->image && file_exists(public_path("uploads/food/" . $food->image))) {
                unlink(public_path("uploads/food/" . $food->image));
            }
            $file = $request->file("file");
            $fileName = time() . "." . $file->getClientOriginalExtension();
            $file->move(public_path("uploads/food"), $fileName);
            $data["image"] = $fileName;
        }

        $data["slug"] = Str::slug($request->title);

        $food = $food->update($data);
        if ($food) {
            toastr()->success("Food updated successfully");
            return redirect()->route("restaurant.foods.index");
        }
        toastr()->error("Something went wrong");
        return redirect()->back();
    }
    public function delete($id)
    {
        $food = Food::find($id);
        if ($food) {
            if ($food->image && file_exists(public_path("uploads/food/" . $food->image))) {
                unlink(public_path("uploads/food/" . $food->image));
            }
            $food->delete();
            toastr()->success("Food deleted successfully");
            return redirect()->back();
        }
        toastr()->error("Something went wrong");
        return redirect()->back();
    }
}
