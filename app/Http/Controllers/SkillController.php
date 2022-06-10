<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Skill;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SkillController extends Controller
{
    public function index()
    {
        return Inertia::render('Skills/All', [
            'skills' => Skill::all(),
            'availableColors' => Skill::getAvailableBackgroundColors()
        ]);

    }

    public function store(Request $request)
    {

        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)
            ],
            'color' => [
                'required',
                'in:' . implode(',' , Skill::getAvailableBackgroundColors())
            ]
        ]);

        $skill = Skill::create($request->all());
        $skill->addMediaFromRequest('feature_image')
        ->toMediaCollection('service');

        return redirect()->route('skills.index');
    }

    public function update(Request $request, Skill $skill)
    {
        $request->validate([
            'name' => [
                'required',
                'max:255',
                Rule::unique(Skill::class)->ignore($skill->id)
            ],
            'color' => [
                'required',
                'in:' . implode(',' , Skill::getAvailableBackgroundColors())
            ]
        ]);

        $skill->update($request->all());

        if ($request->hasFile('feature_image')) {
            $skill->media()->delete();
            $skill->addMediaFromRequest('feature_image')
            ->toMediaCollection();
            // $popup->addMedia($file)->toMediaCollection('popup-icons');
        }


        return redirect()->route('skills.index');
    }

    public function destroy(Skill $skill)
    {
        $skill->delete();
        return redirect()->route('skills.index');
    }
}


        // return Inertia::render('Skills/All', [
        //     // 'skills' => Skill::with(['media' => function($query) {
        //     //     dd($query->getUrl());
        //     //     // dd($query->get('file_name'));
        //     //     // dd($query->getRelated());
        //     //     return $query->get('file_name');
        //     // }])->get(),
        //     'skills' => Skill::all(),
        //     // 'skills' => Skill::all()->map(function($skill) {
        //     //     dd($skill->url);
        //     //     return [
        //     //         // 'id' = $skill->id
        //     //     ];
        //     // }),
        //     // 'skills' => Skill::with('media')->get(),
        //     'availableColors' => Skill::getAvailableBackgroundColors()
        //     // 'url' => Skill
        // ]);
