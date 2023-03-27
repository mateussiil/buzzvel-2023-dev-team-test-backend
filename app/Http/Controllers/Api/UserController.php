<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function __construct(
        protected User $repository,
    ) {

    }

    public function index()
    {
        $users = $this->repository->paginate();

        return UserResource::collection($users);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:users,name',
                'linkedin_url' => 'required',
                'github_url' => 'required',
            ],[
                'name.required' => 'name is required!',
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => $e->errors(),
            ], 422);
        }

        $existingUser = $this->repository->where('name', '=', $request->name)->first();

        if ($existingUser) {
            return response()->json([
                'message' => 'User already exist!'
            ], 409);
        }


        $user = $this->repository->create($request->all());

        return new UserResource($user);
    }

    public function show(string $name)
    {
        $user = $this->repository->where('name', '=', $name)->first();

        if (!$user) {
            return response()->json(['message' => 'user not found'], 404);
        }

        return new UserResource($user);
    }

    public function update(StoreUpdateUserRequest $request, string $id)
    {
        $user = $this->repository->findOrFail($id);

        $data = $request->validated();

        $user->update($data);

        return new UserResource($user);
    }

    public function destroy(string $id)
    {
        $user = $this->repository->findOrFail($id);
        $user->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
