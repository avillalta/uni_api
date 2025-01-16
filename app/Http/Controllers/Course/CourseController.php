<?php

namespace App\Http\Controllers\Course;

use App\Http\Controllers\Controller;
use App\Http\Requests\Course\CourseStoreRequest;
use App\Http\Requests\Course\CourseUpdateRequest;
use App\Http\Resources\Course\CourseResource;
use App\Models\Course\Course;
use App\Traits\ApiResponse;
use App\Services\Course\CourseService;
use Illuminate\Http\Response;


class CourseController extends Controller
{

    use ApiResponse;

    protected $CourseService;

    public function __construct(CourseService $CourseService)
    {
        $this->CourseService = $CourseService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->CourseService->getAllCourses();

        if (isset($result[0]) && $result[0] instanceof Course) {
            $result = CourseResource::collection($result);
        }

        return $this->successResponse($result, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CourseStoreRequest $request)
    {
        $data = $request->validated();
        $result = $this->CourseService->saveCourse($data);

        if ($result instanceof Course) {
            $result = new CourseResource($result);
        }

        return $this->successResponse($result, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ['course_id' => $id];
        $result = $this->CourseService->showCourse($data);

        if ($result instanceof Course) {
            $result = new CourseResource($result);
        }

        return $this->successResponse($result, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CourseUpdateRequest $request, $id)
    {
        $data = $request->validated();
        $result = $this->CourseService->updateCourse($data, $id);

        if ($result instanceof Course) {
            $result = new CourseResource($result);
        }

        return $this->successResponse($result, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $result = $this->CourseService->deleteCourse($id);

        return $this->successResponse($result, Response::HTTP_NO_CONTENT);
    }
}