<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\tutors_details;
use App\Models\User;
use App\Models\items;
class ProfileTController extends Controller
{

    public function show()
    {
        $teacher = auth()->user()->load(['UserTurot', 'tutorItem']);
        return view('profileT.show', compact('teacher'));
    }

}
