<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Configuration;
use App\Models\DocumentType;
use App\Models\Status;
use App\Models\Theme;
use App\Services\InputFields;
use App\Services\Messages;
use App\Services\UploadImage;
use App\Traits\DataTableTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class ThemeController extends Controller
{
    use DataTableTrait;

    public function __construct()
    {
        $this->middleware('auth');
    }

    //index
    public function index()
    {
        $themes = Theme::where('status_id', 1)->get();
        return view('admin.theme.home', compact('themes'));
    }

    //destroy
    public static function update($configuration_id, $theme)
    {
        $config_id = base64_decode($configuration_id);
        $theme_id = base64_decode($theme);

        $theme = Theme::findOrFail($theme_id);
        $config = Configuration::findOrFail($config_id);

        $data = [
            'theme_id' => $theme_id,
            'theme'    => $theme->slug,
        ];

        $config->update($data);

        session()->flash('success', 'Atualizado com sucesso!');
        return redirect()->back();
    }

}
