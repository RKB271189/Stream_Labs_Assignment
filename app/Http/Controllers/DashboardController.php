<?php

namespace App\Http\Controllers;

use App\Http\Requests\Editor\SaveRequest;
use App\Repository\Editor\EditorInterface;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $editorReposiotry;
    public function __construct(EditorInterface $editorInterface)
    {
        $this->editorReposiotry = $editorInterface;
    }
    public function index()
    {
        return inertia('Admin/Dashboard');
    }
    public function saveEditor(SaveRequest $request)
    {
        try {
            $params = $request->only('content');
            $details = $this->editorReposiotry->Save($params);
            return response()->json(['message' => 'Content saved successfully', 'details' => $details], 200);
        } catch (Exception $ex) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }
}
