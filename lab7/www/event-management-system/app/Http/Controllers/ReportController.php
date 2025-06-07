<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        // Отримати всі події з кількістю учасників (використовуємо withCount для many-to-many)
        $events = Event::withCount('participants')->get();

        // Повернути view 'report.index', передаючи змінну $events
        return view('report.index', compact('events'));
    }
}