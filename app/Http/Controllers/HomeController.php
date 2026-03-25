<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Faq;
use App\Models\Setting;
use App\Models\Student;
use App\Models\Testimonial;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $testimonials = Testimonial::where('status', 'approved')
            ->latest()
            ->take(6)
            ->get();

        $faqs = Faq::where('is_active', true)
            ->orderBy('urutan')
            ->get();

        $coaches = Coach::where('is_active', true)
            ->latest()
            ->take(6)
            ->get();

        $stats = [
            'students_count' => Student::count(),
            'coaches_count' => Coach::where('is_active', true)->count(),
            'years_experience' => (int) Setting::getValue('years_experience', '8'),
        ];

        return view('pages.home', compact('testimonials', 'faqs', 'coaches', 'stats'));
    }
}