<?php
// app/Http/Controllers/Admin/AdminController.php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;

abstract class AdminController extends Controller
{
    use AuthorizesRequests, ValidatesRequests;

    public function __construct()
    {
        $this->middleware(['auth', 'admin', 'log.activity']);
        $this->middleware('permission:view ' . $this->getResourceName())->only(['index', 'show']);
        $this->middleware('permission:create ' . $this->getResourceName())->only(['create', 'store']);
        $this->middleware('permission:edit ' . $this->getResourceName())->only(['edit', 'update']);
        $this->middleware('permission:delete ' . $this->getResourceName())->only(['destroy']);
    }

    /**
     * Get resource name for permission checking
     */
    abstract protected function getResourceName(): string;

    /**
     * Common success response
     */
    protected function successResponse($message, $data = null)
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => $data
            ]);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Common error response
     */
    protected function errorResponse($message, $errors = null)
    {
        if (request()->wantsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
                'errors' => $errors
            ], 422);
        }

        return redirect()->back()
            ->withErrors($errors ?: ['error' => $message])
            ->withInput();
    }

    /**
     * Get common view data
     */
    protected function getViewData()
    {
        return [
            'user' => auth()->user(),
            'breadcrumbs' => $this->getBreadcrumbs(),
        ];
    }

    /**
     * Get breadcrumbs for the current page
     */
    protected function getBreadcrumbs()
    {
        return [
            ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
        ];
    }
}
