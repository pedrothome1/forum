<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSettingsRequest;

class SettingsController extends Controller
{
    /**
     * Show the view to edit the account settings.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit()
    {
        return view('settings.edit', ['user' => auth()->user()]);
    }

    /**
     * Update the account settings.
     *
     * @param  UpdateSettingsRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateSettingsRequest $request)
    {
        $user = tap($request->user())->update($request->filledFields());

        $this->flash('Sua conta foi atualizada.');

        return redirect()->route('profiles', $user->username);
    }
}
