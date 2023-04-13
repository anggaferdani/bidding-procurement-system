<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function index(){
        $survey = Survey::all();
        return view('pages.compro.survey.index', compact('survey'));
    }

    public function show($id){
        $survey = Survey::find($id);
        return view('pages.compro.survey.show', compact('survey'));
    }
}
