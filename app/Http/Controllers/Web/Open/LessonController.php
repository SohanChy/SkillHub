<?php

namespace App\Http\Controllers\Web\Open;

use App\Category;
use App\Course;
use App\Lessons;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class LessonController extends Controller
{

  public function __construct()
  {
      HomeController::courseNavDataShare();
  }
}
